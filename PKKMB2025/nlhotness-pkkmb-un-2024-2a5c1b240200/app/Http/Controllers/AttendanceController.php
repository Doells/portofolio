<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.presences.add-data.attendances.index', [
            "title" => "Presensi"
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.presences.add-data.attendances.create', [
            "title" => "Tambah Data Presensi"
        ]);
    }

    public function edit()
    {
        return view('dashboard.admin.presences.add-data.attendances.edit', [
            "title" => "Edit Data Presensi",
            "attendance" => Attendance::findOrFail(request('id'))
        ]);
    }

    public function destroy(Attendance $attendance)
    {
        try {
            $attendance->delete();
            return back()->with('success', 'Data absensi berhasil dihapus.');
        } catch (\Exception $ex) {
            return back()->with('error', 'Gagal menghapus data absensi.');
        }
    }
}
