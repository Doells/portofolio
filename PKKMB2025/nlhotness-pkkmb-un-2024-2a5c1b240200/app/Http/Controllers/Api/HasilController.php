<?php

namespace App\Http\Controllers;

use App\Exports\HasilDataExport;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Pelanggaran;
use App\Models\Presence;
use App\Models\TambahTugas;
use App\Models\Task;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Ambil informasi position_id yang sudah disimpan saat sesi presensi dibuat
        $positionPeserta = '1'; // Sesuaikan dengan informasi yang sesuai

        // Hitung jumlah sesi presensi dengan position_id = 1
        $presencesCount = Attendance::query()
            ->whereHas('positions', function ($query) use ($positionPeserta) {
                $query->where('position_id', $positionPeserta);
            })
            ->count();

        $peserta = User::where('position_id', '1')->orderBy('kelompok_id', 'asc')->orderBy('name', 'asc')->get();
        $pelanggaran = Pelanggaran::whereIn('peserta_id', $peserta->pluck('id'))->get();
        $presensi = Presence::whereIn('user_id', $peserta->pluck('id'))->get();
        $tugas = Task::whereIn('user_id', $peserta->pluck('id'))->get();
        
        //dd($pelanggaran);
        return view('dashboard.admin.hasil.index', compact('peserta', 'pelanggaran', 'presensi'), [
            "title" => "Hasil Kelulusan",
            "taskCount" => TambahTugas::count(),
            "presencesCount" => $presencesCount,
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new HasilDataExport, 'hasil-data.xlsx');
    }

}
