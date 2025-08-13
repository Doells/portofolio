<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /* protected $fillable = [
        'permission_reason', 
        'is_permission',
        "user_id",
        "presence_date",
        "presence_enter_time",
    ]; */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
