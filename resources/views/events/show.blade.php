<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-64 object-cover mb-4">
                    <h3 class="text-lg font-bold mb-2">{{ $event->title }}</h3>
                    <p>{{ $event->description }}</p>
                    <p>{{ __('Start Time') }}: {{ $event->start_time }}</p>
                    <p>{{ __('End Time') }}: {{ $event->end_time }}</p>
                    <a href="{{ route('tickets.buy', $event) }}" class="text-green-500 hover:text-green-700 mt-4 inline-block">{{ __('Buy Tickets') }}</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
