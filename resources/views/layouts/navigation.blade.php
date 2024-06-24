<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="block h-9 w-auto">
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700">{{ __('Dashboard') }}</a>
                    <a href="{{ route('about') }}" class="text-gray-500 hover:text-gray-700">{{ __('About Us') }}</a>
                    <a href="{{ route('events') }}" class="text-gray-500 hover:text-gray-700">{{ __('Events') }}</a>
                    <a href="{{ route('privacy') }}" class="text-gray-500 hover:text-gray-700">{{ __('Privacy Policy') }}</a>
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="ml-3 relative">
                    <a href="{{ route('set-locale', ['locale' => 'en']) }}" class="text-sm text-gray-700">English</a> |
                    <a href="{{ route('set-locale', ['locale' => 'ar']) }}" class="text-sm text-gray-700">العربية</a>
                </div>
            </div>
        </div>
    </div>
</nav>
