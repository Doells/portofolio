<?php

namespace App\Http\Livewire;

use App\Models\File;
use App\Models\TambahTugas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads; // Tambahkan ini

class TambahTugasEditForm extends Component
{
    use WithFileUploads; // Tambahkan ini
    public $tambahtugas;

    public function mount(TambahTugas $tambahtugas)
    {
        $this->tambahtugas = [
            'id' => $tambahtugas->id,
            'title' => $tambahtugas->title,
            'description' => $tambahtugas->description,
            'start_date' => $tambahtugas->start_date,
            'end_date' => $tambahtugas->end_date,
            'start_time' => $tambahtugas->start_time,
            'batas_start_time' => $tambahtugas->batas_start_time,
            'input_type' => $tambahtugas->input_type,
        ];
    }


    public function save(Request $request)
    {
        // Validasi input
        $this->validate([
            'tambahtugas.title' => 'required',
            'tambahtugas.description' => 'required',
            'tambahtugas.start_date' => 'required',
            'tambahtugas.end_date' => 'required',
            'tambahtugas.start_time' => 'required',
            'tambahtugas.batas_start_time' => 'required',
            'tambahtugas.input_type' => 'required',
            'tambahtugas.lampiran' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240'  // Tidak wajib jika update
        ]);
    
        // Temukan model yang akan diupdate
        $model = TambahTugas::find($this->tambahtugas['id']);
        
        if (!$model) {
            // Tangani kasus jika model tidak ditemukan
            session()->flash('error', 'Tugas tidak ditemukan.');
            return redirect()->route('tambahtugas.index');
        }
    
        // Proses file jika ada
        if (isset($this->tambahtugas['lampiran'])) {
            $files = File::where('tambahtugas_id', $model->id)->get()->first();
            if($files != null){                
                // Jika sudah ada file, hapus file lama
                if ($files) {
                    Storage::delete($files->file_path);
                }
                // Proses upload file baru
                $uploadedFile = $this->tambahtugas['lampiran'];
                $originalName = $uploadedFile->getClientOriginalName();
                $filePath = $uploadedFile->storeAs('upload', $originalName, 'public');
                $fileExtension = $uploadedFile->getClientOriginalExtension();
                $files->update([
                    'file_name' => $originalName,
                    'file_path' => $filePath,
                    'file_extension' => $fileExtension,
                ]);
            } else {
                $file = new File();
                $file->tambahtugas_id = $model->id;
                $uploadedFile = $this->tambahtugas['lampiran'];
                $originalName = $uploadedFile->getClientOriginalName();
                $filePath = $uploadedFile->storeAs('upload', $originalName, 'public');
                $file->file_name = $uploadedFile->getClientOriginalName();
                $file->file_path = $filePath;
                $file->file_extension = $uploadedFile->getClientOriginalExtension();
                $file->save();
            }
        }
    
        // Update model dengan data baru
        $model->update($this->tambahtugas);
    
        session()->flash('success', 'Data tugas berhasil diedit.');
    
        return redirect()->route('tambahtugas.index');
    }

    public function render(Request $request)
    {
        $dataTugas = TambahTugas::where('id', $request->id)->with('files')->get()->first();

        if ($dataTugas && $dataTugas->files) {
            $filePath = $dataTugas->files->file_path;
            $fileName = $dataTugas->files->file_name;
        } else {
            // Tangani kasus ketika $dataTugas atau $dataTugas->files adalah null
            $filePath = null;
            $fileName = null;
        }        

        return view('livewire.tambahtugas-edit-form',[
            'filePath' => $filePath ?? null,
            'fileName' => $fileName ?? null,
        ]);
    }
}
