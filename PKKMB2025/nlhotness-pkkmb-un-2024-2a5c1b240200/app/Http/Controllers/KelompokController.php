<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use Illuminate\Http\Request;

class KelompokController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.kelompok.index', [
            "title" => "Data Kelompok"
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.kelompok.create', [
            "title" => "Tambah Data Kelompok",
            "kelompok" => "kelompok"
        ]);
    }

    public function edit()
    {
        return view('dashboard.admin.kelompok.edit', [
            "title" => "Edit Data Kelompok",
            "kelompok" => Kelompok::findOrFail(request('id'))
        ]);
    }

    public function destroy(Kelompok $kelompok)
    {
        try {
            $kelompok->delete();
            return back()->with('success', 'Data kelompok berhasil dihapus.');
        } catch (\Exception $ex) {
            return back()->with('error', 'Gagal menghapus data kelompok.');
        }
    }
}
