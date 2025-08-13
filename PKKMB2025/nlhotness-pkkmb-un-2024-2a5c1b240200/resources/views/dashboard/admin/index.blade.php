@extends('layouts.dashboard.app')

@section('content')
<div class="grid grid-cols-3 grid-rows-3">
    <div class="py-2">
        <a href="{{ route('tambahtugas.index') }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Total Tugas</h5>
            <p class="font-normal text-lg text-gray-700 dark:text-gray-400">{{ $taskCount }}</p>
        </a>
    </div>
    <div class="py-2">
        <a href="{{ route('attendances.index') }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Total Presensi</h5>
            <p class="font-normal text-lg text-gray-700 dark:text-gray-400">{{ $presencesCount }}</p>
        </a>
    </div>
    <div class="py-2">
        <a href="{{ route('admin.pelanggaran.index') }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Total Pelanggaran</h5>
            <p class="font-normal text-lg text-gray-700 dark:text-gray-400">{{ $pelanggaranCount }}</p>
        </a>
    </div>
    <div class="py-2">
        <a href="{{ route('positions.index') }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Total Posisi</h5>
            <p class="font-normal text-lg text-gray-700 dark:text-gray-400">{{ $positionCount }}</p>
        </a>
    </div>
    <div class="py-2">
        <a href="{{ route('kelompok.index') }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Total Kelompok</h5>
            <p class="font-normal text-lg text-gray-700 dark:text-gray-400">{{ $kelompokCount }}</p>
        </a>
    </div>
    <div class="py-2">
        <a href="{{ route('students.index') }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Total Peserta</h5>
            <p class="font-normal text-lg text-gray-700 dark:text-gray-400">{{ $pesertaCount }}</p>
        </a>
    </div>
    <div class="py-2">
        <a href="{{ route('admin.index') }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Total Panitia</h5>
            <p class="font-normal text-lg text-gray-700 dark:text-gray-400">{{ $panitiaCount }}</p>
        </a>
    </div>
</div>
@endsection