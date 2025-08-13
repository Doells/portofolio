<?php

namespace App\Http\Controllers;

use App\Models\DetailUser;
use App\Models\News;
use App\Models\ThumbnailNews;
use App\Models\Tagline;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function viewindex() {
        return view('landing.index', [
            "title" => "Beranda"
        ]);
    }

    public function viewannounce() {
        return view('landing.announce', [
            "title" => "Pengumuman"
        ]);
    }

    public function viewcommittee() {
        return view('landing.committee', [
            "title" => "Panitia"
        ]);
    }

    public function viewpanitia() {
        return view('landing.teamfull', [
            "title" => "Panitia"
        ]);
    }
    
    public function viewinformation() {
        // $users = DetailUser::where('user_id', Auth::user()->id)->get();
        
        return view('landing.information', [
            "title" => "Kegiatan"
        ]);
    }

    public function detailviewnews($id) {

        $news = News::where('id', $id)->first();

        $thumbnail_news = ThumbnailNews::where('news_id', $id)->get();
        $tagline = Tagline::where('news_id', $id)->get();
        
        return view('landing.detailinformationnews', compact('news', 'thumbnail_news', 'tagline'));
    }

    public function viewnews() {
        $newss = News::orderBy('created_at', 'desc')->get();

        return view('landing.informationnews', compact('newss'), ["title" => "Berita"]);
    }

    public function information() {
        return view('landing.informationintro', [
            "title" => "Informasi"
        ]);
    }
}
