<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($events as $event)
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-bold">{{ $event->title }}</h3>
                                    <p>{{ $event->description }}</p>
                                    <a href="{{ route('events.show', $event) }}" class="text-indigo-500 hover:text-indigo-700">{{ __('More details') }}</a>
                                    <a href="{{ route('tickets.buy', $event) }}" class="text-green-500 hover:text-green-700 ml-4">{{ __('Buy Tickets') }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
