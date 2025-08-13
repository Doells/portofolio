<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Dashboard\Pelanggaran\StorePelanggaranRequest;
use App\Http\Requests\Dashboard\Pelanggaran\UpdatePelanggaranRequest;

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

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peserta = User::where('position_id', '1')->orderBy('kelompok_id', 'asc')->orderBy('name', 'asc')->get();
        $pelanggaran = Pelanggaran::whereIn('peserta_id', $peserta->pluck('id'))->get();
        
        //dd($pelanggaran);
        return response([
            'success' => true,
            'message' => 'List Data Pelanggaran',
            'dataPeserta' => $peserta,
            'dataPelanggaran' => $pelanggaran,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'poin' => 'required',
        'peserta_id' => 'required',
        'panitia_id' => 'required',
        'ketentuan_id' => 'required',
        // Tambahkan aturan validasi lainnya sesuai kebutuhan
    ], [
        'title.required' => 'Kolom judul harus diisi.',
        'title.string' => 'Kolom judul harus berupa string.',
        'title.max' => 'Kolom judul tidak boleh lebih dari 255 karakter.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Silahkan Isi Bidang Yang Kosong',
            'data' => $validator->errors()
        ], 401);
    } else {
        // Ambil data yang telah divalidasi
        $validatedData = $validator->validated();

        $tambahPelanggaran = Pelanggaran::create($validatedData);

        if ($tambahPelanggaran) {
            return response()->json([
                'success' => true,
                'message' => 'Data Pelanggaran Berhasil Di Tambahkan!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Pelanggaran Gagal Di Tambahkan!',
            ], 401);
        }
    }
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'poin' => 'required',
            'peserta_id' => 'required',
            'panitia_id' => 'required',
            'ketentuan_id' => 'required',
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

            $tambahPelanggaran = Pelanggaran::whereId($request->input('id'))->update([
                'title' => $request->input('title'),
                'poin' => $request->input('poin'),
                'peserta_id' => $request->input('peserta_id'),
                'panitia_id' => $request->input('panitia_id'),
                'ketentuan_id' => $request->input('ketentuan_id'),
            ]);

            if ($tambahPelanggaran) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Pelanggaran Berhasil Di Tambahkan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data pelanggaran Berhasil Di Tambahkan!',
                ], 401);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        $pelanggaran->delete();

        if ($pelanggaran) {
            return response()->json([
                'success' => true,
                'message' => 'Pelanggaran Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pelanggaran Gagal Dihapus!',
            ], 400);
        }
    }

    // Custom
    // public function detail_pelanggaran($id)
    public function detail_pelanggaran($id)
    {
        // $peserta = User::where('position_id', '1')->orderBy('kelompok_id', 'asc')->get();
        // $pelanggaran = Pelanggaran::where('id', $id)->first();
        $pelanggarann = Pelanggaran::where('peserta_id', $id)->orderBy('created_at', 'desc')->get();

        if ($pelanggarann) {
            return response()->json([
                'success' => true,
                'message' => 'Pelanggaran Berhasil Ditampilkan!'.$pelanggarann,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pelanggaran Gagal Ditampilkan!',
            ], 400);
        }
    }
}
