@extends('layouts.landing.base')

@section('content')
    <section id="news" class="h-screen w-full bg-[#000000]">
        <img 
            src="{{ asset('/src/img/hero/2/blink_blink.png') }}" 
            alt="blink_blink" 
            class="absolute lg:ml-60 h-screen object-cover z-1"
            data-aos="fade-zoom-in"
            data-aos-easing="ease-in-back"
            data-aos-duration="1000"
            data-aos-offset="0"
        >
        <img 
            src="{{ asset('/src/img/hero/2/clip_path_group.png') }}" 
            alt="clip_path_group" 
            class="absolute mt-0 ml-0 h-screen object-cover z-0 filter grayscale"
            data-aos="fade-zoom-in"
            data-aos-easing="ease-in-back"
            data-aos-duration="1000"
            data-aos-offset="0"
        >

        <div class="absolute w-full h-screen flex flex-col items-center text-center pt-56 lg:pt-28 z-10">
            <h2 
                id="title" 
                class="text-white text-3xl lg:text-5xl font-extrabold mb-3 lg:mb-5 z-10"
                data-aos="fade-up"
                data-aos-anchor-placement="center-bottom"
                data-aos-delay="1200"
            >
                Perbanyak Informasimu <br>
                Perluas Wawasanmu
            </h2>
            
            <h3 
                id="text1" 
                class="text-white text-sm lg:text-base font-light mb-5 lg:mb-10 z-10"
                data-aos="fade-up"
                data-aos-easing="linear"
                data-aos-delay="1500"
                data-aos-duration="500"
            >
                Dunia terus berubah, Maka ikuti perkembangan Informasi <br>
                Informasi dapat membantumu untuk dapatkan ide-ide terbaru
            </h3>
            
            <a 
                href="{{ route('informasi-berita') }}"
                data-aos="fade-zoom-in"
                data-aos-easing="ease-in-back"
                data-aos-delay="2500"
                data-aos-duration="1000"
                data-aos-offset="0"
            >
                <button class="bg-white px-7 py-2 z-10 text-black text-base rounded-lg mb-12">
                    Selengkapnya
                </button>
            </a>

            <img
                src="/src/img/information/1/card.png" 
                alt="card" 
                class="h-48 lg:h-52 z-10"
                data-aos="fade-up"
                data-aos-delay="1500"
                data-aos-duration="3000"
            >
        </div>
    </section>

    <section id="infopkkmb" class="h-screen w-full bg-[#000000]">
        <img 
            src="{{ asset('/src/img/information/2/clip_path_group.png') }}" 
            alt="clip_path_group" 
            class="absolute mt-0 ml-0 h-screen object-cover filter grayscale"
            data-aos="fade-zoom-in"
            data-aos-easing="ease-in-back"
            data-aos-duration="1000"
            data-aos-offset="0"
        >
        <img 
            src="{{ asset('/src/img/information/2/pkkmb_2024.png') }}" 
            alt="pkkmb_2024" 
            class="absolute lg:ml-10 lg:mt-36 object-cover filter grayscale"
            data-aos="fade-zoom-in"
            data-aos-easing="ease-in-back"
            data-aos-duration="1000"
            data-aos-offset="0"
        >
        <img 
            src="{{ asset('/src/img/information/2/pkkmb_2024.png') }}" 
            alt="pkkmb_2024" 
            class="absolute mt-150 lg:ml-100 lg:mt-125 object-cover filter grayscale"
            data-aos="fade-zoom-in"
            data-aos-easing="ease-in-back"
            data-aos-duration="1000"
            data-aos-offset="0"
        >

        <div class="absolute w-full h-screen flex flex-col items-center text-center pt-28">
            <h2 
                id="title" 
                class="text-white text-3xl lg:text-5xl font-extrabold mb-3 lg:mb-5 text-glow"
                data-aos="fade-up"
                data-aos-anchor-placement="center-bottom"
                data-aos-delay="1200"
            >
                Carilah Informasi Terbaik <br>
                Untuk Menunjangan Kegiatanmu
            </h2>
            
            <h3 
                id="text1" 
                class="text-white text-sm lg:text-base font-light mb-5 lg:mb-10"
                data-aos="fade-up"
                data-aos-easing="linear"
                data-aos-delay="1500"
                data-aos-duration="500"
            >
                Dengan informasi terbaik langkahmu semakin lancar <br>
                Dengan informasi terbaik jalanmu semakin mudah
            </h3>
            
            <div class="grid grid-cols-3 gap-5 mx-3">
                <div>
                    <img src="{{asset('/src/img/information/2/profil.png')}}" class="w-[150px] h-[200px]" alt="profil.png">
                </div>
                <div class="flex my-auto">
                    <a 
                        href="{{ route('informasi-kegiatan') }}"
                        class="w-full bg-white  py-2 text-black text-base rounded-lg"
                        data-aos="fade-zoom-in"
                        data-aos-easing="ease-in-back"
                        data-aos-delay="2500"
                        data-aos-duration="1000"
                        data-aos-offset="0"
                    >
                        Selengkapnya
                    </a>
                </div>
                <div>
                    <img src="{{asset('/src/img/information/2/sijagad_semangat.png')}}" class="w-[150px] h-[200px]" alt="sijagad_semangat.png">
                </div>
            </div>

        </div>
    </section>

    <section id="announcement" class="h-screen w-full bg-[#000000]">

        <div>
            <div class="absolute w-full h-screen flex flex-col items-center text-center pt-56 lg:pt-28 ">
                <h2 
                    id="title" 
                    class="text-white text-3xl lg:text-5xl font-extrabold mb-3 lg:mb-5 text-glow lg:pt-28 z-10"
                    data-aos="fade-up"
                    data-aos-anchor-placement="center-bottom"
                    data-aos-delay="1200"
                >
                    Berjuang Sungguh-Sungguh <br>
                    Mendapat Hasil Kemudian
                </h2>
                <img 
                    src="{{ asset('/src/img/information/3/group_88.png') }}" 
                    alt="bintang" 
                    class="absolute object-cover items-center w-[800px] z-0"
                    data-aos="fade-zoom-in"
                    data-aos-easing="ease-in-back"
                    data-aos-duration="1000"
                    data-aos-offset="0"
                >
                
                <h3 
                    id="text1" 
                    class="text-white text-sm lg:text-base font-light mb-5 lg:mb-10  z-10"
                    data-aos="fade-up"
                    data-aos-easing="linear"
                    data-aos-delay="1500"
                    data-aos-duration="500"
                >
                    Perjuanganmu tidak mungkin sia-sia <br>
                    Hasilmu saat ini adalah perjuanganmu dimasa lampau
                </h3>
    
                {{-- <div class=" z-10">
                    <a 
                        href="{{ route('pengumuman-landing') }}"
                        class="w-full px-5 py-2 text-black text-base rounded-lg bg-white z-10"
                        data-aos="fade-zoom-in"
                        data-aos-easing="ease-in-back"
                        data-aos-delay="2500"
                        data-aos-duration="1000"
                        data-aos-offset="0"
                    >
                        Cek Sekarang
                    </a>
                </div> --}}
                
            </div>
        </div>
    </section>
@endsection

@push('javascript')
@endpush