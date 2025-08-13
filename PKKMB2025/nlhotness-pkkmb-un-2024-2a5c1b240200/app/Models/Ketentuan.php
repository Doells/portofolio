<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ketentuan extends Model
{
    use HasFactory;
    use SoftDeletes;


    public $table = 'ketentuan';


    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];


    protected $fillable = [
        'title',
        'jenis_ketentuan_id',
        'poin',
        'updated_at',
        'created_at',
        'deleted_at',
    ];





    // one to one


    // one to many
    public function pelanggaran()
    {
        return $this->hasMany('App\Models\Pelanggaran', 'ketentuan_id');
    }

    public function jenisketentuan()
    {
        return $this->belongsTo('App\Models\JenisKetentuan', 'jenis_ketentuan_id', 'id');
    }
}
