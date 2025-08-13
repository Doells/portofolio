<link rel="stylesheet" href="{{ asset('css/landing/home.css') }}">

<style>
    .tab button.active {
        display: inline-block;
        width: 100%;
        background-color: #FFCE43;
        opacity: 0.95;
        font-weight: 900;
    }

    .tabcontent {
        display: none;
    }

    .tabcontent {
        animation: fadeEffect 1s;
    }

    @keyframes fadeEffect {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>