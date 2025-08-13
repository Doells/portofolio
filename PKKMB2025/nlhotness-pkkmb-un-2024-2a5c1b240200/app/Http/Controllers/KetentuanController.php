<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\Dashboard\Ketentuan\StoreKetentuanRequest;
use App\Http\Requests\Dashboard\Ketentuan\UpdateKetentuanRequest;

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

class KetentuanController extends Controller
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
        $ketentuann = Ketentuan::orderBy('created_at', 'desc')->get();
        
        return view('dashboard.admin.ketentuan.index', compact('ketentuann'), ["title" => "Ketentuan"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ketentuann = Ketentuan::orderBy('created_at', 'desc')->get();
        $jenisketentuann = JenisKetentuan::orderBy('title', 'asc')->get();

        return view('dashboard.admin.ketentuan.create', compact('ketentuann', 'jenisketentuann'), ["title" => "Tambah Ketentuan"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKetentuanRequest $request)
    {
        $data = $request->all();

        $data['users_id'] = Auth::user()->id;

        // add to ketentuan
        $ketentuan = Ketentuan::create($data);

        return redirect()->route('admin.ketentuan.index');
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
    public function edit(Ketentuan $ketentuan)
    {
        $jenisketentuann = JenisKetentuan::orderBy('title', 'asc')->get();
        
        return view('dashboard.admin.ketentuan.edit', compact('ketentuan', 'jenisketentuann'), ["title" => "Edit Ketentuan"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKetentuanRequest $request, Ketentuan $ketentuan)
    {
        $data = $request->all();

        // update to ketentuan
        $ketentuan->update($data);

        return redirect()->route('admin.ketentuan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ketentuan = Ketentuan::find($id);

        if ($ketentuan) {
            $ketentuan->delete();
            
            // toast()->success('Ketentuan berhasil dihapus');
            return back();
        } else {
            // toast()->success('Ketentuan tidak ditemukan');
            return back();
        }
    }
}
