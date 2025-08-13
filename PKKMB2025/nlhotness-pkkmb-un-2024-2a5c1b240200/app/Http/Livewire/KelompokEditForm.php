<?php

namespace App\Http\Livewire;

use App\Models\Kelompok;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Livewire\Component;

class KelompokEditForm extends Component
{
    public $kelompok;

    // Aturan validasi Livewire
    protected $rules = [
        'kelompok.kode_kelompok' => 'required',
        'kelompok.name' => 'required',
    ];

    public function mount($kelompokId)
    {
        $this->kelompok = Kelompok::findOrFail($kelompokId);
    }

    public function editKelompok()
    {
        // Validasi sesuai aturan yang sudah didefinisikan di $rules
        $this->validate();

        // Simpan data kelompok yang telah diubah
        $this->kelompok->save();

        // Redirect dengan pesan sukses
        session()->flash('success', 'Data kelompok berhasil diperbarui.');
        return redirect()->route('kelompok.index');
    }

    public function render()
    {
        return view('livewire.kelompok-edit-form');
    }
}


