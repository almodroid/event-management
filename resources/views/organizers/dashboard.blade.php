<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h2 class="text-lg font-semibold mb-2">{{ __('Customer Name') }}</h2>
                            <p>{{ $organizer->name }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h2 class="text-lg font-semibold mb-2">{{ __('Customer Email') }}</h2>
                            <p>{{ $organizer->email }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h2 class="text-lg font-semibold mb-2">{{ __('Scanned Tickets') }}</h2>
                            <p>{{ $scannedTicketsCount }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h2 class="text-lg font-semibold mb-2">{{ __('Total Tickets') }}</h2>
                            <p>{{ $totalTicketsCount }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h2 class="text-lg font-semibold mb-2">{{ __('Connection Status') }}</h2>
                            <p>{{ $organizer->is_online ? __('Online') : __('Offline') }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h2 class="text-lg font-semibold mb-2">{{ __('Gate Number') }}</h2>
                            <p>{{ $organizer->gate_number }}</p>
                        </div>
                        @if($event)
                            <div class="bg-white p-4 rounded-lg shadow">
                                <h2 class="text-lg font-semibold mb-2">{{ __('Event Times') }}</h2>
                                <p>{{ $event->start_time }} - {{ $event->end_time }}</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow">
                                <h2 class="text-lg font-semibold mb-2">{{ __('Event Name') }}</h2>
                                <p>{{ $event->title }}</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow">
                                <h2 class="text-lg font-semibold mb-2">{{ __('Event Image') }}</h2>
                                <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="w-full h-auto rounded">
                            </div>
                        @else
                            <div class="bg-white p-4 rounded-lg shadow">
                                <h2 class="text-lg font-semibold mb-2">{{ __('No Event Currently') }}</h2>
                            </div>
                        @endif
                    </div>
                    <div class="mt-6">
                        <!-- Action Buttons -->
                        <div class="flex mb-4 ">
                            <a href="{{ route('organizer.scanner') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm font-medium mr-2">{{ __('Scan QR Code') }}</a>
                            <a href="{{ route('organizer.tickets') }}" class="bg-green-500 text-white px-4 py-2 rounded-md text-sm font-medium">{{ __('Add Ticket') }}</a>
                        </div>

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Scanned Tickets') }}</h2>
                        <table class="min-w-full divide-y divide-gray-200 mt-4">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Customer Name') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Customer Email') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Event') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Scanned At') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($scannedTickets as $ticket)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $ticket->customer_name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $ticket->customer_email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $ticket->event->title }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $ticket->updated_at }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
