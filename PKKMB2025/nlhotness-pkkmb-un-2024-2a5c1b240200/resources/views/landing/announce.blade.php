@extends('layouts.landing.base')

@section('content')
<div class="w-full h-screen py-[100px]">
    <div class="container flex items-center justify-center mx-auto bg-white rounded-[43px]">
        <div class="items-center text-center">
            <div class="pb-5 container mx-auto">
              <div class="font-bold text-2xl">
                <h1 class="mb-4 font-poppins font-extrabold text-[38px] lg:text-[64px] text-[#33458F]">
                    PENGUMUMAN
                </h1>
              </div>
                <img src="src/img/PKKMB 1.png" title="PKKMB 1.png" class="container mx-auto w-1/2 h-1/2 border-b-8 border-[#FF9B2F]"/>
            </div>
        </div>
    </div>
    <div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 gap-x-6 rounded-[40px] border-4 mb-[100px]">
        <div class="container bg-gray-400 rounded-[40px]">
            <div class="my-5 mx-10">
                {{-- Sertifikat disini --}}
            </div>
        </div>
        <div class="container sm:mx-auto text-center">
            <div class="text-[60px] text-[#31438D] font-extrabold text-center">SELAMAT</div>
            <div class="text-[48px] text-[#31438D] font-medium text-center">Anda Telah Lulus</div>
            <div class="text-[60px] text-[#31438D] font-semibold text-center">PKKMB</div>
            <div>
                <div>Unduh sertifikat anda disini!</div>
                <button type="button" id="unduh" class="w-1/2 py-4 bg-[#F89D08] text-white text-[18px] font-semibold hover:bg-[#FFC484] rounded-[10px] my-10 items-center">Unduh Sertifikat</button>
            </div>
        </div>
    </div>
<div>
@endsection

@push('js')
    
@endpush