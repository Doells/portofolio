<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    use HasFactory;
    
    public $table = 'detailuser';
    protected $fillable = ['photo', 
                           'nim', 
                           'nama_lengkap', 
                           'prodi', 
                           'fakultas', 
                           'no_hp', 
                           'email', 
                           'sistem_kuliah', 
                           'tahun_angkatan', 
                           'jalur_penerimaan',
                           'jenis_kelamin', 
                           'tgl_lahir', 
                           'tempat_lahir', 
                           'agama', 
                           'alamat'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
