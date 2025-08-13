@extends('layouts.landing.base')

@section('content')
    <section class="w-full bg-space-back pt-10 lg:pt-36 px-6 lg:px-20">
        
            @if (count($newss))
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    @forelse ($newss as $item)
                        <a href="{{ route('detail-informasi-berita', $item->id) }}" class="overflow-hidden inline-block transform transition-all hover:-translate-y-2 duration-300" target="_blank">
                            {{-- <img class="object-cover mb-5" src="{{ asset('/src/img/testnews.jpeg') }}" alt="thumbnail"> --}}
                            @if ($item->thumbnail_news[0]->thumbnail != NULL)
                                <img class="object-cover mb-5" src="{{ url(Storage::url($item->thumbnail_news[0]->thumbnail)) }}" alt="thumbnails" loading="lazy" />    
                            @else
                                <img class="object-cover mb-5" src="{{ asset('/src/img/testnews.jpeg') }}" alt="placeholder" />
                            @endif

                            <div class="px-4">
                                <h2 class="font-normal text-xs lg:text-sm text-slate-400 mb-2">
                                    {{ $item->created_at ? $item->created_at->format('d-m-Y') : '' }}
                                </h2>
                
                                <h1 class="uppercase font-semibold text-white text-justify hover:text-space-textungu text-xl mb-2">
                                    {{ $item->title ?? '' }}
                                </h1>
                                
                                <p class="font-normal text-sm text-slate-400 mb-20 text-justify">
                                    @php
                                        $text = $item->description ?? '';
                                        $words = str_word_count($text, 1);
                                        $limitedWords = array_slice($words, 0, 50);
                                        $limitedText = implode(' ', $limitedWords);
                                        $limitedText .= ' ...';
                                        echo $limitedText;
                                    @endphp
                                </p>
                            </div>
                        </a>
                    @empty
                        {{-- empty --}}
                    @endforelse
                </div>
            @else
                <div class="h-screen pt-2 lg:pt-8">
                    <div class="w-full flex flex-col justify-center items-center text-center">
                        <img src="{{ asset('/src/img/maskot_pkkmb_maaf_2.png') }}" alt="" class="w-32 mb-2">
        
                        <h2 class="mb-1 text-2xl lg:text-3xl font-semibold text-white">
                            Mohon maaf kak, saat ini berita apapun belum pernah dibuat
                        </h2>
                        
                        <p class="text-sm lg:text-base text-slate-100">
                            Berita akan kami perbaharui secepatnya ya kak. <br>
                            Jadi jangan lupa ditunggu pembaharuan dari kami!
                        </p>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection