@extends('layouts.dashboard.base')

@section('base')

@include('partials.navbar')

<div class="container-fluid">
    <div class="row">
        <main class="px-7 lg:px-20">
            <div
                class="items-center pt-3 pb-2 mb-3 border-b-4">
                <h1 class="font-semibold text-lg">{{ $title }}</h1>
                {{-- <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar" class="align-text-bottom"></span>
                        This week
                    </button>
                </div> --}}
                @yield('buttons')
            </div>

            <div class="py-4">
                @include('sweetalert::alert')

                @yield('content')
            </div>
        </main>
    </div>
</div>
@endsection