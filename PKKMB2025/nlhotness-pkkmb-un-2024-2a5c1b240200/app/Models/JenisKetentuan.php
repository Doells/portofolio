<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisKetentuan extends Model
{
    use HasFactory;
    use SoftDeletes;


    public $table = 'jenis_ketentuan';


    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];


    protected $fillable = [
        'title',
        'updated_at',
        'created_at',
        'deleted_at',
    ];





    // one to one


    // one to many
    public function ketentuan()
    {
        return $this->hasMany('App\Models\Ketentuan', 'jenis_ketentuan_id');
    }
}
