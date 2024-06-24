<!DOCTYPE html>
<html>
<head>
    <title>Ticket Details</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Ticket Details</h1>
    <p>Customer Name: {{ $ticket->customer_name }}</p>
    <p>Customer Email: {{ $ticket->customer_email }}</p>
    <p>Event: {{ $ticket->event->title }}</p>
    <p>QR Code:</p>
    <img src="data:image/png;base64,{{ $ticket->qr_code }}" alt="QR Code">

    <button id="validate-button">Validate Ticket</button>

    <script>
        document.getElementById('validate-button').addEventListener('click', function () {
            fetch('{{ route('ticket.validate', $ticket->id) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({}),
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
                    document.getElementById('validate-button').disabled = true;
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>