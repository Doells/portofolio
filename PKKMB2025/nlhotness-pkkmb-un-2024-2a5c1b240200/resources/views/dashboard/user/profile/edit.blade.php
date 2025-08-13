@extends('layouts.dashboard.app')

@section('content')
<div class="bg-fixed rounded-xl lg:px-20 px-5 py-10" style="background-image: url('/src/img/svg/bg/flat-mountains.svg')">
    <div class="container py-[100px] lg:px-20 rounded-2xl bg-white shadow-lg">
        <div class="container flex items-center justify-center mx-auto bg-white rounded-[43px]">
            <div class="items-center text-center">
                <div class="pb-5 container mx-auto">
                    <div class="font-bold text-2xl">
                    <h1 class="mb-4 font-poppins font-extrabold text-[38px] lg:text-[64px] text-[#33458F]">
                        PROFILE PESERTA
                    </h1>
                    </div>
                    <img src="../../../../src/img/PKKMB 1.png" title="PKKMB 1.png" class="container mx-auto w-1/2 h-1/2 border-b-8 border-[#FF9B2F]"/>
                </div>
            </div>
        </div>
        <form 
        id="formAccountSettings" 
        method="POST" 
        action="{{ route('dashboard-user.profileupdate',auth()->id()) }}" 
        enctype="multipart/form-data"
        class="needs-validation" 
        role="form"
        novalidate>
        @method('PATCH')
        @csrf
        <div class="relative z-0 w-full mb-6 group">
            <label for="NIM" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIM</label>
            <input type="text" name="name" id="name" class="block py-2.5  w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->nim }}" disabled />
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="NIM" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
            <input type="text" name="nim" id="nim" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->name }}" disabled />
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Nama Lengkap" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->nama_lengkap }}"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Kelompok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelompok</label>
            <input type="text" name="kelompok" id="kelompok" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->kelompok->name  ?? 'Belum masuk kelompok' }}" disabled/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Posisi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Posisi</label>
            <input type="text" name="position" id="position" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->position->name }}" disabled/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Prodi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Program Studi</label>
            <input type="text" name="prodi" id="prodi" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->prodi }}" disabled/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Fakultas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fakultas</label>
            <input type="text" name="fakultas" id="fakultas" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->fakultas }}" disabled/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="No HP" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Telepon</label>
            <input type="text" name="no_hp" id="no_hp" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->no_hp }}"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="text" name="email" id="email" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->email }}"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Sistem Kuliah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sistem Kuliah</label>
            <input type="text" name="sistem_kuliah" id="sistem_kuliah" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->sistem_kuliah }}" disabled/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Tahun Angkatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Angkatan</label>
            <input type="text" name="tahun_angkatan" id="tahun_angkatan" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->tahun_angkatan }}" disabled/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Jalur Penerimaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jalur Penerimaan</label>
            <input type="text" name="jalur_penerimaan" id="jalur_penerimaan" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->jalur_penerimaan }}" disabled/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Jenis Kelamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
            <select type="text" name="jenis_kelamin" id="jenis_kelamin" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->jenis_kelamin }}">
                <option disabled>-- Pilih Jenis Kelamin--</option>
                <option value="Laki - laki">Laki - laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Tanggal Lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" id="tgl_lahir" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->tgl_lahir }}"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Tempat Lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->tempat_lahir }}"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Agama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agama</label>
            <input type="text" name="agama" id="agama" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->agama }}"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="Alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none px-3" value="{{ auth()->user()->detailuser->alamat }}"/>
        </div>
        <div class="flex justify-end gap-x-3">
            <div class="">
                <a type="button" href="{{ route('dashboard-user.profileindex') }}" class="text-gray-500 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 mt-6 text-center nx-2">Kembali</a>
            </div>  
            <div class="">
                <button type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 mt-6 text-center nx-2">Simpan</button>
            </div>  
        </div>
    </form>
    <div>
</div>
@endsection

@push('js')
@endpush