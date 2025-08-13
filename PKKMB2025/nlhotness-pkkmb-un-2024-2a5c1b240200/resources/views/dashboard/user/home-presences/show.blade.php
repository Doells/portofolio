@extends('layouts.dashboard.app')

@section('content')
<div class="container">
    <div class="flex flex-col gap-y-5 gap-x-5">
  
        <div class="border px-4 py-4 sm:mb-10 rounded-lg shadow-lg">
            <div class="mb-2">
                @include('partials.attendance-badges')
            </div>
            @include('partials.alerts')

            <h1 class="font-bold text-xl">{{ $attendance->title }}</h1>
            <p class="text-gray-500">{{ $attendance->description }}</p>

            <div class="my-4">
                <span class="shadow-md font-semibold py-2 px-2 rounded-md bg-gray-300">Batas Waktu : {{
                    substr($attendance->data->start_time, 0 , -3) }} - {{
                    substr($attendance->data->batas_start_time,0,-3 )}}</span>
            </div>

            @if ($attendance->data->is_using_qrcode)
            <div class="flex w-full">
                <a href="{{ route('home-presences.presences.qrcode', ['code' => $attendance->code]) }}" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 w-full">Scan QR-Code Masuk</a>
            </div>
            @endif
        </div>
        <div class="border px-4 py-4 mb-3 rounded-lg shadow-lg">
            <h5 class="mb-3">Histori Presensi :</h5>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jam Masuk
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
                            $histo = $history->where('attendance_id', $attendance->id)->first();
                            @endphp
                    
                            {{-- @if ($isWithinSession) --}}
                                <tr class="bg-white border-b">
                                    @if (!$histo)
                                        <td class="px-6 py-4">{{ $attendance->date }}</td>
                                        <td class="px-6 py-4">
                                            @if($attendance->date == now()->toDateString())
                                                <div class="text-center bg-blue-100 text-blue-800 text-xs font-medium px-1 py-0.5 rounded-full">Belum Hadir</div>
                                            @else
                                                <div class="text-center bg-red-100 text-red-800 text-xs font-medium px-1 py-0.5 rounded-full">Tidak Hadir</div>
                                            @endif
                                        </td>
                                    @else
                                        <td class="px-6 py-4">{{ $histo->presence_date }}</td>
                                        <td class="px-6 py-4">{{ $histo->presence_enter_time }}</td>
                                        <td class="px-6 py-4">
                                            @if ($histo->is_permission)
                                                <div class="text-center bg-yellow-100 text-yellow-800 text-xs font-medium px-1 py-0.5 rounded-full">Izin</div>
                                            @else
                                                <div class="text-center bg-green-100 text-green-800 text-xs font-medium px-1 py-0.5 rounded-full">Hadir</div>
                                            @endif
                                        </td>
                                        @if ($histo->is_permission === 0)
                                            <td class="px-6 py-4">
                                                @php
                                                $waktuMasuk = \Carbon\Carbon::parse($histo->presence_enter_time);
                                                $waktuTepatWaktu = \Carbon\Carbon::parse($attendance->start_time);
                                                $waktuAkhirTepatWaktu = \Carbon\Carbon::parse($attendance->batas_start_time); 
                                                @endphp
                                                
                                                @if ($waktuMasuk->between($waktuTepatWaktu, $waktuAkhirTepatWaktu))
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Tepat Waktu</span>
                                                @else
                                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Terlambat</span> 
                                                @endif
                                            </td>
                                        @else
                                            <td class="px-6 py-4">{{ $histo->permission_reason }}</td>
                                        @endif
                                    @endif
                                </tr>
                            {{-- @endif --}}
                        {{-- @endforeach --}}
                    </tbody>                                     
                </table>
            </div>
        </div>
    </div>
</div>
@endsection