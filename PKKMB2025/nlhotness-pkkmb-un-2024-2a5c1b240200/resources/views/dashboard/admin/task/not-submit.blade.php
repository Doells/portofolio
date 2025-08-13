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
@include('partials.alerts')

<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <h5 class="font-bold text-lg">Judul : {{ $tambahTugas->title }}</h5>
                <h6 class="text-sm">Deskripsi : {{ $tambahTugas->description }}</h6>
                <div class="d-flex align-items-center gap-2">
                    <span href="" class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">Tidak Mengumpulkan</span>
                </div>
            </div>
        </div>
    </div>
</div>

@if (!empty($notSubmitDate) && count($notSubmitDate) === 0)
    <small class="text-danger fw-bold">Tidak ada data yang bisa ditampilkan</small>
@endif
<div>
    @foreach ($notSubmitData as $data)
    @php
        $notSubmitDate = is_array($data['not_submit_date']) ? $data['not_submit_date'][0] : $data['not_submit_date'];
        $sessionDate = is_array($tambahTugas->start_date) ? $tambahTugas->start_date[0] : $tambahTugas->start_date;
        
        $notSubmitDate = \Carbon\Carbon::parse($notSubmitDate);
        $sessionDate = \Carbon\Carbon::parse($sessionDate);
    @endphp

        <div class="p-3 rounded bg-white border border-gray-400 mb-4">
            <div>Hari : <span class="font-bold">{{ \Carbon\Carbon::parse($tambahTugas->start_date)->isoFormat('dddd') }} - {{ \Carbon\Carbon::parse($tambahTugas->end_date)->isoFormat('dddd') }}</span></div>
            <div>Tanggal : <span class="font-bold">{{ \Carbon\Carbon::parse($tambahTugas->start_date)->isoFormat('D MMMM Y') }} - {{ \Carbon\Carbon::parse($tambahTugas->end_date)->isoFormat('D MMMM Y') }}</span></div>
            <div>Jumlah : <span class="font-bold">{{ count($data['users']) }}</span></div>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NIM
                        </th>
                        {{-- <th scope="col" class="px-6 py-3">
                            Posisi
                        </th> --}}
                        <th scope="col" class="px-6 py-3">
                            Kelompok
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($data['users'] as $user)    
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user['name'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user['nim'] }}
                        </td>
                        {{-- <td class="px-6 py-4">
                            @if (isset($user['position']) && isset($user['position']['name']))
                                {{ $user['position']['name'] }}
                            @else
                                Posisi Tidak Tersedia
                            @endif
                        </td>   --}}                      
                        <td class="px-6 py-4">
                            @if (isset($user['kelompok']) && isset($user['kelompok']['name']))
                                {{ $user['kelompok']['name'] }}
                            @else
                                Nama Kelompok Tidak Tersedia
                            @endif
                        </td>                        
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>

@endsection

<script>
    function goBack() {
        window.history.back();
    }
</script>