<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelulusan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DataKelulusanController extends Controller
{
    public function index(){
        $data = Kelulusan::get()->first();
        
        if($data){
            return response()->json([
                'status' => true,
                'result' => $data,
                'message' => 'Data Kelulusan Berhasil Ditampilkan!',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'result' => null,
                'message' => 'Data Kelulusan Kosong!',
            ], 204);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'url_kelulusan' => 'required'
        ], ['url_kelulusan.required' => 'Url Kelulusan wajib diisi.']);

        if($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $existingData = Kelulusan::get()->first()->exists();

            if (!$existingData) {
                $tambahData = Kelulusan::create($request->only('url_kelulusan'));
                
                if($tambahData){
                    return response()->json([
                        'status' => true,
                        'data_input' => $tambahData,
                        'message' => 'Data Kelulusan Berhasil Disimpan!',
                    ], 200);
                }
            } else if($existingData) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Kelulusan Gagal Disimpan!',
                    'reason' => 'Data URL sudah ada, silahkan update'
                ], 401);
            }
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'url_kelulusan' => 'required'
        ], ['url_kelulusan.required' => 'Url Kelulusan wajib diisi.']);

        if($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $data = Kelulusan::get()->first();
            

            if ($data) {
                $updateData = $data->update([
                                'url_kelulusan' => $request->input('url_kelulusan'),
                              ]);
                
                if($updateData){
                    return response()->json([
                        'status' => true,
                        'data_input' => $updateData,
                        'message' => 'Data Kelulusan Berhasil Diupdate!',
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Kelulusan Gagal Diupdate!',
                ], 401);
            }
        }
    }
}
