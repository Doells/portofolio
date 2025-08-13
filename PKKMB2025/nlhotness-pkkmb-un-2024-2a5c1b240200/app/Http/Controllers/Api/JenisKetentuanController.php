<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Dashboard\JenisKetentuan\StoreJenisKetentuanRequest;
use App\Http\Requests\Dashboard\JenisKetentuan\UpdateJenisKetentuanRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Pelanggaran;
use App\Models\Ketentuan;
use App\Models\JenisKetentuan;

class JenisKetentuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisketentuann = JenisKetentuan::orderBy('created_at', 'desc')->get();
        return response([
            'success' => true,
            'message' => 'List Data Jenis Ketentuan',
            'data' => $jenisketentuann
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.jenisketentuan.create', ["title" => "Tambah Jenis Ketentuan"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ], [
            'title.required' => 'Kolom judul harus diisi.',
            'title.string' => 'Kolom judul harus berupa string.',
            'title.max' => 'Kolom judul tidak boleh lebih dari 255 karakter.',
        ]);

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $tambahJenisKetentuan = JenisKetentuan::create($validator);

            if ($tambahJenisKetentuan) {
                return response()->json([
                    'success' => true,
                    'message' => 'Jenis Ketentuan Berhasil Di Tambahkan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Jenis Ketentuan Berhasil Di Tambahkan!',
                ], 401);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisKetentuan $jenisketentuan)
    {
        return view('dashboard.admin.jenisketentuan.edit', compact('jenisketentuan'), ["title" => "Edit Jenis Ketentuan"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ], [
            'title.required' => 'Kolom judul harus diisi.',
            'title.string' => 'Kolom judul harus berupa string.',
            'title.max' => 'Kolom judul tidak boleh lebih dari 255 karakter.',
        ]);

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $updateTitle = JenisKetentuan::whereId($request->input('id'))->update([
                'title' => $request->input('title'),
            ]);

            if ($updateTitle) {
                return response()->json([
                    'success' => true,
                    'message' => 'Jenis ketentuan Berhasil Di Update!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Jenis Ketentuan Gagal Di Update!',
                ], 401);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jenisketentuan = JenisKetentuan::findOrFail($id);
        $jenisketentuan->delete();

        if ($jenisketentuan) {
            return response()->json([
                'success' => true,
                'message' => 'Jenis Ketentuan Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Jenis Ketentuan Gagal Dihapus!',
            ], 400);
        }
    }
}
