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
    <div class="p-4 bg-white rounded-lg md:p-8 border shadow-md my-4">
        <h2 class="mb-2 text-2xl font-extrabold tracking-tight text-gray-900">Deskripsi :</h2>
        {{$tambahtugas->description}}
    </div>
    <div class="p-4 bg-white rounded-lg md:p-8 border shadow-md my-4">
        <h2 class="mb-2 text-2xl font-extrabold tracking-tight text-gray-900">Lampiran :</h2>
        @if ($tambahtugas->files)
            <a href="{{ url(Storage::url($tambahtugas->files->file_path)) }}" target="_blank" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2 items-end mx-auto justify-end">Lihat</a>
            <a href="{{ url(Storage::url($tambahtugas->files->file_path)) }}" download="{{ $tambahtugas->files->file_name }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2 items-end mx-auto justify-end">Download</a>
        @else
            Tidak ada lampiran
        @endif
    </div>
    @include('partials.alerts')
    @php
        $histo = $history->where('tambahtugas_id', $tambahtugas->id)->first();
    @endphp
    @if ($histo)
        <div class="border px-4 py-4 mb-3 rounded-lg shadow-lg">
            <h5 class="mb-3 font-bold">Jawaban :</h5>
            @if ($tambahtugas->input_type == 'Text')
            <div class="flex">
                <a rel="stylesheet" href="{{ $histo->text }}" class="text-blue-500 hover:text-blue-700 hover:underline">{{ $histo->text }}</a>
                <a type="button" href="{{ route('dashboard-user.taskedit', ['id' => $histo->id]) }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2 items-end mx-auto justify-end">Edit</a>
            </div>
            @else
                <h3 class="mb-5"><span class="font-semibold">Tugas : </span>"{{ $histo->tambahtugas->title }}"</h3>
                <div class="flex-row">
                    @if (!empty($histo) && !empty($histo->files))
                    <!-- Loop through files and display file names -->
                    @foreach ($histo->files as $file)
                        <a href="{{ url(Storage::url($file->file_path)) }}" target="_blank" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2 items-end mx-auto justify-end">Lihat</a>
                        <a href="{{ url(Storage::url($file->file_path)) }}" download="{{ $file->file_name }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2 items-end mx-auto justify-end">Download</a>
                    @endforeach
                    @else
                        <p>Tidak ada file terkait tugas ini.</p>
                    @endif
                    <a type="button" href="{{ route('dashboard-user.fileedit', ['id' => $histo->id]) }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2 items-end mx-auto justify-end">Edit</a>
                </div>
            @endif
        </div>
    @else
        <div class="border px-4 py-4 mb-3 rounded-lg shadow-lg">
            <h5 class="mb-3 font-bold">Form Pengumpulan Tugas "{{ $tambahtugas->title }}" : </h5>
            @if ($tambahtugas->input_type == 'Text')
            <form method="POST" action="{{ route('dashboard-user.sendTask', ['tambahtugas' => $tambahtugas->id]) }}">
                @csrf
                <input type="url" name="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2 flex items-end mx-auto justify-end">Unggah</button>
            </form>  
            @else
            <form method="POST" action="{{ route('dashboard-user.uploadFile', ['tambahtugas' => $tambahtugas->id]) }}" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" accept=".jpg, .jpeg, .png, .pdf" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2 flex items-end mx-auto justify-end">Unggah</button>
            </form>    
            @endif
        </div>
    @endif
    
    <div class="border px-4 py-4 mb-3 rounded-lg shadow-lg">
        <h5 class="mb-3 font-bold">Histori Tugas :</h5>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Waktu Unggah
                        </th>
                        {{-- <th scope="col" class="px-6 py-3">
                            Jam Keluar
                        </th> --}}
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keterangan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($priodDate as $date) --}}
                        @php
                        $histo = $history->where('tambahtugas_id', $tambahtugas->id)->first();
                        @endphp
                        {{-- @if ($isWithinSession) --}}
                            <tr class="bg-white border-b">
                                @if (!$histo)
                                    <td class="px-6 py-4">{{ $tambahtugas->start_date }} - {{ $tambahtugas->end_date }}</td>
                                    <td class="px-6 py-4">-</td>
                                    <td class="px-6 py-4">
                                        @if($tambahtugas->end_date >= now()->toDateString())
                                            <div class="text-center bg-blue-100 text-blue-800 text-xs font-medium px-1 py-0.5 rounded-full">Belum Mengerjakan</div>
                                        @else
                                            <div class="text-center bg-red-100 text-red-800 text-xs font-medium px-1 py-0.5 rounded-full">Tidak Mengerjakan</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">-</td>
                                @else
                                    <td class="px-6 py-4">{{ $histo->submit_date }}</td>
                                    <td class="px-6 py-4">{{ $histo->submit_enter_time }}</td>
                                    <td class="px-6 py-4">
                                        @if ($histo->status == 'Terkirim')
                                            <div class="text-center bg-blue-100 text-blue-800 text-xs font-medium px-1 py-0.5 rounded-full">Terkirim</div>
                                        @elseif ($histo->status == 'Proses')
                                            <div class="text-center bg-yellow-100 text-yellow-800 text-xs font-medium px-1 py-0.5 rounded-full">Diproses</div>
                                        @elseif ($histo->status == "Revisi")
                                            <div class="text-center bg-red-100 text-red-800 text-xs font-medium px-1 py-0.5 rounded-full">Revisi</div>
                                        @elseif ($histo->status == "Diterima")
                                            <div class="text-center bg-green-100 text-green-800 text-xs font-medium px-1 py-0.5 rounded-full">Diterima</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                        $waktuMasuk = \Carbon\Carbon::parse($histo->submit_enter_time);
                                        $waktuTepatWaktu = \Carbon\Carbon::parse($tambahtugas->start_time);
                                        $waktuAkhirTepatWaktu = \Carbon\Carbon::parse($tambahtugas->batas_start_time); 
                                        $tanggalTepatWaktu = \Carbon\Carbon::parse($tambahtugas->start_date); 
                                        $tanggalAkhirTepatWaktu = \Carbon\Carbon::parse($tambahtugas->end_date); 
                                        $tanggalMasuk = \Carbon\Carbon::parse($histo->submit_date)
                                        @endphp
                                        
                                        @if ($waktuMasuk->isBefore($waktuAkhirTepatWaktu) && $tanggalMasuk->between($tanggalTepatWaktu, $tanggalAkhirTepatWaktu))
                                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Tepat Waktu</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Terlambat</span> 
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        {{-- @endif --}}
                    {{-- @endforeach --}}
                </tbody>                                     
            </table>
        </div>
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