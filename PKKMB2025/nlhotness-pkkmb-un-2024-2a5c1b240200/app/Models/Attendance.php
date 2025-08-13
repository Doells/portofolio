<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'start_time',
        'batas_start_time',
        'end_time',
        'batas_end_time',
        'code'
    ];

    protected $appends = ['data'];

    // Fungsi untuk memeriksa apakah nilai waktu adalah valid
    private function isValidTime($time)
    {
        return !empty($time) && is_string($time);
    }

    protected function data(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $now = now();
                $startTime = Carbon::parse($this->date. '' .$this->start_time);
                $batasStartTime = Carbon::parse($this->date. '' .$this->batas_start_time);
                $startDate = Carbon::parse($this->date);

                // Cek apakah nilai end_time dan batas_end_time adalah valid sebelum parsing
                if ($this->isValidTime($this->end_time) && $this->isValidTime($this->batas_end_time)) {
                    $endTime = Carbon::parse($this->end_time);
                    $batasEndTime = Carbon::parse($this->batas_end_time);
                    
                    // Lakukan operasi dengan waktu yang sudah di-parse jika diperlukan
                    // ...
                } else {
                    // Tangani kasus ketika waktu tidak valid
                    // Contoh: Tampilkan pesan kesalahan atau gunakan nilai default
                    $endTime = null; // Atau nilai default sesuai kebutuhan
                    $batasEndTime = null; // Atau nilai default sesuai kebutuhan
                }

                return (object) [
                    "start_time" => $this->start_time,
                    "batas_start_time" => $this->batas_start_time,
                    "end_time" => $this->end_time,
                    "batas_end_time" => $this->batas_end_time,
                    "is_date" => $startDate >= $now,
                    "now" => $now->format("H:i:s"),
                    "is_start" => $startTime <= $now && $batasStartTime >= $now,
                    "is_end" => $endTime <= $now && $batasEndTime >= $now,
                    'is_using_qrcode' => $this->code ? true : false,
                ];
            },
        );
    }

    public function scopeForCurrentUser($query, $userPositionId)
    {
        $query->whereHas('positions', function ($query) use ($userPositionId) {
            $query->where('position_id', $userPositionId);
        });
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }

    public function presences()
    {
        return $this->hasMany(Presence::class);
    }
}
