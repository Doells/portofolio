@extends('layouts.landing.base')

@section('content')
    <section id="panitia" class="w-full bg-[#000000] flex flex-col items-center">
        <div class="lg:px-32">
            <div id="title_panitia" class="flex flex-col text-center pt-32 lg:px-16 pb-5 border-b-4">
                <h1 class="lg:text-5xl text-xl text-white font-extrabold mb-2">KEPANITIAN PKKMB</h1>
                <h2 class="lg:text-5xl text-xl whitespace-nowrap text-white font-extrabold mb-2">UNIVERSITAS NAROTAMA</h2>
                <h2 class="lg:text-5xl text-xl text-white font-extrabold mb-5">TAHUN 2024</h2>
            </div>
        </div>
        
        <div class="pt-20 px-10 w-full flex flex-col lg:flex-row lg:flex-wrap items-center text-center mb-20 gap-y-5">
            <div class="mx-auto">
                <a id="pak_tahegga" href="{{ url('https://www.instagram.com/taheggaalfath/') }}" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/pak_tahegga.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Dr. Tahegga Primananda Alfath, S.H., M.H.
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Ketua Panitia Pengarah Universitas
                            </h2>
                        </div>
                    </div>
                </a>
            
                <a id="fredy" href="{{ url('https://www.instagram.com/fredypradanapu2/') }}" class="inline-block px-3 mb-5" target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/freddy.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-2xl lg:text-base mb-3">
                                Fredy Pradana Putra
                            </h1>
                            <h2 class="font-normal text-slate-600 text-base lg:text-sm flex flex-wrap">
                                Anggota Panitia Pengarah Universitas
                            </h2>
                        </div>
                        
                    </div>
                </a>
            
                <a id="m_syaiful" class="inline-block px-3 mb-5" target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/m_syaiful.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-3">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-2xl lg:text-base mb-3">
                                Muhammad Syaiful
                            </h1>
                            <h2 class="font-normal text-slate-600 text-base lg:text-sm flex flex-wrap">
                                Ketua Panitia Pengarah Mahasiswa
                            </h2>
                        </div>
                        
                    </div>
                </a>
            
                <a id="ilda" class="inline-block px-3 mb-5" target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        
                        <div>
                            <img src="{{ asset('/src/img/Panitia/ilda.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-3">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-2xl lg:text-base mb-3">
                                Ilda Annisa Afifah
                            </h1>
                            <h2 class="font-normal text-slate-600 text-base lg:text-sm flex flex-wrap">
                                Anggota Panitia Pengarah Mahasiswa
                            </h2>
                        </div>
                        
                    </div>
                </a>
            
                <a id="juliana" class="inline-block px-3 mb-5" target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/juliana.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-3">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-2xl lg:text-base mb-3">
                                Juliana Fitria
                            </h1>
                            <h2 class="font-normal text-slate-600 text-base lg:text-sm flex flex-wrap">
                                Ketua Pelaksana
                            </h2>
                        </div>
                    </div>
                </a>

                <a id="wiwin_s" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/wiwin_s.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Wiwin Sri Yunasti L
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Koordinator Divisi Acara Kreatif
                            </h2>
                        </div>
                    </div>
                </a>
                
                <a id="alya_m" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/alya_m.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Alya Marshanda
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Acara Kreatif
                            </h2>
                        </div>
                    </div>
                </a>

                <a id="dary_a" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/dary_a.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Daryy Ahmad P
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Acara Kreatif
                            </h2>
                        </div>
                    </div>
                </a>

                <a id="raehan_n" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/raehan_n.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Raehan Nova P
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Acara Kreatif
                            </h2>
                        </div>
                    </div>
                </a>

                <a id="defriani_f" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/defriani_f.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Defriani Fari D
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Acara Kreatif
                            </h2>
                        </div>
                    </div>
                </a>

                <a id="nilasari_e" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/nilasari_e.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Nilasari Eka A
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Koordinator Divisi Kesekretariatan
                            </h2>
                        </div>
                    </div>
                </a>

                <a id="rima_f" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/rima_f.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Rima Fifi A
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Kesekretariatan
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="ahmad_c" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/ahmad_c.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Ahmad Chafidulloh
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Kesekretariatan
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="tika_m" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/tika_m.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Tika Marfuatinatin
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Kesekretariatan
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="akbar_b" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/akbar_b.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Akbar Bahrum L
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Koordinator Divisi Dokumentasi & Teknologi Informasi
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="bagus_a" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/bagus_a.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Bagus Adianto
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Dokumentasi & Teknologi Informasi
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="yusron" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/yusron.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Yusron Rafif R
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Dokumentasi & Teknologi Informasi
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="muhammad_r" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/muhammad_r.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Muhammad Reza A
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Dokumentasi & Teknologi Informasi
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="mochammad_d" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/mochammad_d.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Mochammad Dicky T
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Dokumentasi & Teknologi Informasi
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="ainun_r" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/ainun_r.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Ainun Rahmadhani
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Dokumentasi & Teknologi Informasi
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="moh_a" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/moh_a.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Moh. A
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Koordinator Divisi Perlengkapan & Kesehatan
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="ariyan_h" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/ariyan_h.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Ariyan Hendarto
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Perlengkapan & Kesehatan
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="muhammad_n" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/muhammad_n.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Muhammad Naufal R
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Perlengkapan & Kesehatan
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="fransiska_l" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/fransiska_l.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Fransiska Langur
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Perlengkapan & Kesehatan
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="sahal_f" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/sahal_f.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Sahal Fahmi
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Perlengkapan & Kesehatan
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="cindy_n" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/cindy_n.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Cindy Nafa Az Zahra
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Perlengkapan & Kesehatan
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="m_fajar" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/m_fajar.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                M. Fajar Aditiawan
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Koordinator Divisi Humas
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="maria_t" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/maria_t.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Maria Trinova W
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Humas
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="muhammad_k" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/muhammad_k.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Muhammad Khakim A
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Humas
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="toti_v" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/toti_v.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Toti Valentino P
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Koordinator Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="choirul_u" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/choirul_u.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Choirul Umam
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="laili_n" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/laili_n.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Laili Nurkhayati
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="erlina_n" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/erlina_n.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Erlina Nurya U
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="indriani_s" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/indriani_s.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Indriani Surya D
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="sri_n" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/sri_n.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-60 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Sri Nur Akhidah
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="vyka_c" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/vyka_c.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Vyka Chusna Arifah
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="ruhul_j" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/ruhul_j.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Ruhul Jihad Al Islamy
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="arya_r" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/arya_r.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Arya Rifqy Fahrezi
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="aprillia_c" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/aprillia_c.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Aprillia Christin Busu
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="khofifah_i" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/khofifah_i.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Khofifah Indah P
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="amelia" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/amelia.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Amelia
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="asriana_k" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/asriana_k.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Asriana Kartini
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
                <a id="faudia_c" class="inline-block px-3 mb-5 " target="_blank">
                    <div class="w-64 lg:w-44 h-[420px] lg:h-80 bg-[#FFCE43] hover:bg-white rounded-md shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 duration-300 flex flex-col items-center pt-2">
                        <div>
                            <img src="{{ asset('/src/img/Panitia/faudia_c.png') }}" alt="placeholder" class="rounded-md aspect-[9/16] w-64 lg:w-80 object-cover mb-3">
                        </div>
                        <div class="absolute px-1">
                            <!--Title and Date-->
                            <h1 class="font-bold text-space-back text-base lg:text-[10px] pb-1">
                                Faudia Cholifatul Habibah
                            </h1>
                            <h2 class="font-normal text-slate-600 text-sm lg:text-[10px]">
                                Anggota Divisi Naradamping
                            </h2>
                        </div>
                    </div>
                </a>
        
            </div>
        </div>
    </section>
@endsection