<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendance = Attendance::get()->all();
        return response([
            'success' => true,
            'message' => 'List Semua Data Kehadiran',
            'data' => $attendance
        ], 200);
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
