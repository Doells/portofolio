<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = 
    [   
        'task_id',
        'file_name', 
        'file_path', 
        'file_extension',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }

    public function tambahtugas()
    {
        return $this->belongsTo(TambahTugas::class, 'tambahtugas_id', 'id');
    }
}
