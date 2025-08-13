<?php

namespace App\Http\Controllers\Api;

use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\Permission;
use App\Models\Presence;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class HomePresenceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::query()
            // ->with('positions')
            ->get()
            ->sortByDesc('data.is_end')
            ->sortByDesc('data.is_start');
    
        // Mengembalikan data dalam format JSON
        return response()->json([
            'title' => 'Data Presensi',
            'attendances' => $attendances
        ]);
    }    

    public function show(Attendance $attendance)
    {
        // Mendapatkan data presensi terkait
        $presences = Presence::query()
            ->where('attendance_id', $attendance->id)
            
            ->get();
    
        // Menentukan apakah sudah absen hari ini
        $isHasEnterToday = $presences
            ->where('presence_date', now()->toDateString())
            ->isNotEmpty();
    
        $data = [
            'is_has_enter_today' => $isHasEnterToday, // sudah absen masuk
            // 'is_not_out_yet' => $presences->where('presence_out_time', null)->isNotEmpty(), // belum absen pulang
        ];
    
        // Mendapatkan riwayat presensi
        $history = Presence::query()
            
            ->where('attendance_id', $attendance->id)
            ->get();
    
        // Menghitung periode tanggal
        $priodDate = CarbonPeriod::create($attendance->created_at->toDateString(), now()->toDateString())
            ->toArray();
    
        foreach ($priodDate as $i => $date) { // mendapatkan hanya string date
            $priodDate[$i] = $date->toDateString();
        }
    
        $priodDate = array_slice(array_reverse($priodDate), 0, 30);
    
        // Mengembalikan data dalam format JSON
        return response()->json([
            'title' => 'Informasi presensi Kehadiran',
            'attendance' => $attendance,
            'data' => $data,
            'history' => $history,
            'priodDate' => $priodDate
        ]);
    }    
    
    // for qrcode
    public function sendEnterPresenceUsingQRCode(Request $request)
    {   
        $qrCode = $request->input('qr_code');

        $explodeQrCode = explode('-', $qrCode);

        $user_id = $explodeQrCode[0];
        $code = $explodeQrCode[1];

        $attendance = Attendance::query()->where('code', $code)->first();

        if ($attendance->exists() && User::where('id', $user_id)->exists()) {
            // Cek apakah pengguna sudah melakukan presensi masuk pada tanggal yang sama
            $isEnteredToday = Presence::query()
            ->where('user_id', $user_id)
            ->where('attendance_id', $attendance->id)
            ->whereDate('presence_date', $attendance->date /* now()->toDateString() */)
            ->exists();

            if ($isEnteredToday) {
                return response()->json([
                    "status" => "Gagal",
                    "message" => "Anda sudah melakukan presensi masuk pada sesi ini."
                ], 400);
            }

            // fix: user bisa presensi dengan tanggal yang sama, cek apakah user id attendance id dan presence date sudah ada oke
            $tambahDataPresensi = Presence::create([
                "user_id" => $user_id,
                "attendance_id" => $attendance->id,
                "presence_date" => $attendance->date /* now()->toDateString() */,
                "presence_enter_time" => now()->toTimeString(),
                'is_permission' => false,
                /* "presence_out_time" => null */
            ]);

            return response()->json([
                "status" => "Berhasil",
                "message" => "Kehadiran atas nama '" . $tambahDataPresensi->user->name . "' berhasil dikirim."
            ]);

            return response()->json([
                "status" => "Gagal",
                "message" => "Terjadi masalah pada saat melakukan presensi."
            ], 400);
        } else {
            return response()->json([
                "status" => "Gagal",
                "message" => "Data Peserta Tidak ditemukan."
            ], 400);
        }
        
    }
}
