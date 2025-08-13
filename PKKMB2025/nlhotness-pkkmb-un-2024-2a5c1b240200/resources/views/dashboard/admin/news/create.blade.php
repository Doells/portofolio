@extends('layouts.dashboard.app')

@section('content')
    
    <main class="h-full overflow-y-auto">

        <div class="mx-auto">
            <div class="grid w-full gap-5 px-0 lg:px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="lg:mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Tambah Berita PKKMB 2023
                    </h2>
                    <p class="text-xs lg:text-sm text-gray-400">
                        Unggah informasi berita kegiatan PKKMB 2023
                    </p>
                </div>
            </div>
        </div>

        <!-- breadcrumb -->
        <nav class="hidden lg:block lg:mx-10 mt-5 lg:mt-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex p-0 list-none">
                <li class="flex items-center">
                    <a href="{{ route('admin.news.index') }}" class="text-xs lg:text-sm text-gray-400">Kegiatan PKKMB 2023</a>
                    <svg class="w-3 h-3 mx-1 lg:mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <p class="text-xs lg:text-sm font-medium">Tambah Informasi</p>
                </li>
            </ol>
        </nav>

        <section class="container px-0 lg:px-6 mx-auto mt-10">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-0">
                    <div class="lg:px-2 lg:py-2 lg:mt-2 bg-white rounded-xl">

                        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="">

                                <div class="lg:px-4 lg:py-5">
                                    <div class="grid grid-cols-6 gap-6">

                                        <div class="col-span-6">
                                            <label for="title" class="block mb-1 lg:mb-3 font-medium text-gray-700 text-sm lg:text-base">Judul Kegiatan</label>
                                            <input placeholder="Berita apa yang ingin diunggah?" type="text"  style="text-transform: capitalize;" minlength="40" maxlength="65" name="title" id="title" autocomplete="title" class="block w-full py-2 lg:py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm lg:text-base" value="{{ old('title') }}" required>

                                            @if ($errors->has('title'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('title') }}</p>
                                            @endif
                                        </div>

                                        <div class="col-span-6">
                                            <label for="description" class="block mb-1 lg:mb-3 font-medium text-gray-700 text-sm lg:text-base">Deskripsi Kegiatan</label>
                                            <textarea placeholder="Jelaskan terkait Berita apa yang akan diunggah?" type="text" minlength="100" name="description" id="description" autocomplete="description" class="block w-full py-2 lg:py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm lg:text-base" rows="4" value="{{ old('description') }}" required></textarea>

                                            @if ($errors->has('description'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('description') }}</p>
                                            @endif
                                        </div>

                                        <div class="col-span-6">
                                            <label for="thumbnail_news" class="block mb-1 lg:mb-3 font-medium text-gray-700 text-sm lg:text-base">Thumbnail Berita <span class="text-gray-400 font-normal text-xs lg:text-sm">(Ukuran Gambar 1600x900)</span></label>
                                            <input placeholder="Thumbnail 1" type="file" name="thumbnail[]" id="thumbnail" autocomplete="thumbnail" accept=".jpg, .jpeg, .png" class="block w-full py-2 lg:py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm lg:text-base">
                                            {{-- <input placeholder="Thumbnail 2" type="file" name="thumbnail[]" id="thumbnail" autocomplete="thumbnail" accept=".jpg, .jpeg, .png" class="block w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            <input placeholder="Thumbnail 3" type="file" name="thumbnail[]" id="thumbnail" autocomplete="thumbnail" accept=".jpg, .jpeg, .png" class="block w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            <div id="newThumbnailRow"></div>
                                            <button type="button" class="inline-flex justify-center px-3 py-2 mt-3 text-xs font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" id="addThumbnailRow">
                                                Tambahkan Gambar +
                                            </button> --}}
                                        </div>

                                        <div class="col-span-6">
                                            <label for="tagline" class="block mb-1 lg:mb-3 font-medium text-gray-700 text-sm lg:text-base">Tagline <span class="text-gray-400">(Minimal 1)</span></label>
                                            
                                            <input placeholder="Tagline" type="text" name="tagline[]" id="tagline" autocomplete="tagline" class="block w-full py-2 lg:py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm lg:text-base" required>
                                            <div id="newTaglineRow"></div>
                                            
                                            <button type="button" class="inline-flex justify-center px-3 py-2 mt-3 mb-10 lg:mb-0 text-xs font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" id="addTaglineRow">
                                                Tambahkan Tagline +
                                            </button>
                                        </div>

                                    </div>
                                </div>

                                <div class="px-0 lg:px-4 py-3 text-right">
                                    <a href="{{ route('admin.news.index') }}" type="button" class="inline-flex justify-center px-4 py-2 mr-1 lg:mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300" onclick="return confirm('Apakah kamu yakin akan membatalkannya? Apapun yang telah diisikan tidak akan tersimpan.')">
                                        Cancel
                                    </a>

                                    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" onclick="return confirm('Apakah anda yakin untuk menyimpan data?')">
                                        Tambah Kegiatan
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
    
    <script type="text/javascript">
        // add row
        $("#addAdvantagesRow").click(function() {
            var html = '';
            html += '<input placeholder="Keunggulan Kamu" type="text" name="advantage_user[]" id="advantage_user" autocomplete="advantage_user" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" required>';

            $('#newAdvantagesRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeAdvantagesRow', function() {
            $(this).closest('#inputFormAdvantagesRow').remove();
        });
    </script>

    <script type="text/javascript">
        // add row
        $("#addServicesRow").click(function() {
            var html = '';
            html += '<input placeholder="Keunggulan Kegiatan" type="text" name="advantage_news[]" id="advantage_news" autocomplete="advantage_news" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" required>';

            $('#newServicesRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeServicesRow', function() {
            $(this).closest('#inputFormServicesRow').remove();
        });
    </script>

    <script type="text/javascript">
        // add row
        $("#addTaglineRow").click(function() {
            var html = '';
            html += '<input placeholder="Tagline" type="text" name="tagline[]" id="tagline" autocomplete="tagline" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" required>';

            $('#newTaglineRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeTaglineRow', function() {
            $(this).closest('#inputFormTaglineRow').remove();
        });
    </script>

    <script type="text/javascript">
        // add row
        $("#addThumbnailRow").click(function() {
            var html = '';
            html += '<input placeholder="Thumbnail Berita" type="file" name="thumbnail[]" id="thumbnail" autocomplete="thumbnail" accept=".jpg, .jpeg, .png" class="block w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" required>';

            $('#newThumbnailRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeThumbnailRow', function() {
            $(this).closest('#inputFormThumbnailRow').remove();
        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            var fileInputs = document.querySelectorAll('input[type="file"]');

            fileInputs.forEach(function(input) {
                input.addEventListener("change", function(event) {
                    var files = event.target.files;
                    var maxSize = 1 * 1024 * 1024; // 1MB

                    for (var i = 0; i < files.length; i++) {
                        if (files[i].size > maxSize) {
                            event.target.value = ""; // Hapus file yang melebihi batas ukuran

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ukuran file melebihi batas maksimum 1MB',
                                confirmButtonText: 'OK'
                            });

                            return false;
                        }
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        var fileInput = document.querySelector('input[type="file"]');
        fileInput.addEventListener('change', function() {
            var file = fileInput.files[0];
            var img = new Image();

            img.onload = function() {
                if (img.width === 1600 && img.height === 900) {
                    // Ukuran gambar valid
                    // Lanjutkan dengan mengunggah gambar
                } else {
                    // Ukuran gambar tidak valid
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gambar harus memiliki ukuran 1600px x 900px',
                        confirmButtonText: 'OK'
                    });
                    fileInput.value = ''; // Menghapus file yang dipilih dari input
                }
            };

            img.src = URL.createObjectURL(file);
        });
    </script>

@endpush