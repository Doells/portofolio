@extends('layouts.dashboard.app')

@section('content')
    <!-- ====== Profile Section Start -->
    <div
        class="overflow-hidden rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="relative z-20 h-35 md:h-65">
            <img src="{{asset('src/images/cover/cover-01.png')}}" alt="profile cover"
                class="h-full w-full rounded-tl-sm rounded-tr-sm object-cover object-center" />
        </div>
        <div class="px-4 pb-6 text-center lg:pb-8 xl:pb-11.5">
            <div
                class="relative z-30 mx-auto -mt-22 h-30 w-full max-w-30 rounded-full bg-white/20 p-1 backdrop-blur sm:h-44 sm:max-w-44 sm:p-3">
                <div class="relative drop-shadow-2">
                    <img src="{{asset('src/images/user/default-profile-foto.jpg')}}" alt="profile" class="rounded-full" />
                    {{-- <label for="profile"
                        class="absolute bottom-0 right-0 flex h-8.5 w-8.5 cursor-pointer items-center justify-center rounded-full bg-primary text-white hover:bg-opacity-90 sm:bottom-2 sm:right-2">
                        <svg class="fill-current" width="14" height="14" viewBox="0 0 14 14" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.76464 1.42638C4.87283 1.2641 5.05496 1.16663 5.25 1.16663H8.75C8.94504 1.16663 9.12717 1.2641 9.23536 1.42638L10.2289 2.91663H12.25C12.7141 2.91663 13.1592 3.101 13.4874 3.42919C13.8156 3.75738 14 4.2025 14 4.66663V11.0833C14 11.5474 13.8156 11.9925 13.4874 12.3207C13.1592 12.6489 12.7141 12.8333 12.25 12.8333H1.75C1.28587 12.8333 0.840752 12.6489 0.512563 12.3207C0.184375 11.9925 0 11.5474 0 11.0833V4.66663C0 4.2025 0.184374 3.75738 0.512563 3.42919C0.840752 3.101 1.28587 2.91663 1.75 2.91663H3.77114L4.76464 1.42638ZM5.56219 2.33329L4.5687 3.82353C4.46051 3.98582 4.27837 4.08329 4.08333 4.08329H1.75C1.59529 4.08329 1.44692 4.14475 1.33752 4.25415C1.22812 4.36354 1.16667 4.51192 1.16667 4.66663V11.0833C1.16667 11.238 1.22812 11.3864 1.33752 11.4958C1.44692 11.6052 1.59529 11.6666 1.75 11.6666H12.25C12.4047 11.6666 12.5531 11.6052 12.6625 11.4958C12.7719 11.3864 12.8333 11.238 12.8333 11.0833V4.66663C12.8333 4.51192 12.7719 4.36354 12.6625 4.25415C12.5531 4.14475 12.4047 4.08329 12.25 4.08329H9.91667C9.72163 4.08329 9.53949 3.98582 9.4313 3.82353L8.43781 2.33329H5.56219Z"
                                fill="" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.00004 5.83329C6.03354 5.83329 5.25004 6.61679 5.25004 7.58329C5.25004 8.54979 6.03354 9.33329 7.00004 9.33329C7.96654 9.33329 8.75004 8.54979 8.75004 7.58329C8.75004 6.61679 7.96654 5.83329 7.00004 5.83329ZM4.08337 7.58329C4.08337 5.97246 5.38921 4.66663 7.00004 4.66663C8.61087 4.66663 9.91671 5.97246 9.91671 7.58329C9.91671 9.19412 8.61087 10.5 7.00004 10.5C5.38921 10.5 4.08337 9.19412 4.08337 7.58329Z"
                                fill="" />
                        </svg>
                        <input type="file" name="profile" id="profile" class="sr-only" />
                    </label> --}}
                </div>
            </div>
            <div class="mt-4">
                <h3 class="mb-1.5 text-2xl font-medium text-black dark:text-white">
                    {{ auth()->user()->name }}
                </h3>
                <p class="font-medium mb-[20px]">{{ auth()->user()->position->name }}</p>
            </div>
            <form class="container px-10 lg:mx-auto">
                <div class="relative z-0 w-full mb-6 group">
                    <label for="NIM" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">NIM</label>
                    <input type="text" name="floating_name" id="floating_name" class="block py-2.5  w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->nim }}" required disabled />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Nama</label>
                    <input type="text" name="floating_nim" id="floating_nim" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->name }}" required disabled />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Nama Lengkap" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->nama_lengkap}}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Kelompok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Kelompok</label>
                    <input type="text" name="kelompok" id="kelompok" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->kelompok->name  ?? 'Belum masuk kelompok'  }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Posisi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Posisi</label>
                    <input type="text" name="position" id="position" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->position->name }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Prodi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Program Studi</label>
                    <input type="text" name="major" id="floating_major" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->detailuser->prodi }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Fakultas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Fakultas</label>
                    <input type="text" name="fakultas" id="fakultas" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->detailuser->fakultas }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="No HP" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">No Telepon</label>
                    <input type="text" name="no_hp" id="no_hp" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->detailuser->no_hp }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Email</label>
                    <input type="text" name="email" id="email" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->detailuser->email }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Sistem Kuliah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Sistem Kuliah</label>
                    <input type="text" name="sistem_kuliah" id="sistem_kuliah" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->detailuser->sistem_kuliah }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Tahun Angkatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Tahun Angkatan</label>
                    <input type="text" name="tahun_angkatan" id="tahun_angkatan" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->detailuser->tahun_angkatan }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Jalur Penerimaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Jalur Penerimaan</label>
                    <input type="text" name="jalur_penerimaan" id="jalur_penerimaan" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->detailuser->jalur_penerimaan }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Jenis Kelamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Jenis Kelamin</label>
                    <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->detailuser->jenis_kelamin }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Tanggal Lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Tanggal Lahir</label>
                    <input type="text" name="tgl_lahir" id="tgl_lahir" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->detailuser->tgl_lahir }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Tempat Lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->detailuser->tempat_lahir }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Agama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Agama</label>
                    <input type="text" name="agama" id="agama" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->detailuser->agama }}" disabled/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="Alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" placeholder="{{ auth()->user()->detailuser->alamat }}" disabled/>
                </div>
                <div class="flex justify-end gap-x-3">
                    {{-- <div class="">
                        <a type="button" href="{{ route('dashboard-user.profileedit') }}" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 mt-6 text-center nx-2">Edit</a>
                    </div>   --}}
                    <div class="">
                        <a type="button" href="{{ route('home-presences.indexuserdashboard') }}" class="text-gray-500 hover:text-white bg-gray-200 hover:bg-slate-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 mt-6 text-center nx-2">Kembali</a>
                    </div>  
                </div>
            </form>      
        </div>
    </div>
    <!-- ====== Profile Section End -->
@endsection

@push('js')
@endpush