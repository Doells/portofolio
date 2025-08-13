<nav class="lg:block absolute bg-transparent w-full items-center z-40">
    <div class="w-full px-2 lg:px-4 items-center">
        <div class="flex justify-center">
            <div class="flex">
                <div class="grid grid-cols-3">
                    <a href="{{ route('index-landing') }}" class="block {{ request()->is('/') ? 'pt-8 pb-1 px-2 text-white font-sans font-bold hover:text-gray-300 border-b-2 border-white hover:border-gray-300 transition duration-300' : 'pt-8 pb-1 px-2 text-white font-sans font-normal hover:text-gray-300 hover:border-b-2 hover:border-gray-300 transition duration-300' }}">Beranda</a>
                    <a href="{{ route('informasi-landing') }}" class="block {{ request()->is('informasi', 'informasi/berita', 'informasi/kegiatan', 'informasi/pengumuman') ? 'pt-8 pb-1 px-2 text-white font-sans font-bold hover:text-gray-300 border-b-2 border-white hover:border-gray-300 transition duration-300' : 'pt-8 pb-1 px-2 text-white font-sans font-normal hover:text-gray-300 hover:border-b-2 hover:border-gray-300 transition duration-300' }}">Informasi</a>
                    <a href="{{ route('home-presences.indexuserdashboard') }}" class="block {{ request()->is('login') ? 'pt-8 pb-1 px-2 text-white font-sans font-bold hover:text-gray-300 border-b-2 border-white hover:border-gray-300 transition duration-300' : 'pt-8 pb-1 px-2 text-white font-sans font-normal hover:text-gray-300 hover:border-b-2 hover:border-gray-300 transition duration-300' }}">Dashboard</a>
                </div>
            </div>
            
        </div>
    </div>

    
    <div class="hidden mobile-menu">
        <ul>
            <li><a href="{{ route('index-landing') }}" class="block {{ request()->is('/') ? 'text-sm px-2 py-4 font-sans font-normal text-white bg-primary hover:bg-orange-300 transition duration-500' : 'text-sm px-2 py-4 font-sans font-normal text-gray-600 hover:text-white hover:bg-orange-300 transition duration-500' }}">Beranda</a></li>
            <li><a href="{{ route('informasi-landing') }}" class="block {{ request()->is('informasi') ? 'text-sm px-2 py-4 font-sans font-normal text-white bg-primary hover:bg-orange-300 transition duration-500' : 'text-sm px-2 py-4 font-sans font-normal text-gray-600 hover:text-white hover:bg-orange-300 transition duration-500' }}">Informasi</a></li>
            <li><a href="{{ route('home-presences.indexuserdashboard') }}" class="block {{ request()->is('login') ? 'text-sm px-2 py-4 font-sans font-normal text-white bg-primary hover:bg-orange-300 transition duration-500' : 'text-sm px-2 py-4 font-sans font-normal text-gray-600 hover:text-white hover:bg-orange-300 transition duration-500' }}">Dashboard</a></li>
        </ul>
    </div>
</nav>
