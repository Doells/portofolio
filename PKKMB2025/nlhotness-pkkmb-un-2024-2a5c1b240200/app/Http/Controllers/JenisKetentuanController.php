<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\Dashboard\JenisKetentuan\StoreJenisKetentuanRequest;
use App\Http\Requests\Dashboard\JenisKetentuan\UpdateJenisKetentuanRequest;

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

class JenisKetentuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisketentuann = JenisKetentuan::orderBy('created_at', 'desc')->get();
        
        return view('dashboard.admin.jenisketentuan.index', compact('jenisketentuann'), ["title" => "Jenis Ketentuan"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.jenisketentuan.create', ["title" => "Tambah Jenis Ketentuan"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJenisKetentuanRequest $request)
    {
        $data = $request->all();

        $data['users_id'] = Auth::user()->id;

        // add to jenis ketentuan
        $jenisketentuan = JenisKetentuan::create($data);

        return redirect()->route('admin.jenisketentuan.index');
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
    public function edit(JenisKetentuan $jenisketentuan)
    {
        return view('dashboard.admin.jenisketentuan.edit', compact('jenisketentuan'), ["title" => "Edit Jenis Ketentuan"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenisKetentuanRequest $request, JenisKetentuan $jenisketentuan)
    {
        $data = $request->all();

        // update to jenis ketentuan
        $jenisketentuan->update($data);

        return redirect()->route('admin.jenisketentuan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jenisketentuan = JenisKetentuan::find($id);

        if ($jenisketentuan) {
            $jenisketentuan->delete();
            
            // toast()->success('Berita berhasil dihapus');
            return back();
        } else {
            // toast()->success('Berita tidak ditemukan');
            return back();
        }
    }
}
