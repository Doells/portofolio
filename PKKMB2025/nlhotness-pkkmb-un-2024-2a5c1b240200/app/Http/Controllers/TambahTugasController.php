<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TambahTugas;
use Illuminate\Http\Request;

class TambahTugasController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.task.add-data.index', [
            "title" => "Tugas"
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.task.add-data.create', [
            "title" => "Tambah Data Tugas"
        ]);
    }

    public function edit()
    {
        return view('dashboard.admin.task.add-data.edit', [
            "title" => "Edit Data Tugas",
            "tambahtugas" => TambahTugas::findOrFail(request('id'))
        ]);
    }

    public function destroy(TambahTugas $tambahtugas)
    {
        try {
            $tambahtugas->delete();
            return back()->with('success', 'Data tugas berhasil dihapus.');
        } catch (\Exception $ex) {
            return back()->with('error', 'Gagal menghapus data tugas.');
        }
    }
}
