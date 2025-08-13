<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Dashboard\Ketentuan\StoreKetentuanRequest;
use App\Http\Requests\Dashboard\Ketentuan\UpdateKetentuanRequest;

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

class KetentuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ketentuann = Ketentuan::orderBy('created_at', 'desc')->get();
        
        return response([
            'success' => true,
            'message' => 'List Data Jenis Ketentuan',
            'data' => $ketentuann
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ketentuann = Ketentuan::orderBy('created_at', 'desc')->get();
        $jenisketentuann = JenisKetentuan::orderBy('title', 'asc')->get();

        return view('dashboard.admin.ketentuan.create', compact('ketentuann', 'jenisketentuann'), ["title" => "Tambah Ketentuan"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'poin' => 'required',
            'id_jenis_ketentuan' => 'required',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ], [
            'title.required' => 'Kolom judul harus diisi.',
            'poin.required' => 'Kolom poin harus diisi.',
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

            $tambahKetentuan = Ketentuan::create($validator);

            if ($tambahKetentuan) {
                return response()->json([
                    'success' => true,
                    'message' => 'Ketentuan Berhasil Di Tambahkan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Ketentuan Berhasil Di Tambahkan!',
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
    public function edit(Ketentuan $ketentuan)
    {
        $jenisketentuann = JenisKetentuan::orderBy('title', 'asc')->get();
        
        return view('dashboard.admin.ketentuan.edit', compact('ketentuan', 'jenisketentuann'), ["title" => "Edit Ketentuan"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKetentuanRequest $request, Ketentuan $ketentuan)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'poin' => 'required',
            'id_jenis_ketentuan' => 'required',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ], [
            'title.required' => 'Kolom judul harus diisi.',
            'poin.required' => 'Kolom poin harus diisi.',
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

            $tambahKetentuan = Ketentuan::whereId($request->input('id'))->update([
                'title' => $request->input('title'),
                'id_jenis_ketentuan' => $request->input('id_jenis_ketentuan'),
                'poin' => $request->input('poin'),
            ]);

            if ($tambahKetentuan) {
                return response()->json([
                    'success' => true,
                    'message' => 'Ketentuan Berhasil Di Update!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Ketentuan Berhasil Di Update!',
                ], 401);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ketentuan = Ketentuan::findOrFail($id);
        $ketentuan->delete();

        if ($ketentuan) {
            return response()->json([
                'success' => true,
                'message' => 'Ketentuan Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ketentuan Gagal Dihapus!',
            ], 400);
        }
    }
}
