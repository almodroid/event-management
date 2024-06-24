<x-filament::page>
    <h2 class="text-2xl font-bold tracking-tight">{{ __('QR Code Scanner for Attendance') }}</h2>
    <div id="qr-reader" class="w-full mt-4" data-scan-type="attendance"></div>

    @vite(['resources/js/qr-scanner.js'])
</x-filament::page>
