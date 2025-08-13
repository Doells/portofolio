{{-- <div class="bg-purple-300">
    @auth
        <div class="px-5 lg:px-36 py-5 lg:py-20 w-full">
            <iframe class="mb-5" src="{{ asset('/src/document/tugas_pkkmb2023.pdf') }}" width="100%" height="1000px"></iframe>

            <a href="{{ asset('/src/document/tugas_pkkmb2023.pdf') }}" download="tugas_pkkmb2023.pdf" class="bg-space-buttonbiru hover:bg-blue-400 px-8 py-3 text-white text-base rounded-lg">Unduh File</a>
        </div>
    @endauth
    @guest
        <div class="w-full h-[420px] lg:h-screen flex flex-col items-center justify-center">
            <div class="w-full px-4">
                <div class="flex items-center justify-center mb-5">
                    <img src="{{ asset('/src/img/maskot_pkkmb_maaf_2.png') }}" alt="Sorry Maskot" class="w-24 lg:w-40">
                </div>
            </div>
        
            <div class="w-full px-4">
                <div class="max-w-2xl mx-auto text-center">
                    <h2 class="font-bold text-xl mb-3 lg:text-2xl ">Mohon Maaf Kakak Belum Bisa Mengakses Halaman Ini</h2>
                    <p class="font-normal text-xs text-secondary lg:text-sm mb-10">Silahkan masuk terlebih dahulu untuk dapat mengakses pada halaman ini</p>
                    <a href="{{ route('home-presences.indexuserdashboard') }}" class="font-medium text-base text-white bg-orange-400 py-3 px-8 rounded-md hover:shadow-lg hover:opacity-90 transition duration-300 ease-in-out">
                        Masuk
                    </a>
                </div>
            </div>    
        </div>
    @endguest
</div> --}}

<div class="bg-[#000000]">
    <div class="w-full px-4 py-20">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="font-bold text-xl mb-3 lg:text-2xl ">Mohon Maaf Kakak Belum Bisa Mengakses Halaman Ini</h2>
            <p class="font-normal text-xs text-secondary lg:text-sm mb-10">Silahkan coba lagi nanti :)</p>
        </div>
    </div>    
</div>