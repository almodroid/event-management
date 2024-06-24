<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. {{ __('All rights reserved.') }}
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('about') }}" class="text-gray-500 hover:text-gray-700">{{ __('About Us') }}</a>
                <a href="{{ route('privacy') }}" class="text-gray-500 hover:text-gray-700">{{ __('Privacy Policy') }}</a>

            </div>
        </div>
    </div>
</footer>
