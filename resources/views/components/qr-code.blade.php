{{-- resources/views/components/qr-code.blade.php --}}
@if (isset($qr_code))
    <img src="data:image/png;base64,{{ $qr_code }}" alt="QR Code">
@else
    <p>QR code will be generated upon saving the record.</p>
@endif