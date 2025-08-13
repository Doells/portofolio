@extends('layouts.dashboard.app')

@section('content')
    <!-- ====== Profile Section Start -->
    <div
        class="overflow-hidden rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <h1 class="my-10 font-bold text-[20px] mx-10">
            Kirim Presensi - Sesi {{$dataSesiPresensi->title}}
        </h1>
        <h1 class="mb-5 mx-10">
            @props(['start_time', 'batas_start_time'])

            @php
                use Carbon\Carbon;
                $startTime = Carbon::parse($dataSesiPresensi->start_time);
                $batasStartTime = Carbon::parse($dataSesiPresensi->batas_start_time);
            @endphp
            
            <p>Jam: {{$startTime}} - {{$batasStartTime}}</p>
            
        </h1>
        <div class="px-4 pb-6 text-center lg:pb-8 xl:pb-11.5">
            <form method="POST" action="{{route('sendEnterPresenceUsingQRCode')}}" class="container px-10 lg:mx-auto">
                @csrf
                <div class="relative z-0 w-full mb-6 group">
                    <label for="status_presensi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Status Kehadiran :</label>
                    @if ($statusPresensi)                        
                        <div class="bg-green-500 text-white px-5 py-2 rounded-md text-[20px] justify-start w-1/2 whitespace-nowrap max-sm:w-full">
                            Sudah Presensi
                        </div>
                    @else
                        <div class="bg-red-500 text-white px-5 py-2 rounded-md text-[20px] justify-start w-1/2 whitespace-nowrap max-sm:w-full">
                            Belum Presensi
                        </div>
                    @endif
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="NIM" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">NIM</label>
                    <input type="text" name="floating_name" id="floating_name" class="block py-2.5  w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ $dataUser->nim }}" required disabled />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Nama</label>
                    <input type="text" name="floating_nim" id="floating_nim" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ $dataUser->name }}" required disabled />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Kelompok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Kelompok</label>
                    <input type="text" name="kelompok" id="kelompok" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ $dataUser->kelompok->name  ?? 'Belum masuk kelompok'  }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Posisi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Posisi</label>
                    <input type="text" name="position" id="position" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ $dataUser->position->name }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Prodi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Program Studi</label>
                    <input type="text" name="major" id="floating_major" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ $dataUser->detailuser->prodi }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Fakultas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Fakultas</label>
                    <input type="text" name="fakultas" id="fakultas" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ $dataUser->detailuser->fakultas }}" disabled/>
                </div>
                <input value="{{$code}}" type="hidden" name="code" id="code">
                <div class="w-full flex justify-end gap-x-3">
                    <div class="">
                        <button type="button" href="{{ route('home-presences.indexuserdashboard') }}" class="text-gray-500 hover:text-white bg-slate-200 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 mt-6 text-center nx-2">Kembali</button>
                    </div>  
                    <div class="">
                        <button type="submit" href="{{ route('sendEnterPresenceUsingQRCode') }}" class="text-white hover:text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 mt-6 text-center nx-2">Kirim</button>
                    </div>  
                </div>
            </form>      
        </div>
    </div>
    <!-- ====== Profile Section End -->
@endsection

@push('js')
@endpush