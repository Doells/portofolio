<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TambahTugas extends Model
{
    use HasFactory;

    public $table = 'tambahtugas';
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'batas_start_time',
        'input_type',
    ];

    protected $appends = ['data'];

    private function isValidTime($time)
    {
        return !empty($time) && is_string($time);
    }

    protected function data(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $now = now();
                $nowDate = now();
                $startTime = Carbon::parse($this->start_date. '' .$this->start_time);
                $batasStartTime = Carbon::parse($this->end_date. '' .$this->batas_start_time);
                $startDate = Carbon::parse($this->start_date);
                $endDate = Carbon::parse($this->end_date);

                return (object) [
                    "start_time" => $this->start_time,
                    "batas_start_time" => $this->batas_start_time,
                    "start_date" => $startDate >= $nowDate,
                    "end_date" => $endDate <= $nowDate,
                    "now" => $now->format("H:i:s"),
                    "nowDate" => $nowDate,
                    "is_start" => ($startTime <= $now && $batasStartTime >= $now) || ($startDate <= $nowDate && $endDate >= $nowDate),
                    "is_open" => ($startTime <= $now) || ($startDate <= $nowDate),
                ];
            },
        );
    }

    public function task()
    {
        return $this->hasOne(Task::class, 'tambahtugas_id', 'id');
    }

    // Di dalam model Task.php
    public function files()
    {
        return $this->hasOne(File::class, 'tambahtugas_id', 'id');
    }
}
