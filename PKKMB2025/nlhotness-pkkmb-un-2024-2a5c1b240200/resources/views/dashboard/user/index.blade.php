@extends('layouts.dashboard.app')

@section('content')
<div>
    <div class="py-2">
        <a href="{{ route('dashboard-user.taskindex') }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Total Tugas</h5>
            <p class="font-normal text-lg text-gray-700 dark:text-gray-400">{{ $taskCount }}</p>
        </a>
    </div>
    <div class="py-2">
        <a href="{{ route('home-presences.index') }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Total Presensi</h5>
            <p class="font-normal text-lg text-gray-700 dark:text-gray-400">{{ $presencesCount }}</p>
        </a>
    </div>
    {{-- <div class="py-2">
        <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Total Pelanggaran</h5>
            <p class="font-normal text-lg text-gray-700 dark:text-gray-400">{{ $pelanggaranCount }}</p>
        </a>
    </div> --}}
</div>
@endsection