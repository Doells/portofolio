@extends('layouts.dashboard.app')

@section('buttons')
<div class="btn-toolbar mb-2 mb-md-0">
    <div>
        <button class="btn btn-sm btn-light" onclick="goBack()">
            <span data-feather="arrow-left-circle" class="align-text-bottom"></span>
            Kembali
        </button>
    </div>
</div>
@endsection

@section('content')
<div class="container py-5">
    <div class="p-4 bg-white rounded-lg md:p-8 border shadow-md my-4">
        <h2 class="mb-2 text-2xl font-extrabold tracking-tight text-gray-900">Data {{ $task->user->position->name }} PKKMB :</h2>
        <!-- List -->
        <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400">
            <li class="flex space-x-2 items-center">
                <span class="leading-tight">Nama : </span>
                <span>{{ $task->user->name }}</span>
            </li>
            <li class="flex space-x-2 items-center">
                <span class="leading-tight">NIM : </span>
                <span>{{ $task->user->nim }}</span>
            </li>
            <li class="flex space-x-2 items-center">
                <span class="leading-tight">Program Studi : </span>
                <span>{{ $task->user->detailuser->prodi }}</span>
            </li>
            <li class="flex space-x-2 items-center">
                <span class="leading-tight">Fakultas : </span>
                <span>{{ $task->user->detailuser->fakultas }}</span>
            </li>
            <li class="flex space-x-2 items-center">
                <span class="leading-tight">Kelompok : </span>
                <span>{{ $task->user->kelompok->name ?? 'Belum masuk kelompok' }}</span>
            </li>
            @include('partials.alerts')
            <h2 class="mb-2 text-2xl font-extrabold tracking-tight text-gray-900 border-t-2">Jawaban : 
                @if ($task->status == 'Terkirim')
                    <span class="text-center bg-blue-100 text-blue-800 text-xs font-medium px-1 py-0.5 rounded-full">Terkirim</span>
                @elseif ($task->status == 'Proses')
                    <span class="text-center bg-yellow-100 text-yellow-800 text-xs font-medium px-1 py-0.5 rounded-full">Diproses</span>
                @elseif ($task->status == "Revisi")
                    <span class="text-center bg-red-100 text-red-800 text-xs font-medium px-1 py-0.5 rounded-full">Revisi</span>
                @elseif ($task->status == "Diterima")
                    <span class="text-center bg-green-100 text-green-800 text-xs font-medium px-1 py-0.5 rounded-full">Diterima</span>
                @endif
            </h2>
            <h3 class="mb-2 text-lg font-semibold">URL : </h3>
            <li class="flex space-x-2 items-center">
                @if ($task->text === null)
                    <div class="text-gray-500">Tidak ada link untuk tugas ini</div>
                @else
                    <a href="{{ $task->text }}" target="_blank" class="text-blue-500 hover:text-blue-700 hover:underline">{{ $task->text ?? 'Data Tidak Ada' }}</a>
                @endif
            </li>
            <!-- Menampilkan file yang terkait dengan tugas -->
            @if ($task->files->count() > 0)
            <h3 class="mb-2 text-lg font-semibold">File Terkait:</h3>
            <ul>
                @foreach ($task->files as $file)
                    <li>
                        <a href="{{ url(Storage::url($file->file_path)) }}" target="_blank" class="text-blue-500 hover:text-blue-700 hover:underline" download="{{ $file->file_name }}">Download {{ $file->file_name }}</a>
                    </li>
                @endforeach
            </ul>
            <ul>
                @foreach ($task->files as $file)
                    <li>
                        <a href="{{ url(Storage::url($file->file_path)) }}" target="_blank" class="text-blue-500 hover:text-blue-700 hover:underline">Lihat {{ $file->file_name }}</a>
                    </li>
                @endforeach
            </ul>
            @else
            <p>Tidak ada file terkait dengan tugas ini.</p>
            @endif
            <form action="{{ route('result-task.updateStatus', ['task' => $task->id]) }}" method="POST">
                @csrf
                @method('PUT')
            
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="Terkirim" {{ $task->status === 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                    <option value="Proses" {{ $task->status === 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Revisi" {{ $task->status === 'Revisi' ? 'selected' : '' }}>Revisi</option>
                    <option value="Diterima" {{ $task->status === 'Diterima' ? 'selected' : '' }}>Diterima</option>
                </select>
            
                <div class="flex items-center justify-between mt-4">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Simpan
                    </button>
                </div>
            </form>            
        </ul>
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
<script>
    function goBack() {
        window.history.back();
    }
</script>
@endpush