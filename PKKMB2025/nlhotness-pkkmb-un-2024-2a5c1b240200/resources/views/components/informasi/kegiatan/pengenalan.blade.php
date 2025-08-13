<div class="w-full bg-[#000000]">
    <div id="pengertian" class="flex flex-col lg:flex-row pt-8">
        <div class="lg:w-6/12 lg:mr-4 rounded-lg bg-[#000000] mb-8 px-5 py-4 text-center">
            <h1 class="font-extrabold text-3xl text-white mb-4 underline">APA ITU PKKMB?</h1>
            <p class="text-justify text-sm mb-2 text-white">
                PKKMB (Pengenalan Kehidupan Kampus bagi Mahasiswa Baru) adalah program orientasi yang dirancang untuk membantu mahasiswa baru beradaptasi dengan kehidupan di kampus. Program ini wajib diikuti oleh seluruh mahasiswa baru untuk mempersiapkan diri menghadapi transisi menjadi mahasiswa yang mandiri dan dewasa, sekaligus memberikan bekal untuk meraih sukses selama menempuh pendidikan di perguruan tinggi.
            </p>
            <p class="text-justify text-sm mb-2 text-white">
                Pada tahun 2024, PKKMB mengusung tema "Penggawa Narotama Muda Bestari dan Kuat." Tema ini mengajak para mahasiswa untuk memanfaatkan masa muda mereka yang penuh energi dan potensi. Mahasiswa diajak untuk terus belajar, berkembang, mengeksplorasi berbagai peluang, serta berani mencoba hal-hal baru. "Bestari" mencerminkan mahasiswa yang cerdas dan bijaksana dalam berpikir dan bertindak. Sementara itu, "Kuat" menekankan pentingnya memiliki ketahanan dalam berbagai aspek kehidupan, baik secara fisik, mental, maupun emosional, untuk menghadapi tantangan dan mencapai kesuksesan.
            </p>
            <p class="text-justify text-sm mb-2 text-white">
                PKKMB 2024 juga menekankan pentingnya pembentukan karakter mahasiswa. Program ini bertujuan untuk membentuk mahasiswa yang adaptif, melek teknologi, kreatif, serta memiliki fisik dan mental yang kuat. Dengan karakter yang tangguh, mahasiswa diharapkan mampu menghadapi segala tantangan dan menjadi individu yang berdampak positif bagi diri sendiri dan orang lain.
            </p>
        </div>

        <div class="w-full lg:w-6/12 lg:ml-4 rounded-lg mb-8">
            <img src="{{ asset('/src/img/information/2/pkkmb.png') }}" alt="pkkmb" class="object-cover rounded-md lg:h-full">
        </div>
    </div>
    <img 
        src="{{ asset('/src/img/hero/clip_path_group.png') }}" 
        alt="clip_path_group" 
        class="hidden lg:block absolute mt-0 ml-0 h-screen w-full object-cover z-0"
        data-aos="fade-zoom-in"
        data-aos-easing="ease-in-back"
        data-aos-delay="1000"
        data-aos-duration="1000"
        data-aos-offset="0"
    >
    <div id="team" class="flex">
        <div class="bg-[#000000] rounded-lg w-full flex flex-col items-center text-center mb-8 p-6">
            <div class="mb-7">
                <h2 class="text-base font-bold text-[#FFCE43]">TAK KENAL MAKA TAK SAYANG</h2>
                <h1 class="text-2xl font-bold text-white">Kepanitiaan Pengenalan Kehidupan Kampus bagi Mahasiswa Baru</h1>
                <h1 class="text-2xl font-bold text-white">Universitas Narotama Tahun 2024</h1>
            </div>

            <div class="flex flex-col lg:flex-row mb-8">
                @include('components.informasi.team.teamlanding')
            </div>

            <a href="{{ route('informasi-panitia') }}" class="z-10">
                <button class="bg-[#FFCE43] px-8 py-3 text-white text-base rounded-lg">
                    Selengkapnya
                </button>
            </a>
        </div>
    </div>

    <div id="preview1" class="flex flex-col lg:flex-row">
        <div class="w-full lg:w-9/12 bg-[#FFCE43] rounded-lg flex flex-col lg:flex-row p-4 lg:mr-4 mb-5 lg:mb-8">
            <div class="w-full lg:w-1/2 lg:border-r-2 lg:border-black text-center mb-5 lg:mb-0">
                <iframe class="w-[345px] lg:w-[430px] h-[215px]" src="https://www.youtube.com/embed/ZCj1iMsjOcU?si=GH2kqsx5iHE1CntS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>

            <div class="w-full lg:w-1/2 text-center lg:pl-5 mb-5 lg:mb-0">
                <iframe class="w-[345px] lg:w-[430px] h-[215px]" src="https://www.youtube.com/embed/6t0n2v-FRBQ?si=coefytKlz8Lh1kYH" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>

        <div class="w-full lg:w-3/12 bg-[#FFCE43] rounded-lg lg:ml-4 mb-5 lg:mb-8 flex items-center justify-center">
            <h1 class="text-white font-bold text-lg lg:text-2xl text-center">
                Preview PKKMB <br>
                Sebelumnya
            </h1>
        </div>
    </div>

    {{-- <div id="preview2" class="flex">
        <div class="w-3/12 gradient-bg-video1 rounded-lg mr-4 mb-8 flex flex-col items-center justify-center">
            <h1 class="text-white font-bold text-2xl text-center">
                Preview PKKMB <br>
                Sebelumnya
            </h1>
        </div>

        <div class="w-9/12 bg-[#FFECEC] rounded-lg flex p-4 ml-4 mb-8">
            <div class="w-1/2 border-r-2 border-purple-300 text-center">
                <iframe class="w-full pr-4" src="{{ url('https://www.youtube.com/watch?v=ZCj1iMsjOcU') }}" frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="w-1/2 text-center">
                <iframe class="w-full pl-4" src="{{ url('https://www.youtube.com/watch?v=6t0n2v-FRBQ&t=43s') }}" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div> --}}

    {{-- <div id="seminarnasional" class="flex">
        <div class="bg-[#FFECEC] rounded-lg w-full flex flex-col items-center text-center mb-8 p-6">
            <div class="mb-5">
                <h2 class="text-base font-bold gradient-text-pengenalan">SEMINAR NASIONAL</h2>
                <h1 class="text-2xl font-bold text-space-buttonungu">Pengenalan Kehidupan Kampus bagi Mahasiswa Baru</h1>
                <h1 class="text-2xl font-bold text-space-buttonungu">Universitas Narotama Tahun 2023</h1>
            </div>

            <div class="flex mb-8">
                @include('components.informasi.team.card')
                @include('components.informasi.team.card')
                @include('components.informasi.team.card')
                @include('components.informasi.team.card')
            </div>

            <a href="#">
                <button class="bg-space-buttonbiru px-8 py-3 text-white text-base rounded-lg">
                    Selengkapnya
                </button>
            </a>
        </div>
    </div> --}}
</div>