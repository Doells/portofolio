<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.landing.meta')

    @include('partials.fonts')
    @include('partials.tailwindstyles')
    @stack('style')

    <title>Beranda | PKKMB Narotama 2024</title>

    @stack('before-style')

    @include('includes.landing.style')

    @stack('after-style')
</head>

<body class="antialiased font-poppins">
    <div class="relative">
        @include('includes.landing.navbarlanding')

        <section id="hero" class="lg:h-screen w-full bg-black lg:relative flex items-center">
            <img src="{{ asset('/src/img/hero/bg_landing.png') }}" alt=""
                class="lg:block absolute mt-0 ml-0 h-screen w-full object-cover filter grayscale" data-aos="fade-zoom-in"
                data-aos-easing="ease-in-back" data-aos-delay="1000" data-aos-duration="1000" data-aos-offset="0">

            <div class="lg:absolute w-full h-screen flex flex-col items-center text-center pt-56 lg:pt-36">
                <img src="{{ asset('/src/img/logo/logo.png') }}" alt=""
                    class=" py-1 px-3 lg:px-6 rounded-lg mb-5 opacity-100" data-aos="fade-down" data-aos-easing="linear"
                    data-aos-delay="1500" data-aos-duration="1000" width="266" height="112">

                <div class="relative" data-aos="fade-down" data-aos-easing="linear" data-aos-delay="1000"
                    data-aos-duration="1000">
                    <h2 id="title1"
                        class="text-white text-xl lg:text-4xl font-extrabold mb-0 text-glow relative z-10">
                        PENGGAWA NAROTAMA
                    </h2>

                    <!-- Gambar sebagai background di tengah-tengah -->
                    <img src="{{ asset('/src/img/hero/mask_group.png') }}"
                        class="absolute inset-0 mx-auto my-auto w-full h-auto opacity-100 z-0 lg:w-full"
                        alt="mask_group.png">

                    <h2 id="title2"
                        class="text-white text-xl lg:text-4xl font-extrabold mb-5 text-glow relative z-10">
                        MUDA BESTARI DAN KUAT
                    </h2>
                </div>

                <div class="" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="2500">
                    <h3 id="text1" class="text-white text-sm lg:text-lg font-light">Inilah saatnya untuk beraksi
                    </h3>
                    <h3 id="text2" class="text-white text-sm lg:text-lg font-light">Jadilah bagian dari perubahan
                        yang luar biasa</h3>
                </div>
            </div>


            <div class="absolute w-full h-screen flex flex-col items-center text-center pt-80" data-aos="fade-zoom-in"
                data-aos-easing="ease-in-back" data-aos-delay="2000" data-aos-duration="1000" data-aos-offset="0">
                <div>
                    <a href="#dashboard">
                        <button
                            class="text-black font-bold text-base lg:text-xl mt-48 lg:mt-44 py-1 lg:py-2 px-6 lg:px-7 bg-white rounded-full shadow-sm z-50">
                            Mulai
                        </button>
                    </a>
                </div>
            </div>
        </section>

        <section id="dashboard" class="h-screen w-full bg-[#000000] justify-center">
          <div class="">
            <img src="{{ asset('/src/img/hero/2/clip_path_group.png') }}" alt="clip_path_group.png"
                class="absolute mt-0 ml-0 object-cover " data-aos="fade-zoom-in" data-aos-easing="ease-in-back"
                data-aos-duration="2000" data-aos-offset="0">
            <div class="flex justify-end mb-15">
                <img src="{{ asset('/src/img/hero/2/pkkmb_2024.png') }}" alt="pkkmb_2024.png"
                    class="absolute object-cover mt-0 mr-0 pt-56 lg:pt-18 z-0 w-3/4 lg:w-1/2" data-aos="fade-up"
                    data-aos-easing="linear" data-aos-delay="3000" data-aos-duration="1000">
            </div>
            <div class="grid grid-cols-2">
                <div class="flex justify-start pt-56 lg:pt-16">
                    <img src="{{ asset('/src/img/hero/2/group.png') }}" alt="group.png"
                        class="absolute object-cover w-full mt-0 ml-0 z-0" data-aos="fade-up"
                        data-aos-easing="linear" data-aos-delay="3000" data-aos-duration="1000">
                </div>
                <div class="flex justify-end pt-56 lg:pt-16">
                    <img src="{{ asset('/src/img/hero/2/foto.png') }}" alt="foto.png" width="50" height="50"
                        class="absolute object-cover w-1/4 mt-0 mr-0 border-2 border-r-0 border-[#FFC300] pt-2 pl-2 pb-2"
                        data-aos="fade-up" data-aos-easing="linear" data-aos-delay="3000" data-aos-duration="1000">
                </div>
            </div>
            <div class="absolute h-screen">
                <div class="flex flex-col text-center lg:pt-10 pl-10 lg:pl-10 w-[300px] lg:w-full">
                    <div class="flex gap-4">
                        <div class="w-[100px] border border-t-2 border-[#FFC300] mb-5">

                        </div>
                        <div class="w-[30px] border border-t-2 border-[#FFC300] mb-5">

                        </div>
                    </div>
                    <h2 id="title1" class="text-white text-lg lg:text-6xl font-extrabold mb-0 z-50"
                        data-aos="fade-down" data-aos-easing="linear" data-aos-delay="1100" data-aos-duration="1000">
                        MULAI DUNIAMU
                    </h2>
                    <h2 id="title2" class="text-white text-lg lg:text-3xl font-bold mb-5 z-50" data-aos="fade-down"
                        data-aos-easing="linear" data-aos-delay="1000" data-aos-duration="1000">
                        UNTUK PERUBAHAN YANG LUAR BIASA
                    </h2>
                    <div class="" data-aos="fade-up" data-aos-easing="linear" data-aos-delay="1300"
                        data-aos-duration="1000">
                        <h3 id="text1" class="text-white text-sm lg:text-base font-light">Saatnya mulai beraksi
                        </h3>
                        <h3 id="text2" class="text-white text-sm lg:text-base font-light mb-7">Buat pengalamanmu
                            menjadi lebih berharga</h3>
                    </div>

                    <div>
                        <a href="{{ route('home-presences.indexuserdashboard') }}"
                            class="text-black py-1 lg:py-2 px-6 lg:px-7 bg-white rounded-full" data-aos="fade-zoom-in"
                            data-aos-easing="ease-in-back" data-aos-delay="2500" data-aos-duration="1000">
                            Masuk
                        </a>
                    </div>
                </div>
            </div>          
          </div>
        </section>

        <section id="information" class="h-screen w-full bg-[#000000]">
            <img src="{{ asset('/src/img/hero/3/foto.png') }}" alt="3/foto.png"
                class="absolute mt-0 ml-0 object-cover filter grayscale z-0 pt-56 lg:pt-0" data-aos="fade-zoom-in"
                data-aos-easing="ease-in-back" data-aos-duration="1000" data-aos-delay="2000" data-aos-offset="200">
            <div class="pt-56 lg:pt-0" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-delay="1000"
                data-aos-offset="500">
                <img src="{{ asset('/src/img/hero/3/clip_path_group.png') }}" alt="clip_path_group.png"
                    class="absolute mt-40 ml-0 object-cover filter grayscale z-0">
            </div>
            
            <div class="grid grid-cols-2 lg:pt-18">
              <div class="w-1/4 ml-5 lg:ml-20">
                <img src="{{ asset('/src/img/hero/3/sijagad_halo.png') }}" alt="3/sijagad_halo.png"
                class="absolute opacity-100 z-20 w-[84px] h-[120px] lg:w-[330px] lg:h-[510px] -ml-5 mt-10 lg:pt-15" data-aos="fade-zoom-in"
                data-aos-easing="ease-in-back" data-aos-duration="1000" data-aos-delay="2000" data-aos-offset="200">
                <img src="{{ asset('/src/img/hero/3/group_20.png') }}" alt="3/group_20.png"
                class="absolute opacity-100 lg:ml-30 w-[124px] h-[153px] lg:w-[400px] lg:h-[547px] z-0" data-aos="fade-zoom-in"
                data-aos-easing="ease-in-back" data-aos-duration="1000" data-aos-delay="2000" data-aos-offset="200">
              </div>
              <div class="w-[400px] lg:w-full absolute flex justify-end lg:pt-35 text-center">
                  <div>
                      <div class="border-r-2 border-[#FFC300] pr-5 mr-5 lg:mr-10">
                        <h2 id="title1" class="text-white text-[12px] lg:text-5xl font-extrabold mb-0 lg:mb-1"
                            data-aos="fade-right" data-aos-easing="linear" data-aos-delay="2100"
                            data-aos-duration="1000">
                            PERBANYAK INFORMASI
                        </h2>
                        <h2 id="title2" class="text-white text-[12px] lg:text-3xl font-bold mb-2 lg:mb-7"
                            data-aos="fade-right" data-aos-easing="linear" data-aos-delay="2000"
                            data-aos-duration="1000">
                            MEMBUATMU MENJADI LEBIH LUAS
                        </h2>
                        <div class="max-w-screen-sm lg:max-w-screen-xl" data-aos="fade-right" data-aos-easing="linear"
                            data-aos-delay="2300" data-aos-duration="1000">
                            <h3 id="text1" class="text-white text-base lg:text-lg font-light">Informasi
                                akan membantumu</h3>
                            <h3 id="text2" class="text-white text-base lg:text-lg font-light mb-5 lg:mb-7">
                                Informasi akan menjadi penuntunmu</h3>
                        </div>
                      </div>
  
                      <a href="{{ route('informasi-landing') }}" data-aos="fade-zoom-in"
                          data-aos-easing="ease-in-back" data-aos-delay="2500" data-aos-duration="1000">
                          <button
                              class="text-black font-bold text-base lg:text-lg py-1 lg:py-2 px-5 lg:px-9 bg-white border-2 border-white rounded-full shadow-xl">
                              Cari Informasi
                          </button>
                      </a>
                  </div>
              </div>
            </div>
        </section>

        {{-- <section id="news" class="">
    
      </section> --}}

        @include('layouts.landing.footer')

        <script>
            document.querySelector('#nav-toggle').onclick = () => {
                document.querySelectorAll('#nav-content').forEach(element => {
                    if (element.style.display === '') element.style.display = 'flex'
                    else element.style.display = ''
                })
            }
        </script>

        @stack('before-script')

        @include('includes.landing.script')

        @stack('after-script')

        @stack('javascript')
        @include('partials.scripts')
    </div>
</body>

</html>
