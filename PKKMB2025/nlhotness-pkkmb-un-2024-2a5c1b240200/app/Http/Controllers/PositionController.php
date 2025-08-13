<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.positions.index', [
            "title" => "Posisi Pengguna"
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.positions.create', [
            "title" => "Tambah Data Posisi"
        ]);
    }

    public function edit()
    {
        return view('dashboard.admin.positions.edit', [
            "title" => "Edit Data Presensi",
            "positions" => Position::findOrFail(request('id'))
        ]);
    }

    public function destroy(Position $position)
    {
        try {
            $position->delete();
            return back()->with('success', 'Data posisi berhasil dihapus.');
        } catch (\Exception $ex) {
            return back()->with('error', 'Gagal menghapus data posisi.');
        }
    }
}
