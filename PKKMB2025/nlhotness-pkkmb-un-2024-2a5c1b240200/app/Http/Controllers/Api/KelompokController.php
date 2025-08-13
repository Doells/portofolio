<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class KelompokController extends Controller
{
    public function index()
    {
        $dataKelompok = Kelompok::get()->all();
        return response([
            'success' => true,
            'message' => 'List Data Kelompok',
            'data' => $dataKelompok
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ], ['name.required' => 'Nama Kelompok wajib diisi.']);

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $tambahKelompok = Kelompok::create($validator);

            if ($tambahKelompok) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kelompok Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Kelompok Gagal Disimpan!',
                ], 401);
            }
        }
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ], ['name.required' => 'Nama Kelompok wajib diisi.']);

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $updateKelompok = Kelompok::whereId($request->input('id'))->update([
                'name' => $request->input('name'),
            ]);

            if ($updateKelompok) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kelompok Berhasil Di Update!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Kelompok Gagal Di Update!',
                ], 401);
            }
        }

    }

    public function destroy($id)
    {
        $dataKelompok = Kelompok::findOrFail($id);
        $dataKelompok->delete();

        if ($dataKelompok) {
            return response()->json([
                'success' => true,
                'message' => 'Kelompok Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kelompok Gagal Dihapus!',
            ], 400);
        }

    }
}
