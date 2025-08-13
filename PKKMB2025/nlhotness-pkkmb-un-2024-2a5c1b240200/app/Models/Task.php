<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $table = "task";

    protected $fillable = [
        'user_id',
        'tambahtugas_id',
        'text',
        'submit_date',
        'submit_enter_time',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tambahtugas() 
    {
       return $this->belongsTo(TambahTugas::class, 'tambahtugas_id', 'id');
    }

    // Di dalam model Task.php
    public function files()
    {
        return $this->hasMany(File::class);
    }

}
