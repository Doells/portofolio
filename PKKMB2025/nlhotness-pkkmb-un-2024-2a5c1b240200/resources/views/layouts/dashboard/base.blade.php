<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/src/img/logo/pkkmb_icon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/src/img/logo/pkkmb_icon.ico') }}">
    @include('partials.fonts')
    @include('partials.tailwindstyles')

    <!-- Styles -->
    @livewireStyles

    <!-- Calendar -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js"
        integrity="sha256-9yi0gNDNLV3usla2T6mvy9YiQ+hjaOheCFDksngs+x4=" crossorigin="anonymous"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.min.js'></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- @include('partials.bootstrapstyles') --}}
    @stack('style')

    <title>{{ $title }} | PKKMB Narotama 2024</title>
</head>

<body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark text-bodydark bg-boxdark-2': darkMode === true }">
    <!-- ===== Preloader Start ===== -->
    @include('partials.preloader')
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        @include('partials.sidebar')
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- ===== Header Start ===== -->
            {{-- @include('app.header') --}}
            {{-- @livewire('header') --}}
            <!-- ===== Header End ===== -->
            @yield('base')

            @include('partials.scripts')
        
            @stack('script')
            <main>
                
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
    @include('sweetalert::alert')
    @livewireScripts
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    if (!confirm('Apakah anda yakin ingin menghapus data ini?')) {
                        event.preventDefault(); // Mencegah aksi jika konfirmasi dibatalkan
                    }
                });
            });
        });
    </script>
</body>

</html>
