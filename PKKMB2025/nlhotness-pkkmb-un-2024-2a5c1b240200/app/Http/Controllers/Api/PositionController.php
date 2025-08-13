<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $dataPosisi = Position::get()->all();
        return response([
            'success' => true,
            'message' => 'List Data Posisi',
            'data' => $dataPosisi
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ], ['name.required' => 'Setidaknya input posisi pertama wajib diisi.']);

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $tambahPosisi = Position::create($validator);

            if ($tambahPosisi) {
                return response()->json([
                    'success' => true,
                    'message' => 'Posisi Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Posisi Gagal Disimpan!',
                ], 401);
            }
        }
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ], ['name.required' => 'Setidaknya input posisi pertama wajib diisi.']);

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $updatePosisi = Position::whereId($request->input('id'))->update([
                'name' => $request->input('name'),
            ]);

            if ($updatePosisi) {
                return response()->json([
                    'success' => true,
                    'message' => 'Posisi Berhasil Di Update!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Posisi Gagal Di Update!',
                ], 401);
            }
        }

    }

    public function destroy($id)
    {
        $dataPosisi = Position::findOrFail($id);
        $dataPosisi->delete();

        if ($dataPosisi) {
            return response()->json([
                'success' => true,
                'message' => 'Posisi Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Posisi Gagal Dihapus!',
            ], 400);
        }

    }
}
