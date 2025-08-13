 // Inisiasi html5QRCodeScanner
 let html5QRCodeScanner = new Html5QrcodeScanner(
    "reader", {
        fps: 10,
        qrbox: { width: 250, height: 250 },
        formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE],
        rememberLastUsedCamera: false,
        supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
    }
);

// Function yang dieksekusi ketika scanner berhasil
// membaca suatu QR Code
function onScanSuccess(decodedText, decodedResult) {
    // Mendapatkan elemen form dan field
    const codeField = document.getElementById("code-field");
    const anotherField = document.getElementById("another-field");

    // Isi field dengan data dari QR code
    codeField.value = decodedText;
    
    // Membersihkan scan area ketika sudah menjalankan
    // action di atas
    html5QRCodeScanner.clear();

    document.getElementById('kirim-presensi').submit();
}

// Render qr code scanner
html5QRCodeScanner.render(onScanSuccess);
