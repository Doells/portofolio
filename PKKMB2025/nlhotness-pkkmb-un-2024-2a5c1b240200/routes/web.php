<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\HomePresenceController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TambahTugasController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ResultTaskController;
use App\Http\Controllers\JenisKetentuanController;
use App\Http\Controllers\KetentuanController;
use App\Http\Controllers\PelanggaranController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::middleware('role:admin,superadmin')->group(function () {
        Route::get('/dashboard/admin', [DashboardController::class, 'index'])->name('dashboard.indexadmin');
        Route::group(['prefix' => 'dashboard/admin/', 'as' => 'admin.'],
        function () {
            Route::resource('news', NewsController::class);
            Route::resource('jenisketentuan', JenisKetentuanController::class);
            Route::resource('ketentuan', KetentuanController::class);
            Route::resource('pelanggaran', PelanggaranController::class);
            // Route::get('detail_pelanggaran/{id}', [PelanggaranController::class, 'detail_pelanggaran'])->name('detail.pelanggaran');
            Route::get('/detail_pelanggaran/{id}', [PelanggaranController::class, 'show'])->name('detail.pelanggaran');
        });
        // Tambah Tugas
        Route::get('/dashboard/admin/tugas', [TambahTugasController::class, 'index'])->name('tambahtugas.index');
        Route::get('/dashboard/admin/tugas/tambah-data', [TambahTugasController::class, 'create'])->name('tambahtugas.create');
        Route::get('/dashboard/admin/tugas/edit', [TambahTugasController::class, 'edit'])->name('tambahtugas.edit');
        Route::delete('/dashboard/admin/tugas/{tambahtugas}', [TambahTugasController::class, 'destroy'])->name('tambahtugas.destroy');
        // Data Pengumpulan Tugas
        Route::get('/dashboard/admin/tugas/pengumpulan', [ResultTaskController::class, 'index'])->name('result-task.index');
        Route::get('/dashboard/admin/tugas/pengumpulan/{tambahtugas}', [ResultTaskController::class, 'show'])->name('result-task.show');
        Route::get('/dashboard/admin/tugas/pengumpulan/hasil/{task}', [ResultTaskController::class, 'showResultTaskUser'])->name('result-task.showResultTaskUser');
        Route::get('/dashboard/admin/tugas/pengumpulan/tidak-mengumpulkan/{tambahtugas}', [ResultTaskController::class, 'notSubmit'])->name('result-task.notSubmit');
        Route::put('/dashboard/admin/tugas/pengumpulan/status/{task}', [ResultTaskController::class, 'updateStatus'])->name('result-task.updateStatus');
        Route::delete('/dashboard/admin/tugas/pengumpulan/{task}', [ResultTaskController::class, 'destroy'])->name('result-task.destroy');
        
        Route::get('/dashboard/admin/presensi', [PresenceController::class, 'index'])->name('presences.index');
        Route::get('/dashboard/admin/presensi/{attendance}', [PresenceController::class, 'show'])->name('presences.show');

        Route::post('/dashboard/admin/presensi/kirim-presensi/qrcode', [PresenceController::class, 'sendEnterPresenceUsingQRCode'])->name('sendEnterPresenceUsingQRCode');
    });
    
    Route::middleware('role:superadmin')->group(function (){
        // akun admin
        Route::get('/dashboard/admin/akun-admin', [StudentController::class, 'adminindex'])->name('admin.index');
        Route::get('/dashboard/admin/akun-admin/tambah-data', [StudentController::class, 'admincreate'])->name('admin.create');
        Route::get('/dashboard/admin/akun-admin/edit', [StudentController::class, 'adminedit'])->name('admin.edit');
        Route::delete('/dashboard/admin/akun-admin/{users}', [StudentController::class, 'admindestroy'])->name('admin.destroy');
        // presensi (kehadiran)
        Route::delete('/dashboard/admin/presensi/{presence}', [PresenceController::class, 'destroy'])->name('presence.destroy');
        // attendances (user/presensi)
        Route::get('/dashboard/admin/kehadiran', [AttendanceController::class, 'index'])->name('attendances.index');
        Route::get('/dashboard/admin/kehadiran/tambah-data', [AttendanceController::class, 'create'])->name('attendances.create');
        Route::get('/dashboard/admin/kehadiran/edit', [AttendanceController::class, 'edit'])->name('attendances.edit');
        Route::delete('/dashboard/admin/kehadiran/{attendance}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
        // not present data
        Route::get('/dashboard/admin/presensi/{attendance}/tidak-presensi', [PresenceController::class, 'notPresent'])->name('presences.not-present');
        Route::post('/dashboard/admin/presensi/{attendance}/tidak-presensi', [PresenceController::class, 'notPresent']);
        // present (url untuk menambahkan/mengubah user yang tidak hadir menjadi hadir)
        Route::post('/dashboard/admin/presensi/{attendance}/hadir', [PresenceController::class, 'presentUser'])->name('presences.present');
        Route::post('/dashboard/admin/presensi/{attendance}/beriIzin', [PresenceController::class, 'acceptPermissionByAdmin'])->name('presences.acceptPermissionByAdmin');
        // students permissions
        Route::get('/dashboard/presensi/{attendance}/izin', [PresenceController::class, 'permissions'])->name('presences.permissions');
        // positionss
        Route::get('/dashboard/admin/posisi', [PositionController::class, 'index'])->name('positions.index');
        Route::get('/dashboard/admin/posisi/tambah-data', [PositionController::class, 'create'])->name('positions.create');
        Route::get('/dashboard/admin/posisi/edit', [PositionController::class, 'edit'])->name('positions.edit');
        Route::delete('/dashboard/admin/posisi/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');
        //kelompok
        Route::get('/dashboard/admin/kelompok', [KelompokController::class, 'index'])->name('kelompok.index');
        Route::get('/dashboard/admin/kelompok/tambah-data', [KelompokController::class, 'create'])->name('kelompok.create');
        Route::get('/dashboard/admin/kelompok/edit', [KelompokController::class, 'edit'])->name('kelompok.edit');
        Route::delete('/dashboard/admin/kelompok/{kelompok}', [KelompokController::class, 'destroy'])->name('kelompok.destroy');
        // akun peserta
        Route::get('/dashboard/admin/peserta', [StudentController::class, 'index'])->name('students.index');
        Route::get('/dashboard/admin/peserta/tambah-data', [StudentController::class, 'create'])->name('students.create');
        Route::get('/dashboard/admin/peserta/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::delete('/dashboard/admin/peserta/{users}', [StudentController::class, 'destroy'])->name('students.destroy');
        //hasil
        Route::resource('/dashboard/admin/hasil', HasilController::class);
        Route::post('/dashboard/admin/hasil/export-excel', [HasilController::class, 'exportExcel'])->name('hasil.export-excel');
    });
    
    //PRESENCES USER (USER, ADMIN, SUPERADMIN)
    Route::middleware('role:user,admin,superadmin')->name('home-presences.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'indexuserdashboard'])->name('indexuserdashboard');
        
        Route::get('/dashboard/user/presensi', [HomePresenceController::class, 'index'])->name('index');
        // destination after scan qrcode
        Route::get('/dashboard/user/presensi/scan/qrcode', [PresenceController::class, 'showQrcode'])->name('presences.qrcode');
        Route::get('/dashboard/user/presensi/qrcode', [PresenceController::class, 'generateQrCode'])->name('presences.generateQrCode');
        
        Route::get('/dashboard/user/presensi/{attendance}', [HomePresenceController::class, 'show'])->name('show');
    });
    
    
    //DASHBOARD USER (USER,ADMIN, SUPERADMIN)
    Route::middleware('role:user,admin,superadmin')->name('dashboard-user.')->group(function () {
        //tugas
        Route::get('/dashboard/user/tugas', [TaskController::class, 'taskindex'])->name('taskindex');
        Route::get('/dashboard/user/tugas/edit-text/{id}', [TaskController::class, 'taskedit'])->name('taskedit');
        Route::get('/dashboard/user/tugas/edit-file/{id}', [TaskController::class, 'fileedit'])->name('fileedit');
        Route::get('/dashboard/user/tugas/{tambahtugas}', [TaskController::class, 'taskshow'])->name('taskshow');
        Route::get('/dashboard/user/tugas/download/{folder}/{filename}', [FileController::class, 'download'])->name('download');
        Route::post('/dashboard/user/tugas/file/{tambahtugas}', [TaskController::class, 'uploadFile'])->name('uploadFile');
        Route::post('/dashboard/user/tugas/{tambahtugas}/unggah', [TaskController::class, 'sendTask'])->name('sendTask');
        Route::post('/dashboard/user/tugas/edit-text/{tambahtugas}', [TaskController::class, 'updateTask'])->name('updateTask');
        Route::post('/dashboard/user/tugas/edit-file/{tambahtugas}', [TaskController::class, 'updateFile'])->name('updateFile');
        //profile
        Route::get('/dashboard/user/profil', [ProfileController::class, 'profileindex'])->name('profileindex');
        //Route::get('/dashboard/user/profil/edit', [ProfileController::class, 'profileedit'])->name('profileedit');
        Route::patch('/dashboard/user/profil/edit/{user}', [ProfileController::class, 'profileupdate'])->name('profileupdate');
    });
    
    Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
/* Guest */
//landing view
Route::get('/', [LandingController::class, 'viewindex'])->name('index-landing');
Route::get('/informasi/pengumuman', [LandingController::class, 'viewannounce'])->name('pengumuman-landing');
Route::get('/informasi/kegiatan/panitia', [LandingController::class, 'viewpanitia'])->name('informasi-panitia');
Route::get('/informasi/kegiatan', [LandingController::class, 'viewinformation'])->name('informasi-kegiatan');
Route::get('/informasi/berita/detail/{id}', [LandingController::class, 'detailviewnews'])->name('detail-informasi-berita');
Route::get('/informasi/berita', [LandingController::class, 'viewnews'])->name('informasi-berita');
    Route::get('/informasi', [LandingController::class, 'information'])->name('informasi-landing');
    Route::get('/panitia', [LandingController::class, 'viewcommittee'])->name('panitia-landing');
    
    // auth
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate']);


    Route::get('/dashboard/admin/presensi/check-data-peserta/qrcode', [PresenceController::class, 'checkDataQrCode'])->name('checkDataQrCode');