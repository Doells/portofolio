<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Permission;
use App\Models\Presence;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PresenceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all()
            ->sortByDesc('data.is_end')
            ->sortByDesc('data.is_start')
            ->values(); // Mengubah collection menjadi array numerik
    
        return response([
            'success' => true,
            'message' => 'List Data Presensi',
            'data' => $attendances
        ], 200);
    }    

    public function show($id)
    {
        $attendance = Attendance::find($id);
        $attendance->load(['positions']);

        $dataPresensiUser = Presence::where('attendance_id', $attendance->id)
                ->with(['user' => function ($query) {
                    $query->select('id', 'name', 'kelompok_id');
                }])
                ->get();

        if ($attendance) {
            return response()->json([
                'success' => true,
                'message' => 'Data Presensi Berhasil Di Muat!',
                'data-peserta-presensi' => $dataPresensiUser,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Presensi Gagal Di Muat!',
            ], 401);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id_presence = $request->input('id');

            $presence = Presence::where('id', $id_presence)->first();
            $presence->delete();
            return back()->with('success', 'Presensi peserta berhasil dihapus.');
        } catch (\Exception $ex) {
            return back()->with('error', 'Gagal menghapus presensi peserta.');
        }
    }

    public function showQrcode()
    {
        $code = request('code');
        $qrcode = $this->getQrCode($code);

        return response([
            'success' => true,
            'message' => 'Data QR Code',
            'qrcode' => $qrcode,
            'code' => $code,
        ], 200);
    }

    public function getQrCode(?string $code): string
    {
        if (!Attendance::query()->where('code', $code)->first())
            throw new NotFoundHttpException(message: "Tidak ditemukan presensi dengan code '$code'.");

        return parent::getQrCode($code);
    }

    public function notPresent(Attendance $attendance)
    {
        $byDate = $attendance->date;
        if (request('display-by-date'))
            $byDate = request('display-by-date');

        $presences = Presence::query()
            ->where('attendance_id', $attendance->id)
            ->where('presence_date', $byDate)
            ->get(['presence_date', 'user_id']);
            

        // Get participants or committee members based on position_id
        if ($presences->isEmpty()) {
            $notPresentData[] = 
            [
                "not_presence_date" => $byDate,
                "users" => User::query()
                    ->with('position')
                    ->get()
                    ->toArray(),
            ];
        } else {
            $notPresentData = $this->getNotPresentStudents($presences);
        }

        return view('dashboard.admin.presences.not-present', [
            "title" => "Data Peserta Tidak Hadir",
            "attendance" => $attendance,
            "notPresentData" => $notPresentData
        ]);
    }

    private function getNotPresentStudents($presences)
    {
        $uniquePresenceDates = $presences->unique("presence_date")->pluck('presence_date');
        $uniquePresenceDatesAndCompactTheUserIds = $uniquePresenceDates->map(function ($date) use ($presences) {
            return [
                "presence_date" => $date,
                "user_ids" => $presences->where('presence_date', $date)->pluck('user_id')->toArray()
            ];
        });
        $notPresentData = [];
        foreach ($uniquePresenceDatesAndCompactTheUserIds as $presence) {
            $notPresentData[] =
                [
                    "not_presence_date" => $presence['presence_date'],
                    "users" => User::query()
                        ->with('position')
                        ->whereNotIn('id', $presence['user_ids'])
                        ->get()
                        ->toArray()
                ];
        }
        return $notPresentData;
    }

    public function acceptPermissionByAdmin(Request $request, $attendanceId)
    {
        //dd($request->all()); // Debugging
    
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'presence_date' => 'required|date',
            'permission_reason' => 'required|string',
        ]);
    
        //dd('Validation passed'); // Debugging
    
        // Dapatkan objek Attendance sesuai dengan $attendanceId
        $attendance = Attendance::findOrFail($attendanceId);
    
        //dd('Attendance found'); // Debugging
        
        // Dapatkan objek User sesuai dengan user_id dari input
        $user = User::findOrFail($request->user_id);
    
        //dd('User found'); // Debugging
    
        // Simpan izin dan alasan izin oleh admin ke database
        $attendance->presences()->create([
            'user_id' => $user->id,
            'presence_date' => $request->presence_date,
            "presence_enter_time" => now()->toTimeString(),
            'is_permission' => true,
            'permission_reason' => $request->permission_reason,
        ]);
    
        //dd('Permission saved'); // Debugging
    
        return redirect()->back()->with('success', "Berhasil menyimpan data izin atas nama \"$user->name\".");
    }
    
    

    public function presentUser(Request $request, $attendanceId)
    {
        //dd($request->all()); // Debugging
    
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'presence_date' => 'required|date',
        ]);
    
        //dd('Validation passed'); // Debugging
    
        // Dapatkan objek Attendance sesuai dengan $attendanceId
        $attendance = Attendance::findOrFail($attendanceId);
    
        //dd('Attendance found'); // Debugging
        
        // Dapatkan objek User sesuai dengan user_id dari input
        $user = User::findOrFail($request->user_id);
    
        //dd('User found'); // Debugging
    
        // Simpan Kehadiran
        $attendance->presences()->create([
            'user_id' => $user->id,
            'presence_date' => $request->presence_date,
            "presence_enter_time" => now()->toTimeString(),
            'is_permission' => false,
            'permission_reason' => $request->permission_reason,
        ]);
    
        //dd('Permission saved'); // Debugging

        return back()
            ->with('success', "Berhasil menyimpan data hadir atas nama \"$user->name\".");
    }
}
