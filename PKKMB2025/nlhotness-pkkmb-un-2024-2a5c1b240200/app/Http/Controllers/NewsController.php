<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\Dashboard\News\StoreNewsRequest;
use App\Http\Requests\Dashboard\News\UpdateNewsRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;
use App\Models\News;
use App\Models\ThumbnailNews;
use App\Models\Tagline;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $newss = News::where('users_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $newss = News::orderBy('created_at', 'desc')->get();
        
        return view('dashboard.admin.news.index', compact('newss'), ["title" => "Berita"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.news.create', ["title" => "Tambah Berita"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $data = $request->all();

        $data['users_id'] = Auth::user()->id;

        // add to news
        $news = News::create($data);

        // add to thumbnail news
        if($request->hasfile('thumbnail'))
        {
            foreach($request->file('thumbnail') as $file)
            {
                $path = $file->store(
                    'assets/news/thumbnail', 'public'
                );

                $thumbnail_news = new ThumbnailNews;
                $thumbnail_news->news_id = $news['id'];
                $thumbnail_news->thumbnail = $path;
                $thumbnail_news->save();
            }
        }

        //add to tagline
        foreach ($data['tagline'] as $key => $value)
        {
            $tagline = new Tagline;
            $tagline->news_id = $news->id;
            $tagline->tagline = $value;
            $tagline->save();
        }

        // toast()->success('Informasi berhasil dibuat');
        return redirect()->route('admin.news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $thumbnail_news = ThumbnailNews::where('news_id', $news['id'])->get();
        $tagline = Tagline::where('news_id', $news['id'])->get();

        return view('dashboard.admin.news.edit', compact('news', 'thumbnail_news', 'tagline'), ["title" => "Edit Berita"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $data = $request->all();

        // update to news
        $news->update($data);

        // update to thumbnail news
        if($request->hasfile('thumbnails')){
            foreach ($request->file('thumbnails') as $key => $file)
            {
                // get old photo thumbnail
                $get_photo = ThumbnailNews::where('id', $key)->first();

                // store photo
                $path = $file->store(
                    'assets/news/thumbnail'. 'public'
                );

                // update thumbnail
                $thumbnail_news = ThumbnailNews::find($key);
                $thumbnail_news->thumbnail = $path;
                $thumbnail_news->save();

                // delete old photo thumbnail
                $data = 'storage/'.$get_photo['photo'];
                if(Storage::exists($data)){
                    Storage::delete($data);
                }else{
                    Storage::delete('storage/app/public/'.$get_photo['photo']);
                }
            }
        }

        // add new thumbnail news
        if($request->hasfile('thumbnail'))
        {
            foreach($request->file('thumbnail') as $file)
            {
                $path = $file->store(
                    'assets/news/thumbnail', 'public'
                );

                $thumbnail_news = new ThumbnailNews;
                $thumbnail_news->news_id = $news['id'];
                $thumbnail_news->thumbnail = $path;
                $thumbnail_news->save();
            }
        }

        // update to tagline
        foreach($data['taglines'] as $key => $value){
            $tagline = Tagline::find($key);
            $tagline->tagline = $value;
            $tagline->save();
        }

        // add new tagline
        if(isset($data['tagline'])){
            foreach($data['tagline'] as $key => $value){
                $tagline = New Tagline;
                $tagline->news_id = $news['id'];
                $tagline->tagline = $value;
                $tagline->save();
            }
        }

        // toast()->success('Pembaharuan data sukses');
        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news = News::find($id);

        if ($news) {
            $news->thumbnail_news()->delete();
            $news->tagline()->delete();
            $news->delete();
            
            // toast()->success('Berita berhasil dihapus');
            return back();
        } else {
            // toast()->success('Berita tidak ditemukan');
            return back();
        }
    }
}
