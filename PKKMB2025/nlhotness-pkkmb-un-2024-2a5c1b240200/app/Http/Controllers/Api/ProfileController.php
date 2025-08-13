<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profileindex() {
        return view('dashboard.user.profile.index', [
            "title" => "Profile Peserta"
        ]);
    }

    public function profileedit(Request $request)
    {
        return view('dashboard.user.profile.edit', [
            "title" => "Edit Data Peserta",
            "user" => $request->user()
        ]);
    }

    public function profileupdate(User $user, Request $request)
    {   

        $request->validate([
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'jalur_penerimaan' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
        ]);

        $user->detailuser()->update([
            'nama_lengkap' => $request->input('nama_lengkap'),
            'no_hp' => $request->input('no_hp'),
            'email' => $request->input('email'),
            'jalur_penerimaan' => $request->input('jalur_penerimaan'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'agama' => $request->input('agama'),
            'alamat' => $request->input('alamat'),
        ]);

        return redirect()->route('dashboard-user.profileindex')->with('success', 'Profil berhasil diupdate');
    }

}
