<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0">
                    <a href="{{ route('organizer.dashboard') }}" class="text-xl font-bold">{{ __('filament.navigation.dashboard') }}</a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('organizer.dashboard') }}" class="text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-sm font-medium">
                        {{ __('filament.navigation.dashboard') }}
                    </a>
                    <a href="{{ route('organizer.scanner') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">
                        {{ __('filament.navigation.scan_tickets') }}
                    </a>
                    <a href="{{ route('organizer.tickets') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">
                        {{ __('filament.navigation.add_ticket') }}
                    </a>
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <form method="POST" action="{{ route('organizer.logout') }}">
                    @csrf
                    <button type="submit" class="bg-indigo-500 text-white px-3 py-2 rounded-md text-sm font-medium">{{ __('filament.navigation.logout') }}</button>
                </form>
                <div class="ml-4">
                    <a href="{{ route('set-locale', ['locale' => 'en']) }}" class="text-sm text-gray-700">English</a> |
                    <a href="{{ route('set-locale', ['locale' => 'ar']) }}" class="text-sm text-gray-700">العربية</a>
                </div>
            </div>
        </div>
    </div>
</nav>
