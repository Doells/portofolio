@extends('layouts.landing.base')

@section('content')
    <section class="w-full bg-[#000000] pt-10 lg:pt-36 px-6 lg:px-28">
        <div class="flex flex-col items-center">
            <div class="flex flex-col items-center mb-5 lg:mb-10">
                <img class="w-20 lg:w-28 bg-white rounded-lg mb-5" src="{{ asset('/src/img/logo/logo.png') }}" alt="logo" />
                <h1 class="uppercase text-white font-extrabold text-2xl leading-none lg:text-4xl text-center mb-1">{{ strtoupper($news->title ?? '') }}</h1>
                <h2 class="text-slate-300 text-sm lg:text-base font-medium">Dibuat pada tanggal {{ $news->created_at ? $news->created_at->translatedFormat('l, j F Y') : '' }}</h2>
            </div>

            <img class="w-full mb-10" data-lity src="{{ url(Storage::url($news->thumbnail_news[0]->thumbnail)) }}" alt="thumbnail">

            <p class="text-white px-6 lg:px-20 text-base text-justify mb-10 lg:mb-28">
                <span class="font-bold text-white">PKKMB Universitas Narotama 2024 - </span> {{ $news->description ?? '' }}
            </p>
        </div>
    </section>
@endsection