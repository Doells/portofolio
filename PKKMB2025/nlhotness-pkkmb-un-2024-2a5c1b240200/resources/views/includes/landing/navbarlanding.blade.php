{{-- <header class="bg-transparent absolute w-full flex items-center z-40">
    <div class="container">
        <div class="flex items-center justify-center relative">
            <div class="flex items-center py-7 px-4">
                <button id="hamburger" name="hamburger" type="button" class="block absolute right-4 mobile-menu-button">
                    <span class="hamburger-line transision duration-300 ease-in-out origin-bottom-left"></span>
                    <span class="hamburger-line transision duration-300 ease-in-out"></span>
                    <span class="hamburger-line transision duration-300 ease-in-out origin-bottom-left"></span>
                </button>

                <nav id="nav-menu" class="hidden absolute py-5 bg-white shadow-lg rounded-lg max-w[250px] w-full right-4 top-full">
                    <ul class="block">
                        <li class="">
                            <a href="{{ route('index-landing') }}" class="block {{ request()->is('/') ? 'py-2 px-2 text-white bg-white font-bold hover:bg-white transition duration-300' : 'py-2 px-2 text-slate-500 font-sans font-normal hover:text-slate-300 hover:border-b-2 hover:border-slate-300 transition duration-300' }}">Beranda</a>
                        </li>
                        <li>
                            <a href="{{ route('informasi-landing') }}" class="block {{ request()->is('informasi') ? 'py-2 px-2 text-white bg-white font-bold hover:bg-white transition duration-300' : 'py-2 px-2 text-slate-500 font-sans font-normal hover:text-slate-300 hover:border-b-2 hover:border-slate-300 transition duration-300' }}">Informasi</a>
                        </li>
                        <li>
                            <a href="{{ route('home-presences.indexuserdashboard') }}" class="block {{ request()->is('login') ? 'py-2 px-2 text-white bg-white font-bold hover:bg-white transition duration-300' : 'py-2 px-2 text-slate-500 font-sans font-normal hover:text-slate-300 hover:border-b-2 hover:border-slate-300 transition duration-300' }}">Dashboard</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header> --}}

<nav class="hidden lg:block absolute bg-transparent w-full z-40">
    <div class="w-full px-2 lg:px-4 items-center">
        <div class="flex justify-center">
            
            <div class="flex">
                <div class="hidden justify-center w-full md:flex md:w-auto md:order-1 items-center space-x-1">
                    <a href="{{ route('index-landing') }}" class="block {{ request()->is('/') ? 'pt-8 pb-1 px-2 text-white font-sans font-bold hover:text-white border-b-2 border-white hover:border-white transition duration-300' : 'pt-8 pb-1 px-2 text-white font-sans font-normal hover:text-gray-300 hover:border-b-2 hover:border-gray-300 transition duration-300' }}">Beranda</a>
                    <a href="{{ route('informasi-landing') }}" class="block {{ request()->is('informasi') ? 'pt-8 pb-1 px-2 text-white font-sans font-bold hover:text-white border-b-2 border-white hover:border-white transition duration-300' : 'pt-8 pb-1 px-2 text-white font-sans font-normal hover:text-gray-300 hover:border-b-2 hover:border-gray-300 transition duration-300' }}">Informasi</a>
                    <a href="{{ route('home-presences.indexuserdashboard') }}" class="block {{ request()->is('login') ? 'pt-8 pb-1 px-2 text-white font-sans font-bold hover:text-white border-b-2 border-white hover:border-white transition duration-300' : 'pt-8 pb-1 px-2 text-white font-sans font-normal hover:text-gray-300 hover:border-b-2 hover:border-gray-300 transition duration-300' }}">Dashboard</a>
                </div>
            </div>

        </div>
    </div>

    
    <div class="hidden mobile-menu">
        <ul>
            <li><a href="{{ route('index-landing') }}" class="block {{ request()->is('/') ? 'text-sm px-2 py-4 font-sans font-normal text-white bg-primary hover:bg-white transition duration-500' : 'text-sm px-2 py-4 font-sans font-normal text-gray-600 hover:text-white hover:bg-white transition duration-500' }}">Profil</a></li>
            <li><a href="{{ route('informasi-landing') }}" class="block {{ request()->is('informasi') ? 'text-sm px-2 py-4 font-sans font-normal text-white bg-primary hover:bg-white transition duration-500' : 'text-sm px-2 py-4 font-sans font-normal text-gray-600 hover:text-white hover:bg-white transition duration-500' }}">Pedoman</a></li>
            <li><a href="{{ route('home-presences.indexuserdashboard') }}" class="block {{ request()->is('login') ? 'text-sm px-2 py-4 font-sans font-normal text-white bg-primary hover:bg-white transition duration-500' : 'text-sm px-2 py-4 font-sans font-normal text-gray-600 hover:text-white hover:bg-white transition duration-500' }}">Beasiswa</a></li>
        </ul>
    </div>
</nav>