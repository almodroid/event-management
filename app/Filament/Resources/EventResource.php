<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use App\Models\EventOrganizerGate;
use App\Models\Organizer;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\DatePicker::make('start_date')->required(),
                Forms\Components\DatePicker::make('end_date')->required(),
                TextInput::make('available_tickets')->required()->numeric(),
                TextInput::make('max_ticket_quantity_per_customer')->required()->numeric(),
                TextInput::make('min_ticket_quantity_per_customer')->default(1)->numeric(),
                Forms\Components\TagsInput::make('tags')->placeholder('Comma separated tags'),
                Forms\Components\FileUpload::make('image')
                    ->disk('public')->image()->directory('events')
                    ->preserveFilenames()->imageEditor()
                    ->imageEditorAspectRatios([null, '16:9', '4:3', '1:1']),
                Repeater::make('eventOrganizerGates')
                    ->relationship('eventOrganizerGates')
                    ->schema([
                        Select::make('organizer_id')
                            ->label('Organizer')
                            ->relationship('organizers', 'name')
                            ->getOptionLabelFromRecordUsing(fn (Organizer $record) => $record->name)
                            ->options(Organizer::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        TextInput::make('gate_name')
                            ->label('Gate')
                            ->required(),
                    ])
                    ->columns(2)
                    ->label('Organizers and Gates')
                    ->createItemButtonLabel('Add Organizer')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('start_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('end_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('available_tickets')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('tags')->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('totalTicketsSold')->label('Total Tickets Sold')->getStateUsing(function (Event $record) {
                    return $record->totalTicketsSold();
                }),
                Tables\Columns\TextColumn::make('organizers')->label('Organizers')->getStateUsing(function (Event $record) {
                    return $record->eventOrganizerGates->pluck('organizer.name')->implode(', ');
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
