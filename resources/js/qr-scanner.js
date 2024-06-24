import { Html5QrcodeScanner } from "html5-qrcode";

document.addEventListener("DOMContentLoaded", function() {
    const qrCodeScanner = new Html5QrcodeScanner(
        "qr-reader",
        { fps: 10, qrbox: 250 }
    );

    qrCodeScanner.render(onScanSuccess);

    function onScanSuccess(qrCodeMessage) {
        const scanType = document.getElementById('qr-reader').dataset.scanType;
        const url = scanType === 'attendance' ? '/admin/scan-organizer' : '/organizer/scan-ticket';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ qr_code: qrCodeMessage })
        })
        .then(response => response.json())
        .then(data => {
            if (data.valid) {
                if (scanType === 'attendance') {
                    alert(`Organizer ${data.organizer_name} attendance recorded.\nChecked in at: ${data.checked_in_at}\nChecked out at: ${data.checked_out_at}`);
                } else {
                    alert(`Ticket for ${data.attendee_name} scanned successfully.`);
                }
            } else {
                alert("Invalid or already scanned QR code.");
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
