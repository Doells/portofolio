{{-- TailwindCSS Styles --}}
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
{{-- Main CSS --}}
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
{{-- Livewire CSS --}}
<style>
    .text-glow {
      text-shadow: 0 0 2px rgba(255, 215, 0, 0.8), /* Warna emas (#FFD700) */
                   0 0 4px rgba(255, 215, 0, 0.6),
                   0 0 6px rgba(255, 215, 0, 0.4),
                   0 0 8px rgba(255, 215, 0, 0.2);
    }
</style>
@livewireStyles