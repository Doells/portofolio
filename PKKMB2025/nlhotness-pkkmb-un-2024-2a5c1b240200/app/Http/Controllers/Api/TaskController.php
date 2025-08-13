<?php

namespace App\Http\Controllers\Api;

use App\Models\File;
use App\Models\TambahTugas;
use App\Models\Task;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function taskindex(Request $request)
    {
        // Mengambil semua data tugas tambahan
        $dataTugas = TambahTugas::all();

        $dataHasil = Task::where('user_id', $request->input('user_id'))
            ->with(['tambahtugas', 'files']) // Mengambil relasi 'tambahtugas' dan 'files'
            ->get(); // Mengambil hasil query
    
        // Mengembalikan respons dalam format JSON
        return response()->json([
            "success" => true,
            "title" => "Tugas Peserta",
            "Data Tugas" => $dataTugas,
            "Data Hasil" => $dataHasil,
        ], 200);
    }
    


    public function taskedit($id)
    {
        // Mencari data tugas berdasarkan ID atau gagal dengan not found
        $task = Task::findOrFail($id);
    
        // Mencari data tugas tambahan berdasarkan ID dari tugas
        $tambahtugas = TambahTugas::findOrFail($task->tambahtugas_id);
    
        // Mengembalikan respons dalam format JSON
        return response()->json([
            "success" => true,
            "title" => "Edit Tugas Peserta",
            "task" => $task,
            "tambahtugas" => $tambahtugas,
        ], 200);
    }
    

    public function fileedit($id)
    {
        $task = Task::findOrFail($id);
        $tambahtugas = TambahTugas::findOrFail($task->tambahtugas_id);
    
        return response()->json([
            "success" => true,
            "title" => "Edit Tugas Peserta",
            "task" => $task,
            "tambahtugas" => $tambahtugas,
        ], 200);
    }
    
    
    public function taskshow(TambahTugas $tambahtugas)
    {
        $tasks = Task::query()
            ->where('tambahtugas_id', $tambahtugas->id)

            ->get();
    
        $isHasSubmitToday = $tasks
            ->where('submit_date', $tambahtugas->date)
            ->isNotEmpty();
    
        $data = [
            'is_has_submit_today' => $isHasSubmitToday,
        ];
    
        $history = Task::query()

            ->where('tambahtugas_id', $tambahtugas->id)
            ->get();
    
        // Untuk melihat peserta yang tidak hadir
        $priodDate = CarbonPeriod::create($tambahtugas->created_at->toDateString(), now()->toDateString())
            ->toArray();
    
        foreach ($priodDate as $i => $date) {
            $priodDate[$i] = $date->toDateString();
        }
    
        $priodDate = array_slice(array_reverse($priodDate), 0, 30);
    
        return response()->json([
            "success" => true,
            "title" => "Informasi tugas",
            "tasks" => $tasks,
            "tambahtugas" => $tambahtugas,
            "data" => $data,
            "history" => $history,
            'priodDate' => $priodDate
        ], 200);
    }
    
    public function sendTask(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'tambahtugas_id' => 'required',
            'text' => 'required|string|max:255',
        ]);

        $tambahtugas_id = $request->input('tambahtugas_id'); // Mengambil ID dari input request
        $user_id = $request->input('user_id');
        // Mencari entri TambahTugas berdasarkan ID
        $tambahtugas = TambahTugas::find($tambahtugas_id);
    
        if ($tambahtugas) {
            $task = Task::create([
                "user_id" => $user_id,
                "tambahtugas_id" => $tambahtugas->id,
                "text" => $request->input('text'),
                "submit_date" => now()->toDateString(),
                "submit_enter_time" => now()->toTimeString(),
                'status' => "Terkirim",
            ]);
    
            return response()->json([
                "success" => true,
                "message" => "Tugas berhasil diunggah.",
                "task" => $task
            ], 201); // Menggunakan status HTTP 201 Created
        } else {
            return response()->json([
                "success" => false,
                "message" => "Tidak dapat menemukan tugas dengan ID yang diberikan."
            ], 404); // Status HTTP 404 Not Found
        }
    }
    

    public function updateTask(Request $request)
    {
        $request->validate([
            'id_tambahtugas' => 'required',
            'text' => 'required|string|max:255',
        ]);
    
        // Cari task berdasarkan tambahtugas_id dan user_id
        $task = Task::where('tambahtugas_id', $request->input('id_tambahtugas'))
                    ->first();
    
        if (!$task) {
            return response()->json([
                "success" => false,
                "message" => "Tidak dapat menemukan tugas yang sesuai."
            ], 404);
        }
    
        // Update task
        $task->update([
            'text' => $request->input('text'),
        ]);
    
        return response()->json([
            "success" => true,
            "message" => "Tugas berhasil diupdate.",
            "task" => $task
        ], 200); // Status HTTP 200 OK
    }
    

    public function uploadFile(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'id_tambahtugas' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:10240', // Validasi file
        ]);
    
        // Simpan file ke sistem penyimpanan
        $uploadedFile = $request->file('file');
        $filePath = $uploadedFile->store('upload', 'public'); // Simpan file dalam folder 'upload'
    
        // Temukan tugas berdasarkan $tambahtugas_id
        $tambahtugas = TambahTugas::find($request->input('id_tambahtugas'));
        $user_id = $request->input('user_id');
    
        if (!$tambahtugas) {
            return response()->json([
                "success" => false,
                "message" => "Tugas tidak ditemukan."
            ], 404);
        }
    
        // Buat tugas (task) baru
        $task = new Task();
        $task->tambahtugas_id = $tambahtugas->id;
        $task->user_id = $user_id;
        $task->text = ''; // Sesuaikan dengan data yang diperlukan
        $task->submit_date = now()->toDateString();
        $task->submit_enter_time = now()->toTimeString();
        $task->status = 'Terkirim';
        $task->save();
    
        // Simpan informasi file ke database
        $file = new File();
        $file->task_id = $task->id; // Menggunakan ID tugas yang baru dibuat
        $file->file_name = $uploadedFile->getClientOriginalName();
        $file->file_path = $filePath;
        $file->file_extension = $uploadedFile->getClientOriginalExtension();
        $file->save();
    
        return response()->json([
            "success" => true,
            "message" => "File berhasil diunggah.",
            "file" => [
                "file_name" => $file->file_name,
                "file_path" => $file->file_path,
                "file_extension" => $file->file_extension,
            ]
        ], 200); // Status HTTP 201 Created
    }
    

    public function updateFile(Request $request, TambahTugas $tambahtugas)
    {
        $request->validate([
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:10240', // Validasi file
            'text' => 'nullable|string', // Validasi teks jika ada
        ]);
    
        // Cari task berdasarkan tambahtugas_id dan user_id
        $task = Task::where('tambahtugas_id', $tambahtugas->id)
        
                    ->first();
    
        if (!$task) {
            return response()->json([
                "success" => false,
                "message" => "Tidak dapat menemukan tugas yang sesuai."
            ], 404);
        }
    
        // Jika pengguna mengunggah file baru, proses penggantian file
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            $oldFile = $task->files->first();
            if ($oldFile) {
                Storage::delete($oldFile->file_path);
                $oldFile->delete();
            }
    
            // Simpan file baru ke sistem penyimpanan
            $uploadedFile = $request->file('file');
            $filePath = $uploadedFile->store('upload', 'public');
    
            // Simpan informasi file baru ke database
            $file = new File();
            $file->task_id = $task->id;
            $file->file_name = $uploadedFile->getClientOriginalName();
            $file->file_path = $filePath;
            $file->file_extension = $uploadedFile->getClientOriginalExtension();
            $file->save();
        }
    
        // Update teks tugas jika ada perubahan
        if ($request->has('text')) {
            $task->text = $request->input('text');
        }
        $task->save();
    
        return response()->json([
            "success" => true,
            "message" => "Tugas berhasil diupdate.",
            "task" => $task,
            "file" => isset($file) ? [
                "file_name" => $file->file_name,
                "file_path" => $file->file_path,
                "file_extension" => $file->file_extension,
            ] : null
        ], 200); // Status HTTP 200 OK
    }

}