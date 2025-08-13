<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelanggaran extends Model
{
    use HasFactory;
    use SoftDeletes;


    public $table = 'pelanggaran';


    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];


    protected $fillable = [
        'peserta_id',
        'panitia_id',
        'ketentuan_id',
        'title',
        'poin',
        'updated_at',
        'created_at',
        'deleted_at',
    ];





    // one to one


    // one to many
    public function user_peserta()
    {
        return $this->belongsTo(User::class, 'peserta_id', 'id');
    }

    public function user_panitia()
    {
        return $this->belongsTo('App\Models\User', 'panitia_id', 'id');
    }

    public function ketentuan()
    {
        return $this->belongsTo('App\Models\Ketentuan', 'ketentuan_id', 'id');
    }
}
