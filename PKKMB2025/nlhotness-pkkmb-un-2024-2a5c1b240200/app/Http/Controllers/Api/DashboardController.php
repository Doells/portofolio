<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Kelompok;
use App\Models\Pelanggaran;
use App\Models\Position;
use App\Models\Presence;
use App\Models\Task;
use Carbon\CarbonPeriod;
use App\Models\TambahTugas;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {   
        $positionIdPeserta = 1; // Ganti dengan nilai yang sesuai dengan kondisi Anda
        $positionIdPanitia = 2; // Ganti dengan nilai yang sesuai dengan kondisi Anda

        $pesertaCount = User::query()
            ->where('position_id', $positionIdPeserta)
            ->count();

        $panitiaCount = User::query()
            ->where('position_id', $positionIdPanitia)
            ->count();

        return view('dashboard.admin.index', [
            "title" => "Dashboard Admin",
            "positionCount" => Position::count(),
            "kelompokCount" => Kelompok::count(),
            "userCount" => User::count(),
            "taskCount" => TambahTugas::count(),
            "pelanggaranCount" => Pelanggaran::count(),
            "presencesCount" => Attendance::count(),
            "pesertaCount" => $pesertaCount,
            "panitiaCount" => $panitiaCount,
        ]);
    }

    public function indexuserdashboard()
    {
        $presencesCount = Attendance::query()
            // ->with('positions')
            ->forCurrentUser(auth()->user()->position_id)
            ->count();

        return view('dashboard.user.index', [
            "title" => 'Dashboard',
            "taskCount" => TambahTugas::count(),
            "presencesCount" => $presencesCount,
        ]);
    }
}
