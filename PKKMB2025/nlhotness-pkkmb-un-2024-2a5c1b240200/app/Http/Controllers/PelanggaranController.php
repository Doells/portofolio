<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\Dashboard\Pelanggaran\StorePelanggaranRequest;
use App\Http\Requests\Dashboard\Pelanggaran\UpdatePelanggaranRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Pelanggaran;
use App\Models\Ketentuan;
use App\Models\JenisKetentuan;

class PelanggaranController extends Controller
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
        $peserta = User::where('position_id', '1')->orderBy('kelompok_id', 'asc')->orderBy('name', 'asc')->get();
        $pelanggaran = Pelanggaran::whereIn('peserta_id', $peserta->pluck('id'))->get();
        
        //dd($pelanggaran);
        return view('dashboard.admin.datapelanggaran.index', compact('peserta', 'pelanggaran'), ["title" => "Pelanggaran"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $peserta = User::where('position_id', '1')->orderBy('kelompok_id', 'asc')->get();
        $ketentuann = Ketentuan::orderBy('jenis_ketentuan_id', 'asc')->get();
        $jenisketentuann = JenisKetentuan::orderBy('title', 'asc')->get();

        return view('dashboard.admin.datapelanggaran.create', compact('peserta', 'ketentuann', 'jenisketentuann'), ["title" => "Tambah Catatan"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePelanggaranRequest $request)
    {
        $data = $request->all();

        $data['panitia_id'] = Auth::user()->id;

        // add to ketentuan
        $pelanggaran = Pelanggaran::create($data);

        return redirect()->route('admin.pelanggaran.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $peserta = User::findOrFail($id);
        $pelanggaran = $peserta->pelanggaran_peserta;
    
        return view('dashboard.admin.datapelanggaran.detail', compact('peserta', 'pelanggaran'), ["title" => "Detail Pelanggaran"]);
    }    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelanggaran = Pelanggaran::find($id);

        if ($pelanggaran) {
            $pelanggaran->delete();
            
            // toast()->success('Ketentuan berhasil dihapus');
            return back();
        } else {
            // toast()->success('Ketentuan tidak ditemukan');
            return back();
        }
    }










    // Custom
    // public function detail_pelanggaran($id)
    public function detail_pelanggaran()
    {
        // $peserta = User::where('position_id', '1')->orderBy('kelompok_id', 'asc')->get();
        // $pelanggaran = Pelanggaran::where('id', $id)->first();
        $pelanggarann = Pelanggaran::where('peserta_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        // return view('admin.datapelanggaran.detail', compact('pelanggaran'));
        return view('dashboard.admin.datapelanggaran.detail', compact('pelanggarann'), ["title" => "Daftar Pelanggaran"]);
    }
}
