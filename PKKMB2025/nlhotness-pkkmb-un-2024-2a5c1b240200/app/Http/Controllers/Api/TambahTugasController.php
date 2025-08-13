<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TambahTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TambahTugasController extends Controller
{
    public function index()
    {
        $tugasPeserta = TambahTugas::get()->all();
        return response([
            'success' => true,
            'message' => 'List Semua Tugas',
            'data' => $tugasPeserta
        ], 200);
    }

    public function create(Request $request)
    {
        // Validate data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:6',
            'description' => 'required|string|max:500',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|date_format:H:i',
            'batas_start_time' => 'required|date_format:H:i|after:start_time',
            'input_type' => 'required',
            // Tambahkan validasi untuk kolom-kolom lainnya sesuai kebutuhan Anda
        ], [
            'title.required' => 'Judul harus diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.min' => 'Judul minimal harus terdiri dari 6 karakter.',
            'description.required' => 'Deskripsi harus diisi.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'description.max' => 'Deskripsi maksimal terdiri dari 500 karakter.',
            'start_date.required' => 'Tanggal mulai harus diisi.',
            'start_date.date' => 'Tanggal mulai harus berupa format tanggal yang valid.',
            'end_date.required' => 'Tanggal berakhir harus diisi.',
            'end_date.date' => 'Tanggal berakhir harus berupa format tanggal yang valid.',
            'end_date.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai.',
            'start_time.required' => 'Waktu mulai harus diisi.',
            'start_time.date_format' => 'Waktu mulai harus dalam format jam yang benar (HH:MM).',
            'batas_start_time.required' => 'Batas waktu mulai harus diisi.',
            'batas_start_time.date_format' => 'Batas waktu mulai harus dalam format jam yang benar (HH:MM).',
            'batas_start_time.after' => 'Batas waktu mulai harus setelah waktu mulai.',
            'input_type.required' => 'Jenis input harus diisi.',
        ]);

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $tambahTugas = TambahTugas::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'start_time' => $request->input('start_time'),
                'batas_start_time' => $request->input('batas_start_time'),
                'input_type' => $request->input('input_type'),
            ]);

            if ($tambahTugas) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Tugas Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Tugas Gagal Disimpan!',
                ], 401);
            }
        }
    }

    public function edit(Request $request)
    {
        // Validate data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:6',
            'description' => 'required|string|max:500',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|date_format:H:i',
            'batas_start_time' => 'required|date_format:H:i|after:start_time',
            'input_type' => 'required',
            // Tambahkan validasi untuk kolom-kolom lainnya sesuai kebutuhan Anda
        ], [
            'title.required' => 'Judul harus diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.min' => 'Judul minimal harus terdiri dari 6 karakter.',
            'description.required' => 'Deskripsi harus diisi.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'description.max' => 'Deskripsi maksimal terdiri dari 500 karakter.',
            'start_date.required' => 'Tanggal mulai harus diisi.',
            'start_date.date' => 'Tanggal mulai harus berupa format tanggal yang valid.',
            'end_date.required' => 'Tanggal berakhir harus diisi.',
            'end_date.date' => 'Tanggal berakhir harus berupa format tanggal yang valid.',
            'end_date.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai.',
            'start_time.required' => 'Waktu mulai harus diisi.',
            'start_time.date_format' => 'Waktu mulai harus dalam format jam yang benar (HH:MM).',
            'batas_start_time.required' => 'Batas waktu mulai harus diisi.',
            'batas_start_time.date_format' => 'Batas waktu mulai harus dalam format jam yang benar (HH:MM).',
            'batas_start_time.after' => 'Batas waktu mulai harus setelah waktu mulai.',
            'input_type.required' => 'Jenis input harus diisi.',
        ]);

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $tambahTugas = TambahTugas::whereId($request->input('id'))->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'start_time' => $request->input('start_time'),
                'batas_start_time' => $request->input('batas_start_time'),
                'input_type' => $request->input('input_type'),
            ]);

            if ($tambahTugas) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Tugas Berhasil Di Update!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Tugas Gagal Di Update!',
                ], 401);
            }
        }
    }
    
    public function destroy($id)
    {
        $tambahtugas = TambahTugas::findOrFail($id);
        $tambahtugas->delete();

        if ($tambahtugas) {
            return response()->json([
                'success' => true,
                'message' => 'Data Tugas Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Tugas Gagal Dihapus!',
            ], 400);
        }

    }
}
