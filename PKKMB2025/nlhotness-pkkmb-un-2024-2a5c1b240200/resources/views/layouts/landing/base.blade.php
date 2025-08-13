<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.landing.meta')

        @include('partials.fonts')
        @include('partials.tailwindstyles')
        @stack('style')
    
        <title>PKKMB Narotama 2024</title>

        @stack('before-style')

        @include('includes.landing.style')

        @stack('after-style')
    </head>
    <body class="antialiased font-poppins">
        <div class="relative">
            
            @include('layouts.landing.navbar')
            
            @yield('content')

            
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
