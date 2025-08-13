<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\HomePresenceController;
use App\Http\Controllers\Api\JenisKetentuanController;
use App\Http\Controllers\Api\KelompokController;
use App\Http\Controllers\Api\KetentuanController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PelanggaranController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\PresenceController;
use App\Http\Controllers\Api\ResultTaskController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TambahTugasController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\DataKelulusanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');

/* Detail Peserta */
Route::get('/dashboard/detail-user', [StudentController::class, 'detailUser'])->name('detail-user');

/* Admin */
//Data Akun Peserta
Route::get('/dashboard/admin/peserta', [StudentController::class, 'index'])->name('students.index');
Route::post('/dashboard/admin/peserta/tambah-data', [StudentController::class, 'create'])->name('students.create');
Route::post('/dashboard/admin/peserta/edit', [StudentController::class, 'update'])->name('students.update');
Route::delete('/dashboard/admin/peserta/{users}', [StudentController::class, 'destroy'])->name('students.destroy');

//Data Akun Admin
Route::get('/dashboard/admin/akun-admin', [StudentController::class, 'indexAdmin'])->name('admin.index');
Route::post('/dashboard/admin/akun-admin/tambah-data', [StudentController::class, 'create'])->name('admin.create');
Route::post('/dashboard/admin/akun-admin/edit', [StudentController::class, 'update'])->name('admin.update');
Route::delete('/dashboard/admin/akun-admin/{users}', [StudentController::class, 'destroy'])->name('admin.destroy');

// Tambah Tugas
Route::get('/dashboard/admin/tugas', [TambahTugasController::class, 'index'])->name('tambahtugas.index');
Route::post('/dashboard/admin/tugas/tambah-data', [TambahTugasController::class, 'create'])->name('tambahtugas.create');
Route::post('/dashboard/admin/tugas/edit', [TambahTugasController::class, 'edit'])->name('tambahtugas.edit');
Route::delete('/dashboard/admin/tugas/delete/{tambahtugas}', [TambahTugasController::class, 'destroy'])->name('tambahtugas.destroy');

// Data Pengumpulan Tugas
Route::get('/dashboard/admin/tugas/pengumpulan', [ResultTaskController::class, 'index'])->name('result-task.index');
Route::get('/dashboard/admin/tugas/pengumpulan/detail-tugas/{tambahtugas}', [ResultTaskController::class, 'show'])->name('result-task.show');
Route::get('/dashboard/admin/tugas/pengumpulan/hasil/{id_task}', [ResultTaskController::class, 'showResultTaskUser'])->name('result-task.showResultTaskUser');
Route::get('/dashboard/admin/tugas/pengumpulan/tidak-mengumpulkan/{id_tambahtugas}', [ResultTaskController::class, 'notSubmit'])->name('result-task.notSubmit');
Route::post('/dashboard/admin/tugas/pengumpulan/status', [ResultTaskController::class, 'updateStatus'])->name('result-task.updateStatus');
Route::delete('/dashboard/admin/tugas/pengumpulan/delete/{id_task}', [ResultTaskController::class, 'destroy'])->name('result-task.destroy');

//Data kelompok
Route::get('/dashboard/admin/kelompok', [KelompokController::class, 'index'])->name('kelompok.index');
Route::post('/dashboard/admin/kelompok/tambah-data', [KelompokController::class, 'create'])->name('kelompok.create');
Route::post('/dashboard/admin/kelompok/edit', [KelompokController::class, 'edit'])->name('kelompok.edit');
Route::delete('/dashboard/admin/kelompok/{id_kelompok}', [KelompokController::class, 'destroy'])->name('kelompok.destroy');

// positions
Route::get('/dashboard/admin/posisi', [PositionController::class, 'index'])->name('positions.index');
Route::post('/dashboard/admin/posisi/tambah-data', [PositionController::class, 'create'])->name('positions.create');
Route::post('/dashboard/admin/posisi/edit', [PositionController::class, 'edit'])->name('positions.edit');
Route::delete('/dashboard/admin/posisi/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');

//Berita
Route::get('/dashboard/admin/news', [NewsController::class, 'index'])->name('news.index');
Route::post('/dashboard/admin/news/store', [NewsController::class, 'store'])->name('news.store');
Route::get('/dashboard/admin/news/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::post('/dashboard/admin/news/update', [NewsController::class, 'update'])->name('news.update');
Route::get('/dashboard/admin/delete/{id_berita}', [NewsController::class, 'destroy'])->name('news.destroy');

//Jenis Ketentuan
Route::get('/dashboard/admin/jenis-ketentuan', [JenisKetentuanController::class, 'index'])->name('news.index');
Route::post('/dashboard/admin/jenis-ketentuan/store', [JenisKetentuanController::class, 'store'])->name('news.store');
Route::post('/dashboard/admin/jenis-ketentuan/update', [JenisKetentuanController::class, 'update'])->name('news.update');
Route::delete('/dashboard/admin/jenis-ketentuan/delete/{id_jenis_ketentuan}', [JenisKetentuanController::class, 'update'])->name('news.update');

//Ketentuan
Route::get('/dashboard/admin/ketentuan', [KetentuanController::class, 'index'])->name('ketentuan.index');
Route::post('/dashboard/admin/ketentuan/store', [KetentuanController::class, 'store'])->name('ketentuan.store');
Route::post('/dashboard/admin/ketentuan/update', [KetentuanController::class, 'update'])->name('ketentuan.update');
Route::delete('/dashboard/admin/ketentuan/delete/{id_ketentuan}', [KetentuanController::class, 'update'])->name('ketentuan.update');

//Pelanggaran
Route::get('/dashboard/admin/pelanggaran', [PelanggaranController::class, 'index'])->name('pelanggaran.index');
Route::post('/dashboard/admin/pelanggaran/store', [PelanggaranController::class, 'store'])->name('pelanggaran.store');
Route::post('/dashboard/admin/pelanggaran/update', [PelanggaranController::class, 'update'])->name('pelanggaran.update');
Route::delete('/dashboard/admin/pelanggaran/delete/{id_pelanggaran}', [PelanggaranController::class, 'update'])->name('pelanggaran.update');

//Presensi
Route::get('/dashboard/admin/presensi', [PresenceController::class, 'index'])->name('presences.index');
Route::get('/dashboard/admin/presensi/qrcode', [PresenceController::class, 'showQrcode'])->name('presences.qrcode');
Route::get('/dashboard/admin/presensi/{id}', [PresenceController::class, 'show'])->name('presences.show');
Route::delete('/dashboard/admin/presensi/{presence}', [PresenceController::class, 'destroy'])->name('presence.destroy');

//Data Kehadiran
Route::get('/dashboard/admin/kehadiran', [AttendanceController::class, 'index'])->name('attendances.index');

//Data Kelulusan
Route::get('/dashboard/admin/data-kelulusan/index', [DataKelulusanController::class, 'index'])->name('data-kelulusan.index');
Route::post('/dashboard/admin/data-kelulusan/store', [DataKelulusanController::class, 'store'])->name('data-kelulusan.store');
Route::post('/dashboard/admin/data-kelulusan/update', [DataKelulusanController::class, 'update'])->name('data-kelulusan.update');
/* Admin */

/* User */
Route::get('/dashboard/user/presensi', [HomePresenceController::class, 'index'])->name('index');
// destination after scan qrcode oke
Route::post('/dashboard/admin/presensi/qrcode/kirim-presensi', [HomePresenceController::class, 'sendEnterPresenceUsingQRCode'])->name('sendEnterPresenceUsingQRCode');
Route::get('/dashboard/user/presensi/{attendance}', [HomePresenceController::class, 'show'])->name('show');

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
/* User */
