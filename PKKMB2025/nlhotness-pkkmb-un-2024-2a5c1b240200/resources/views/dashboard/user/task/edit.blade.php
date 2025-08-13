@extends('layouts.dashboard.app')

@section('content')
<div class="container py-5">
    <div class="p-4 bg-white rounded-lg md:p-8 border shadow-md my-4">
        <h2 class="mb-2 text-2xl font-extrabold tracking-tight text-gray-900">Data {{ auth()->user()->position->name }} PKKMB :</h2>
        <!-- List -->
        <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400">
            <li class="flex space-x-2 items-center">
                <span class="leading-tight">Nama : </span>
                <span>{{ auth()->user()->name }}</span>
            </li>
            <li class="flex space-x-2 items-center">
                <span class="leading-tight">NIM : </span>
                <span>{{ auth()->user()->nim }}</span>
            </li>
            <li class="flex space-x-2 items-center">
                <span class="leading-tight">Program Studi : </span>
                <span>{{ auth()->user()->detailuser->prodi }}</span>
            </li>
            <li class="flex space-x-2 items-center">
                <span class="leading-tight">Fakultas : </span>
                <span>{{ auth()->user()->detailuser->fakultas }}</span>
            </li>
            <li class="flex space-x-2 items-center">
                <span class="leading-tight">Kelompok : </span>
                <span>{{ auth()->user()->kelompok->name ?? 'Belum masuk kelompok' }}</span>
            </li>
        </ul>
    </div>
    <div class="border px-4 py-4 mb-3 rounded-lg shadow-lg">
        <h5 class="mb-3 font-bold">Jawaban :</h5>
        @if ($tambahtugas->input_type == 'Text')
        <form method="POST" action="{{ route('dashboard-user.updateTask', ['tambahtugas' => $tambahtugas->id]) }}">
            @csrf
            <input type="url" name="text" value="{{ $task->text }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2 flex items-end mx-auto justify-end">Simpan</button>
        </form>
        @else
        <form method="POST" action="{{ route('dashboard-user.updateFile', ['tambahtugas' => $tambahtugas->id]) }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".jpg, .jpeg, .png, .pdf" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2 flex items-end mx-auto justify-end">Simpan</button>
        </form>
        @endif
    </div>    
</div>
@endsection

@push('script')
<script>
    // Ambil semua elemen <td> dengan class "nomor-urut"
    const nomorUrutElems = document.querySelectorAll('.nomor-urut');

    // Update nomor urut pada setiap elemen <td>
    function updateNomorUrut() {
        nomorUrutElems.forEach((elem, index) => {
            elem.textContent = index + 1;
        });
    }

    // Panggil fungsi updateNomorUrut saat halaman selesai dimuat
    window.onload = updateNomorUrut;
</script>
@endpush