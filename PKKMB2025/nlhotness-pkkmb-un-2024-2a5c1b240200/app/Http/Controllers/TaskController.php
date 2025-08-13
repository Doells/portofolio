<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\TambahTugas;
use App\Models\Task;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    public function taskindex() {
        $tambahtugas = TambahTugas::all();
        $tasks = Task::all();

        return view('dashboard.user.task.index', [
            "title" => "Tugas Peserta",
            "tambahtugas" => $tambahtugas,
            "tasks" => $tasks,
        ]);
    }


    public function taskedit($id)
    {
        $task = Task::findOrFail($id);
        $tambahtugas = TambahTugas::findOrFail($task->tambahtugas_id);
    
        return view('dashboard.user.task.edit', [
            "title" => "Edit Tugas Peserta",
            "task" => $task,
            "tambahtugas" => $tambahtugas,
        ]);
    }

    public function fileedit($id)
    {
        $task = Task::findOrFail($id);
        $tambahtugas = TambahTugas::findOrFail($task->tambahtugas_id);
    
        return view('dashboard.user.task.edit', [
            "title" => "Edit Tugas Peserta",
            "task" => $task,
            "tambahtugas" => $tambahtugas,
        ]);
    }
    
    public function taskshow(TambahTugas $tambahtugas)
    {
        $tasks = Task::query()
            ->where('tambahtugas_id', $tambahtugas->id)
            ->where('user_id', auth()->user()->id)
            ->get();

        $isHasSubmitToday = $tasks
            ->where('submit_date', $tambahtugas->date)
            ->isNotEmpty();

        $data = [
            'is_has_submit_today' => $isHasSubmitToday,
        ];

        $history = Task::query()
            ->where('user_id', auth()->user()->id)
            ->where('tambahtugas_id', $tambahtugas->id)
            ->get();

        // untuku melihat peserta yang tidak hadir
        $priodDate = CarbonPeriod::create($tambahtugas->created_at->toDateString(), now()->toDateString())
        ->toArray();

        foreach ($priodDate as $i => $date) { // get only stringdate
            $priodDate[$i] = $date->toDateString();
        }

        $priodDate = array_slice(array_reverse($priodDate), 0, 30);

        return view('dashboard.user.task.show', [
            "title" => "Informasi tugas",
            "task" => $tasks,
            "tambahtugas" => $tambahtugas,
            "data" => $data,
            "history" => $history,
            'priodDate' => $priodDate

        ]);
    }

    public function sendTask(Request $request)
    {       
        $tambahtugas_id = Route::current()->parameter('tambahtugas');

        // Mencari entri TambahTugas berdasarkan ID
        $tambahtugas = TambahTugas::find($tambahtugas_id);

        if ($tambahtugas) {
            Task::create([
                "user_id" => auth()->user()->id,
                "tambahtugas_id" => $tambahtugas->id,
                "text" => $request->input('text'),
                "submit_date" => now()->toDateString(),
                "submit_enter_time" => now()->toTimeString(),
                'status' => "Terkirim",
                /* "presence_out_time" => null */
            ]);

            Alert::success('Berhasil!', 'Tugas berhasil diunggah.');
            return redirect()->route('dashboard-user.taskshow', ['tambahtugas' => $tambahtugas->id])->with('success', 'Tugas berhasil diunggah');
        } else {

            Alert::error('Gagal!', 'Tugas gagal diunggah.');
            return response()->json([
                "success" => false,
                "message" => "Tidak dapat menemukan tugas dengan ID yang diberikan."
            ], 404); // Atau kode status lain sesuai dengan konteks aplikasi Anda
        }
    }

    public function updateTask(Request $request, TambahTugas $tambahtugas)
    {   
        $request->validate([
            'text' => 'required',
        ]);

        // Cari task berdasarkan tambahtugas_id dan user_id
        $task = Task::where('tambahtugas_id', $tambahtugas->id)
                    ->where('user_id', auth()->user()->id)
                    ->first();

        if (!$task) {
            return response()->json([
                "success" => false,
                "message" => "Tidak dapat menemukan tugas yang sesuai."
            ], 404);
        }

        $task->update([
            'text' => $request->input('text'),
        ]);

        Alert::success('Berhasil!', 'Tugas berhasil diupdate.');
        return redirect()->route('dashboard-user.taskshow', ['tambahtugas' => $tambahtugas->id])->with('success', 'Tugas berhasil diupdate');
    }

    public function uploadFile(Request $request, $tambahtugas_id)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:10240', // Sesuaikan dengan jenis file yang diizinkan
        ]);

        // Simpan file ke sistem penyimpanan
        $uploadedFile = $request->file('file');
        $filePath = $uploadedFile->store('upload', 'public'); // Simpan file dalam folder 'uploads'

        // Temukan tugas (soal) yang sesuai berdasarkan $tambahtugas_id
        $tambahtugas = TambahTugas::findOrFail($tambahtugas_id);

        // Buat tugas (task) baru berdasarkan tugas (soal) yang sesuai
        $task = new Task();
        $task->tambahtugas_id = $tambahtugas->id;
        $task->user_id = auth()->user()->id; // Anda mungkin perlu menyesuaikan ini
        $task->text = ''; // Atur ini sesuai dengan apa yang sesuai
        $task->submit_date = now()->toDateString();
        $task->submit_enter_time = now()->toTimeString();
        $task->status = 'Terkirim';
        $task->save();

        // Simpan informasi file ke database
        $file = new File();
        $file->task_id = $task->id; // Menggunakan ID tugas (task) yang baru saja dibuat
        $file->file_name = $uploadedFile->getClientOriginalName();
        $file->file_path = $filePath;
        $file->file_extension = $uploadedFile->getClientOriginalExtension();
        $file->save();

        Alert::success('Berhasil!', 'Tugas berhasil diunggah.');
        return redirect()->back()->with('success', 'File berhasil diunggah');
    }

    public function updateFile(Request $request, TambahTugas $tambahtugas)
    {
        $request->validate([
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:10240', // Sesuaikan dengan jenis file yang diizinkan
        ]);

        // Cari task berdasarkan tambahtugas_id dan user_id
        $task = Task::where('tambahtugas_id', $tambahtugas->id)
                    ->where('user_id', auth()->user()->id)
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
        $task->text = $request->input('text');
        $task->save();

        Alert::success('Berhasil!', 'Tugas berhasil diupdate.');
        // Redirect dengan pesan sukses
        return redirect()->route('dashboard-user.taskshow', ['tambahtugas' => $tambahtugas->id])
            ->with('success', 'Tugas berhasil diupdate');
    }

}