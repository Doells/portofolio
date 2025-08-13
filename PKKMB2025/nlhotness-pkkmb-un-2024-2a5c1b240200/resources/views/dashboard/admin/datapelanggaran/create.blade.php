@extends('layouts.dashboard.app')

@section('content')

    <main class="h-full overflow-y-auto">

        <div class="mx-auto">
            <div class="grid w-full gap-5 px-0 lg:px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="lg:mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Tambah Catatan Pelanggaran Peserta
                    </h2>
                    <p class="text-xs lg:text-sm text-gray-400">
                        Unggah Catatan Pelanggaran Peserta
                    </p>
                </div>
            </div>
        </div>

        <!-- breadcrumb -->
        <nav class="hidden lg:block lg:mx-10 mt-5 lg:mt-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex p-0 list-none">
                <li class="flex items-center">
                    <a href="{{ route('admin.pelanggaran.index') }}" class="text-xs lg:text-sm text-gray-400">Kegiatan PKKMB 2023</a>
                    <svg class="w-3 h-3 mx-1 lg:mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <p class="text-xs lg:text-sm font-medium">Tambah Catatan Pelanggaran</p>
                </li>
            </ol>
        </nav>

        <section class="container px-0 lg:px-6 mx-auto mt-10">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-0">
                    <div class="lg:px-2 lg:py-2 lg:mt-2 bg-white rounded-xl">

                        <form action="{{ route('admin.pelanggaran.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="">

                                <div class="lg:px-4 lg:py-5">
                                    <div class="grid grid-cols-6 gap-6">

                                        <div class="col-span-6">
                                            <label for="peserta_id" class="block mb-1 lg:mb-3 font-medium text-gray-700 text-sm lg:text-base">Nama Peserta</label>
                                            <select name="peserta_id" id="peserta_id" class="block w-full py-2 lg:py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm lg:text-base" required>
                                                <option class="text-sm lg:text-base" value="">Pilih Peserta</option>
                                                @foreach ($peserta as $key => $peserta)
                                                    <option class="text-sm lg:text-base" value="{{ $peserta->id}}" {{ old('peserta_id') == $peserta->id ? 'selected' : '' }}>{{ $peserta->nim }} - {{ $peserta->name }} - Kelompok {{ $peserta->kelompok_id }}</option>
                                                @endforeach
                                            </select>
                                        
                                            @if ($errors->has('peserta_id'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('peserta_id') }}</p>
                                            @endif
                                        </div>

                                        <div class="col-span-6">
                                            <label for="ketentuan_id" class="block mb-1 lg:mb-3 font-medium text-gray-700 text-sm lg:text-base">Pelanggaran</label>
                                            <select name="ketentuan_id" id="ketentuan_id" class="block w-full py-2 lg:py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm lg:text-base" required>
                                                <option class="text-sm lg:text-base" value="">Pilih Pelanggaran</option>
                                                @foreach ($ketentuann as $key => $ketentuan)
                                                    <option class="text-sm lg:text-base" value="{{ $ketentuan->id}}" {{ old('ketentuan_id') == $ketentuan->id ? 'selected' : '' }}>{{ ucfirst($ketentuan->title) }} - {{ $ketentuan->poin }}</option>
                                                @endforeach
                                            </select>
                                        
                                            @if ($errors->has('ketentuan_id'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('ketentuan_id') }}</p>
                                            @endif
                                        </div>

                                        <div class="col-span-6">
                                            <label for="title" class="block mb-1 lg:mb-3 font-medium text-gray-700 text-sm lg:text-base">Judul Pelanggaran</label>
                                            <input placeholder="Tulis Judul Pelanggaran" type="text" style="text-transform: capitalize;" name="title" id="title" autocomplete="title" class="block w-full py-2 lg:py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm lg:text-base" value="{{ old('title') }}" readonly>

                                            @if ($errors->has('title'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('title') }}</p>
                                            @endif
                                        </div>

                                        <div class="col-span-6">
                                            <label for="poin" class="block mb-1 lg:mb-3 font-medium text-gray-700 text-sm lg:text-base">Poin Pelanggaran</label>
                                            <input placeholder="Tentukan Poin" type="number" style="text-transform: capitalize;" name="poin" id="poin" autocomplete="poin" class="block w-full py-2 lg:py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm lg:text-base" value="{{ old('poin') }}" readonly>

                                            @if ($errors->has('poin'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('poin') }}</p>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                                <div class="px-0 lg:px-4 py-3 text-right">
                                    <a href="{{ route('admin.pelanggaran.index') }}" type="button" class="inline-flex justify-center px-4 py-2 mr-1 lg:mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300" onclick="return confirm('Apakah kamu yakin akan membatalkannya? Apapun yang telah diisikan tidak akan tersimpan.')">
                                        Cancel
                                    </a>

                                    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" onclick="return confirm('Apakah anda yakin untuk menyimpan data?')">
                                        Tambah Catatan Pelanggaran
                                    </button>
                                </div>

                            </div>
                        </form>
                        
                    </div>
                </main>
            </div>
        </section>
    </main>
@endsection

@push('script')
    
    <script src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ketentuanSelect = document.getElementById("ketentuan_id");
            const titleInput = document.getElementById("title");
            const poinInput = document.getElementById("poin");
    
            ketentuanSelect.addEventListener("change", function() {
                const selectedOption = ketentuanSelect.options[ketentuanSelect.selectedIndex];
                const selectedTitle = selectedOption.textContent.split(" - ")[0];
                const selectedPoin = selectedOption.textContent.split(" - ")[1];
    
                titleInput.value = selectedTitle;
                poinInput.value = selectedPoin;
            });
        });
    </script>

@endpush