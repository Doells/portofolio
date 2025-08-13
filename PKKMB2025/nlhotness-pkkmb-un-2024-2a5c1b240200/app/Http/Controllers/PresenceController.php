<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Permission;
use App\Models\Presence;
use App\Models\UniqueCode;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PresenceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all()->sortByDesc('data.is_end')->sortByDesc('data.is_start');

        return view('dashboard.admin.presences.index', [
            "title" => "Daftar Presensi Dengan Kehadiran",
            "attendances" => $attendances
        ]);
    }

    public function show(Attendance $attendance)
    {
        $attendance->load(['positions', 'presences']);

        // dd($qrcode);
        return view('dashboard.admin.presences.show', [
            "title" => "Data Detail Kehadiran",
            "attendance" => $attendance,
        ]);
    }

    public function destroy(Presence $presence)
    {
        try {
            $presence->delete();
            Alert::success('Berhasil!', 'Presensi peserta berhasil dihapus.');
            return redirect()->back();
        } catch (\Exception $ex) {
            Alert::error('Gagal!', 'Presensi peserta gagal dihapus.');
            return redirect()->back();
        }
    }

    public function showQrcode()
    {
        $code = request('code');

        $userId = auth()->user()->id;
        
        $randomString = UniqueCode::pluck('unique_code')->random(); // Menghasilkan string acak sepanjang 10 karakter
        $timestamp = Carbon::now()->timestamp; // Mendapatkan timestamp saat ini

        $qrCodeContent = "kode-{$randomString}-{$code}-{$userId}-{$timestamp}";

        $encryptQrCodeContent = Crypt::encryptString($qrCodeContent);
        $explodeQrCodeContent = explode('-', $qrCodeContent);

        $dataSesiPresensi = Attendance::where('code', $explodeQrCodeContent[2])->get()->first();

        $qrcode =  "data:image/svg+xml;base64," . base64_encode(QrCode::size(300)->style('round')->generate($encryptQrCodeContent));

        return view('dashboard.admin.presences.qrcode', [
            "title" => "Presensi QRCode",
            "qrcode" => $qrcode,
            "code" => $code, // Pastikan kode tersedia di view
            "dataSesiPresensi" => $dataSesiPresensi
        ]);
    }

    /* public function generateQrCode(Request $request)
    {
        $code = $request->input('code'); // Ambil kode dari permintaan
        
        // Validasi bahwa $code ada di database
        if (!$code || !Attendance::query()->where('code', $code)->exists()) {
            return response()->json(['error' => 'Data Sesi Presensi tidak ditemukan!'], 404);
        }
    
        $randomString = Str::random(10); // Menghasilkan string acak sepanjang 10 karakter
        $qrCodeContent = "kode-{$randomString}-{$code}";
    
        // Generate QR code dan ubah ke base64
        $qrCodeImage =  "data:image/svg+xml;base64," . base64_encode(QrCode::size(300)->style('round')->generate($qrCodeContent));
        $base64QrCode = base64_encode($qrCodeImage);
    
        return response()->json(['qr_code' => $qrCodeImage]);
    } */

    public function checkDataQrCode(Request $request)
    {
        $code = $request->input('code');

        if(!$code){
            Alert::error('Gagal!', 'QR Code tidak valid!');
            return redirect()->back();
        }

        $decryptQrCodeContent = Crypt::decryptString($code);

        // Memecah string berdasarkan delimiter koma
        $dataQrCode = explode('-', $decryptQrCodeContent);
        
        list($prefix, $randomString, $qrCode, $userId, $timestamp) = $dataQrCode;
        
        // Periksa apakah QR code sudah kadaluarsa
        $currentTimestamp = Carbon::now()->timestamp;
        $expiryTime = 30; // Waktu kadaluarsa dalam detik
        
        if (($currentTimestamp - $timestamp) > $expiryTime) {
            Alert::error('Gagal!', 'QR Code sudah tidak berlaku!');
            return redirect()->back();
        }  

        $dataUser = User::where('id', $dataQrCode[3])->with('detailuser', 'kelompok', 'position')->get()->first();
        $dataSesiPresensi = Attendance::where('code', $dataQrCode[2])->get()->first();

        // Cek apakah pengguna sudah melakukan presensi masuk pada tanggal yang sama
        $isEnteredToday = Presence::query()
        ->where('user_id',  $dataQrCode[3])
        ->where('attendance_id', $dataSesiPresensi->id)
        ->whereDate('presence_date', $dataSesiPresensi->date /* now()->toDateString() */)
        ->exists();

        return view('dashboard.admin.presences.check-data', [
            "title" => "Presensi QRCode",
            "dataUser" => $dataUser,
            "dataSesiPresensi" => $dataSesiPresensi,
            "code" => $code,
            "statusPresensi" => $isEnteredToday, 
        ]);
    }

    // for qrcode
    public function sendEnterPresenceUsingQRCode(Request $request)
    {   
        // Misalkan input code berupa string seperti 'value1,value2,value3'
        $code = $request->input('code');

        $decryptQrCodeContent = Crypt::decryptString($code);

        // Memecah string berdasarkan delimiter koma
        $dataQrCode = explode('-', $decryptQrCodeContent);
        $uniqueCodeCheck = UniqueCode::where('unique_code', $dataQrCode[1])->get()->first();

        if($uniqueCodeCheck){
            $attendance = Attendance::query()->where('code', $dataQrCode[2])->first();
            $userId = $dataQrCode[3];
            $dataUser = User::where('id', $userId)->get()->first();

            // Cek apakah pengguna sudah melakukan presensi masuk pada tanggal yang sama
            $isEnteredToday = Presence::query()
            ->where('user_id',  $dataQrCode[3])
            ->where('attendance_id', $attendance->id)
            ->whereDate('presence_date', $attendance->date /* now()->toDateString() */)
            ->exists();

            if ($isEnteredToday) {
                Alert::error('Gagal!', 'Peserta sudah melakukan presensi masuk pada sesi ini.');
                return redirect()->route('presences.show', $attendance->id);
            }
            
            // fix: user bisa presensi dengan tanggal yang sama, cek apakah user id attendance id dan presence date sudah ada
            $kirimPresensi = Presence::create([
                "user_id" => $userId,
                "attendance_id" => $attendance->id,
                "presence_date" => $attendance->date /* now()->toDateString() */,
                "presence_enter_time" => now()->toTimeString(),
                'is_permission' => false,
                /* "presence_out_time" => null */
            ]);

            if($kirimPresensi){
                Alert::success('Berhasil!', "Kehadiran atas nama '" . $dataUser->name . "' berhasil dikirim.");
                return redirect()->route('presences.show', $attendance->id);
            }

            return redirect()->route('presences.show', $attendance->id);
        } else {
            Alert::error('Gagal', 'QR Code tidak valid, coba lagi!');
            return redirect()->back();
        }
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
