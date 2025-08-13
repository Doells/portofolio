<?php

namespace App\Http\Livewire;

use App\Models\File;
use App\Models\TambahTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads; // Tambahkan ini

class TambahTugasCreateForm extends Component
{   
    use WithFileUploads; // Tambahkan ini
    public $tambahtugas;

    public function save(Request $request)
    {
        // Validasi input
        $this->validate([
            'tambahtugas.title' => 'required|string|min:6',
            'tambahtugas.description' => 'required|string|max:500',
            'tambahtugas.start_date' => 'required',
            'tambahtugas.end_date' => 'required',
            'tambahtugas.start_time' => 'required|date_format:H:i',
            'tambahtugas.batas_start_time' => 'required|date_format:H:i|after:start_time',
            'tambahtugas.input_type' => 'required',
            'tambahtugas.lampiran' => 'mimes:jpg,jpeg,png,pdf,doc,docx|max:10240'
            // Dan tambahkan validasi untuk kolom-kolom lainnya sesuai kebutuhan Anda
        ]);

        // Cek apakah file telah diupload
        if (isset($this->tambahtugas['lampiran'])) {
            $uploadedFile = $this->tambahtugas['lampiran'];

            // Dapatkan nama asli file
            $originalName = $uploadedFile->getClientOriginalName();

            // Simpan file menggunakan nama asli ke folder 'upload'
            $filePath = $uploadedFile->storeAs('upload', $originalName, 'public');

            // Simpan path ke database
            $this->tambahtugas['lampiran'] = $filePath;
        }

        // Simpan data ke database
        $tambahtugas = TambahTugas::create($this->tambahtugas);

        // Simpan informasi file baru ke database
        if (isset($this->tambahtugas['lampiran'])) {
            $file = new File();
            $file->tambahtugas_id = $tambahtugas->id;
            $file->file_name = $uploadedFile->getClientOriginalName();
            $file->file_path = $filePath;
            $file->file_extension = $uploadedFile->getClientOriginalExtension();
            $file->save();
        }

        // Redirect atau lakukan tindakan lain setelah penyimpanan berhasil
        return redirect()->route('tambahtugas.index')->with('success', "Tugas berhasil ditambahkan.");
    }

    public function render()
    {
        return view('livewire.tambahtugas-create-form');
    }
}
