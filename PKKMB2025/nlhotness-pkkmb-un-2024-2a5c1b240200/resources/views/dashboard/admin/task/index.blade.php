@extends('layouts.dashboard.app')

@section('content')
@include('partials.alerts')

<div class="">
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama/Judul
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deskripsi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal Mulai
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal Selesai
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Waktu Mulai
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Waktu Selesai
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipe Input
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($tambahtugas as $item)    
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->description }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->start_date }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->end_date }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->start_time }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->batas_start_time }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->input_type }}
                    </td>
                    <td class="px-6 py-4">
                        @include('partials.task-badges')
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('result-task.show', $item->id) }}" class="text-blue-500 hover:underline">Lihat</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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