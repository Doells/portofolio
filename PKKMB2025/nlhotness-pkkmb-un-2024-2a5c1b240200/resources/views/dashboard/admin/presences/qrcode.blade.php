@extends('layouts.dashboard.app')

@section('content')
<div class="">
    <h1 class="my-10 font-bold text-[20px] mx-10 text-center">
        Kirim Presensi - Sesi {{$dataSesiPresensi->title ?? ''}}
    </h1>
    <div class="">
        <div class="">
            <div class="px-20 mx-auto items-center justify-center">
                <img alt="" src="{{$qrcode}}" class="w-50 h-50 items-center mx-auto">
            </div>
            <p class="text-center text-white mt-4 w-full"><span  id="reset-timer" class="px-4 py-2 bg-blue-600 rounded-md"></span></p>
        </div>
    </div>
</div>

<script>
function updateResetTimer() {
    const interval = 31; // waktu dalam detik
    let remainingTime = interval;

    function updateTimer() {
        remainingTime--;
        const seconds = remainingTime % 60;
        document.getElementById('reset-timer').textContent = `QR Code akan reset dalam ${seconds} Detik`;

        if (remainingTime <= 0) {
            remainingTime = interval;
            location.reload(); // Refresh halaman setiap kali timer habis
        }
    }

    setInterval(updateTimer, 1000);
}

// Memulai timer dan refresh halaman setelah timer habis
updateResetTimer();


</script>

@endsection
