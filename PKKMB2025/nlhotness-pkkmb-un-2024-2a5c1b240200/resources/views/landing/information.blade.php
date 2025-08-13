@extends('layouts.landing.base')

@push('stylesheet')
    <style>
        .--segmented-controls {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
            color: #33458F;
            border-radius: 25px;
            padding: 0;
        }

        .--segmented-controls > .--segmented-control-item {
            display: flex;
            list-style: none;
            text-align: center;
            height: 100%;
            padding: .5em 0;
        }

        .--segmented-control-item > * {
            margin: auto;
            font-weight: bold;
        }

        .--segmented-controls > .--segmented-control-active {
            background-color: #f9faff !important;
            color: #FFFFFF !important;
            border-radius: 25px;
            -webkit-transition: all ease-in-out 0.6s;
            -moz-transition: all ease-in-out 0.6s;
            -ms-transition: all ease-in-out 0.6s;
            -o-transition: all ease-in-out 0.6s;
            transition: all ease-in-out 0.6s;
        }

        .--segmented-content {
            width: 100%;
            background-color: #F3F5FA;
            color: #000000;
            padding: 2em 3em;
            border-radius: 20px;
        }

        .--underlined {
            margin: 1em auto;
            width: 500px;
            height: 1px;
            border: 2px solid #F89D08;
        }

        @media only screen
        and (max-width: 768px) {
            .--segmented-controls {
                height: 150px;
                grid-template-columns: 1fr;
            }

            .--underlined {
                width: 200px;
            }
        }

        .--btn-primary {
            color: white;
            background: #56D7BC;
            border-radius: 10px;
            padding: 1em 2em;
        }
    </style>
@endpush

@section('content')
    {{-- Hero Page --}}
    <section id="hero" class="lg:h-screen w-full bg-[#000000] flex items-center">
        <img 
          src="{{ asset('/src/img/information/1/bg.jpg') }}" 
          alt="bg.jpg" 
          class="hidden lg:block absolute mt-0 ml-0 h-screen w-full object-cover filter grayscale"
          data-aos="fade-zoom-in"
          data-aos-easing="ease-in-back"
          data-aos-delay="1000"
          data-aos-duration="1000"
          data-aos-offset="0"
        >

        <div class="lg:absolute w-full h-screen flex flex-col items-center text-center pt-56 lg:pt-36">
            <img 
                src="{{ asset('/src/img/information/1/logo_pkkmb.png') }}" 
                alt="logo.png"
                class="flex items-center bg-white px-5 py-2 rounded-lg h-28 lg:h-80 shadow-lg"
                data-aos="zoom-in-up"
                data-aos-delay="1500"
                data-aos-duration="1000"
            >
        </div>
    </section>


    {{-- Content --}}
    <section id="informasi-kegiatan">
        <div class="w-full">
            <div class="tab bg-[#000000]">
                <ul class="flex flex-col lg:flex-row text-base text-center text-white">
                    <li class="w-full">
                        <button class="tablinks inline-block border-b-2 border-[#FFC300] py-2 lg:py-8 w-full text-base text-center text-gray-400 hover:text-gray-700 hover:bg-slate-100" onclick="openCity(event, 'pengenalan')" id="defaultOpen">
                            Pengenalan
                        </button>
                    </li>
                    <li class="w-full">
                        <button class="tablinks inline-block border-b-2 border-[#FFC300] py-2 lg:py-8 w-full text-base text-center text-gray-400 hover:text-gray-700 hover:bg-slate-100" onclick="openCity(event, 'pedoman')">
                            Pedoman
                        </button>
                    </li>
                    <li class="w-full">
                        <button class="tablinks inline-block border-b-2 border-[#FFC300] py-2 lg:py-8 w-full text-base text-center text-gray-400 hover:text-gray-700 hover:bg-slate-100" onclick="openCity(event, 'seragam')">
                            Seragam
                        </button>
                    </li>
                    <li class="w-full">
                        <button class="tablinks inline-block border-b-2 border-[#FFC300] py-2 lg:py-8 w-full text-base text-center text-gray-400 hover:text-gray-700 hover:bg-slate-100" onclick="openCity(event, 'jadwal')">
                            Jadwal
                        </button>
                    </li>
                    <li class="w-full">
                        <button class="tablinks inline-block border-b-2 border-[#FFC300] py-2 lg:py-8 w-full text-base text-center text-gray-400 hover:text-gray-700 hover:bg-slate-100" onclick="openCity(event, 'tugas')">
                            Tugas
                        </button>
                    </li>
                </ul>
            </div>
            <div>
                <div id="pengenalan" class="tabcontent">
                    @include('components.informasi.kegiatan.pengenalan')
                </div>

                <div id="pedoman" class="tabcontent">
                    @include('components.informasi.kegiatan.pedoman')
                </div>

                <div id="seragam" class="tabcontent">
                    @include('components.informasi.kegiatan.seragam')
                </div>

                <div id="jadwal" class="tabcontent">
                    @include('components.informasi.kegiatan.jadwal')
                </div>

                <div id="tugas" class="tabcontent">
                    @include('components.informasi.kegiatan.tugas')
                </div>
            </div>
        </div>
    </section>


@endsection

@push('javascript')
@endpush