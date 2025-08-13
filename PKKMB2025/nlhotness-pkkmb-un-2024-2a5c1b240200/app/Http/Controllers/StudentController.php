<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function adminindex()
    {
        return view('dashboard.admin.account.admin.index', [
            "title" => "Akun Administrator"
        ]);
    }

    public function admincreate()
    {
        return view('dashboard.admin.account.admin.create', [
            "title" => "Tambah Data admin"
        ]);
    }

    public function adminedit()
    {
        $ids = request('ids');
        if (!$ids)
            return redirect()->back();
        $ids = explode('-', $ids);

        // ambil data user yang hanya memiliki User::USER_ROLE_ID / role untuk admin
        $students = User::query()
            ->whereIn('id', $ids)
            ->get();

        return view('dashboard.admin.account.admin.edit', [
            "title" => "Edit Data Admin",
            "students" => $students
        ]);
    }

    public function admindestroy(User $users)
    {
        try {
            $users->delete();
            return back()->with('success', 'Data admin berhasil dihapus.');
        } catch (\Exception $ex) {
            return back()->with('error', 'Gagal menghapus data admin.');
        }
    }

    public function index()
    {
        return view('dashboard.admin.students.index', [
            "title" => "Akun Peserta"
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.students.create', [
            "title" => "Tambah Data Peserta"
        ]);
    }

    public function edit()
    {
        $ids = request('ids');
        if (!$ids)
            return redirect()->back();
        $ids = explode('-', $ids);

        // ambil data user yang hanya memiliki User::USER_ROLE_ID / role untuk peserta
        $students = User::query()
            ->whereIn('id', $ids)
            ->get();

        return view('dashboard.admin.students.edit', [
            "title" => "Edit Data Peserta",
            "students" => $students
        ]);
    }

    public function destroy(User $users)
    {
        try {
            //Hapus data dari tabel DetailUser terlebih dahulu
            $users->detailuser()->delete();

            // Lalu hapus data dari tabel user
            $users->delete();
            
            return back()->with('success', 'Data peserta berhasil dihapus.');
        } catch (\Exception $ex) {
            return back()->with('error', 'Gagal menghapus data peserta.');
        }
    }
}
