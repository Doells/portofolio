<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.landing.meta')

    @include('partials.fonts')
    @include('partials.tailwindstyles')
    @stack('style')

    <title>Error 404 | PKKMB Narotama 2023</title>

    @stack('before-style')

    @include('includes.landing.style')

    @stack('after-style')
</head>
<body class="antialiased font-poppins">
    <section id="error" class="h-full z-50 bg-slate-200">
        <div class="container px-0">
            <div class="pt-16 min-h-screen">
                <div class="w-full px-4">
                    <div class="flex mb-10 items-center justify-center">
                        <img src="{{ asset('/src/img/maskot_pkkmb_maaf_2.png') }}" alt="Maskot Sorry" class="w-36">
                    </div>
                </div>
    
                <div class="w-full px-4">
                    <div class="max-w-2xl mx-auto text-center mb-14 ">
                        <h2 class="font-bold text-xl mb-5 lg:text-2xl ">Mohon Maaf Kakak Halaman Ini Tidak Tersedia.</h2>
                        <a href="{{ route('home-presences.indexuserdashboard') }}" class="font-medium text-xs text-white bg-blue-500 py-3 px-4 mb-4 rounded-md hover:shadow-lg hover:opacity-90 transition duration-300 ease-in-out">
                            Kembali Ke Halaman Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- @include('layouts.landing.footer') --}}

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
</body>
</html>