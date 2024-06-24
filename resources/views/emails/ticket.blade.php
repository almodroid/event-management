<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Your Ticket') }}</title>
</head>
<body>
    <h1>{{ __('Thank you for your purchase!') }}</h1>
    <p>{{ __('Here is your ticket for the event:') }} {{ $ticket->event->title }}</p>
    <p>{{ __('Customer Name') }}: {{ $ticket->customer_name }}</p>
    <p>{{ __('Customer Email') }}: {{ $ticket->customer_email }}</p>
    <p>{{ __('Event') }}: {{ $ticket->event->title }}</p>
    <img src="data:image/png;base64,{{ $ticket->qr_code }}" alt="QR Code">
    <p>{{ __('Please present this QR code at the event.') }}</p>
</body>
</html>
