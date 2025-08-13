@extends('layouts.dashboard.app')

@push('style')
@powerGridStyles
@endpush

@section('buttons')
<div class="btn-toolbar mb-2 mb-md-0">
    <div>
        <a href="{{ route('presences.index', $attendance->id) }}" class="btn btn-sm btn-light">
            <span data-feather="arrow-left-circle" class="align-text-bottom"></span>
            Kembali
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="mb-5">
    <div class="w-full p-4 text-center bg-white dark:bg-boxdark border border-gray-200 rounded-lg shadow sm:p-8">
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $attendance->title }}</h5>
        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">{{ $attendance->description }}</p>
        <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 my-2">
            <div>
                Status : @include('partials.attendance-badges')
            </div>
            <div>
                <a href="{{ route('presences.not-present', $attendance->id) }}" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-lg font-semibold">
                    Belum Presensi
                </a>
            </div>
            <div>
                    @include('dashboard.user.home-presences.partials.qrcode-presence')
            </div>
        </div>

        <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 my-2">
            <div class="flex gap-x-4">
                <div class="mb-2">
                    <small class="font-semibold bg-gray-100 rounded-lg px-2 py-1">Range Jam Masuk</small>
                    <div class="mt-1">{{ $attendance->start_time }} - {{ $attendance->batas_start_time }}</div>
                </div>
            </div>
        </div>

        <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 my-2">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4">
                <small class="font-semibold">Posisi</small>
                <div>
                    @foreach ($attendance->positions as $position)
                    <span class="bg-green-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">{{ $position->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <livewire:presence-table attendanceId="{{ $attendance->id }}" />
</div>

@endsection

@push('script')
<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
@powerGridScripts
@endpush

<!-- Main modal -->
<div id="scannerModal" data-modal-backdrop="qrcode-scanner-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black bg-opacity-65">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white  dark:bg-boxdark rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Presensi QR-Code
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="scannerModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div id="reader"></div>
            </div>
        </div>
    </div>
</div>

{{-- camera start --}}
<div class="container dark:bg-boxdark" id="qrcode-scanner-modal" tabindex="-1">
    <div id="reader" class="container"></div>
</div>
{{-- camera stop --}}