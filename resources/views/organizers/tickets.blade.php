<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('organizer.addTicket') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="customer_name" class="block text-sm font-medium text-gray-700">{{ __('Customer Name') }}</label>
                            <input type="text" name="customer_name" id="customer_name" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="customer_email" class="block text-sm font-medium text-gray-700">{{ __('Customer Email') }}</label>
                            <input type="email" name="customer_email" id="customer_email" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="event_id" class="block text-sm font-medium text-gray-700">{{ __('Event') }}</label>
                            <select name="event_id" id="event_id" class="mt-1 block w-full" required>
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">{{ __('Date') }}</label>
                            <input type="date" name="date" id="date" class="mt-1 block w-full" required>
                        </div>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md text-sm font-medium">{{ __('Add Ticket') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
