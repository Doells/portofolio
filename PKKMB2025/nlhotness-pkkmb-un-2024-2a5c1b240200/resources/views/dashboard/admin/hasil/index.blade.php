@extends('layouts.dashboard.app')

@section('content')            
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto lg:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-6 mb-1 text-2xl font-semibold text-gray-700">
                        Data Kelulusan Peserta
                    </h2>
                    <p class="text-sm text-gray-400">
                        Keterangan :
                    </p>
                    <p class="text-sm text-gray-400">
                        Total {{ count($peserta) }} Peserta
                    </p>
                    <p class="text-sm text-gray-400">
                        Total Tugas = {{ $taskCount }}
                    </p>
                    <p class="text-sm text-gray-400">
                        Total Presensi = {{ $presencesCount }}
                    </p>
                </div>
            </div>
        </div>
        <div class="w-full">
            <form action="{{ route('hasil.export-excel') }}" method="POST" target="__blank">
                @csrf
                <div class="w-full mx-auto">
                    <button type="submit" class="flex mx-auto text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        Export Excel
                    </button>
                </div>
            </form>
        </div>
        @if ($peserta)
            <section class="container px-6 mx-auto mt-5">
                <div class="grid gap-5 lg:grid-cols-12">
                    <main class="col-span-12 p-4 lg:pt-0">
                        <div class="px-6 py-2 mt-2 bg-white rounded-lg">
                            <table class="w-full" aria-label="Table">
                                <thead>
                                    <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                        <th class="py-4" scope="">No</th>
                                        <th class="py-4" scope="">Nim</th>
                                        <th class="py-4" scope="">Nama Peserta</th>
                                        <th class="py-4" scope="">Kelompok</th>
                                        <th class="py-4" scope="">Presensi</th>
                                        <th class="py-4" scope="">Izin</th>
                                        <th class="py-4" scope="">Tugas</th>
                                        <th class="py-4" scope="">Pelanggaran</th>
                                        <th class="py-4" scope="">Keputusan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($peserta as $key => $item)
                                        <tr class="text-gray-700 border-b">
                                            <td class="">
                                                {{ $key + 1 }}
                                            </td>
                                            <td class="px-1 py-5">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <h2 class="font-medium text-black">
                                                            {{ $item->nim ?? '' }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-1/3 px-1 py-5">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <h2 class="font-medium text-black">
                                                            {{ ucfirst($item->name ?? '') }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-1 py-5">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <h2 class="font-medium text-black">
                                                            {{ $item->kelompok_id ?? '' }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-1 py-5">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <h2 class="font-medium text-black">
                                                            {{ optional($item->submitPresensi->where('is_permission', 0))->count() ?? 0 }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </td>                                                                                                                                                                                                                 
                                            <td class="px-1 py-5">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <h2 class="font-medium text-black">
                                                            {{ optional($item->submitPresensi->where('is_permission', 1))->count() ?? 0 }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </td>                                                                                                                                                                                                                 
                                            <td class="px-1 py-5">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <h2 class="font-medium text-black">
                                                            {{ optional($item->submitTugas->where('status', 'Diterima'))->count() ?? 0 }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </td>                                                                                                                                                                                                                 
                                            <td class="px-1 py-5">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <h2 class="font-medium text-black">
                                                            @php
                                                                $totalPoin = 0;
                                                                foreach ($item->pelanggaran_peserta as $pelanggaran) {
                                                                    $totalPoin += $pelanggaran->poin;
                                                                }
                                                                echo $totalPoin;
                                                            @endphp
                                                        </h2>
                                                    </div>
                                                </div>
                                            </td>                                                                                                                                                                                                                 
                                            <td class="px-1 py-5">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        @php
                                                            $presensiMasuk = optional($item->submitPresensi)->count() ?? 0;
                                                            //$totalIzin = optional($item->submitPresensi)->where('is_permission', 1)->count() ?? 0;
                                                            $tugasDikerjakan = optional($item->submitTugas->where('status', 'Diterima'))->count() ?? 0;
                                                            $totalPelanggaran = $item->pelanggaran_peserta->sum('poin');
                                                            
                                                            //total
                                                            $totalPresensi = ($presensiMasuk / $presencesCount) * 100;
                                                            $totalTugas = ($tugasDikerjakan / $taskCount) * 100;
                                                            $ketaatan = 100 - $totalPelanggaran;
                                                            $totalSkor = ($totalPresensi + $totalTugas + $ketaatan) / 3;
                                            
                                                            $keputusan = '';
                                            
                                                            if ($totalSkor <= 40) {
                                                                $keputusan = 'Tidak Lulus';
                                                            } elseif ($totalSkor >= 80) {
                                                                $keputusan = 'Lulus';
                                                            } else {
                                                                $keputusan = 'Lulus Bersyarat';
                                                            }
                                                        @endphp
                                                        <h2 class="font-medium text-black">
                                                            {{ $keputusan }}
                                                        </h2>
                                                            Presensi {{ $totalPresensi }}%
                                                            Tugas {{ $totalTugas }}%
                                                            Ketaatan {{ $ketaatan }}%
                                                    </div>
                                                </div>
                                            </td>                                                                                                                                                                                                                                                           
                                        </tr>
                                    @endforeach
                                </tbody>                                
                            </table>
                        </div>
                    </main>
                </div>
            </section>    
        @else
            <div class="flex w-full pt-2 lg:pt-8">
                <div class="m-auto text-center">
                    <img src="{{ asset('/src/img/maskot_pkkmb_maaf_2.png') }}" alt="" class="w-32 mx-auto mb-2">

                    <h2 class="mb-1 text-2xl lg:text-3xl font-semibold text-gray-700">
                        Anda belum memiliki peserta
                    </h2>
                    
                    <p class="text-sm lg:text-base text-gray-400 mb-4">
                        Sepertinya Anda belum memiliki peserta. <br>
                        Silahkan, tambahkan pesertamu dulu!
                    </p>

                    <div class="relative">
                        <a href="{{ route('students.create') }}" class="px-4 py-2 mt-10 lg:mt-2 text-left text-white rounded-md lg:rounded-xl bg-space-textungu">
                            + Tambah Peserta
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection