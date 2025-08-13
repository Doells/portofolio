@extends('layouts.dashboard.app')

@push('style')
@powerGridStyles
@endpush

@section('buttons')
<div class="btn-toolbar mb-2 mb-md-0">
    <div>
        <a href="{{ route('result-task.index', $tambahtugas->id) }}" class="btn btn-sm btn-light">
            <span data-feather="arrow-left-circle" class="align-text-bottom"></span>
            Kembali
        </a>
    </div>
</div>
@endsection

@include('partials.alerts')

@section('content')
<div class="mb-5">
    <div class="w-full lg:w-1/2 p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8">
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $tambahtugas->title }}</h5>
        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">{{ $tambahtugas->description }}</p>
        <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 my-2">
            <div>
                Status : 
                @if ($tambahtugas->data->is_start)
                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Buka</span>
                @else
                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Tutup</span>
                @endif
            </div>
            <div>
                <a href="{{ route('result-task.notSubmit', $tambahtugas->id) }}" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-lg font-semibold">
                    Belum Mengumpulkan
                </a>
            </div>
        </div>

        <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 my-2">
            <div class="flex gap-x-4">
                <div class="mb-2">
                    <small class="font-semibold bg-gray-100 rounded-lg px-2 py-1">Range Tanggal</small>
                    <div class="mt-1">{{ $tambahtugas->start_date }} - {{ $tambahtugas->end_date }}</div>
                </div>
                <div class="mb-2">
                    <small class="font-semibold bg-gray-100 rounded-lg px-2 py-1">Range Waktu</small>
                    <div class="mt-1">{{ $tambahtugas->start_time }} - {{ $tambahtugas->batas_start_time }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <livewire:result-task-table tambahtugasId="{{ $tambahtugas->id }}" />
</div>

@endsection

@push('script')
<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
@powerGridScripts
@endpush