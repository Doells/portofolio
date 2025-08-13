<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const SUPERADMIN_ROLE_ID = 1;
    const ADMIN_ROLE_ID = 2;
    const USER_ROLE_ID = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nim',
        'password',
        'position_id',
        'role_id',
        'kelompok_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function detailuser()
    {
        return $this->hasOne(DetailUser::class, 'user_id', 'id');
    }

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }

    public function submitPresensi()
    {
        return $this->hasMany(Presence::class);
    }

    public function submitTugas()
    {
        return $this->hasMany(Task::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function task()
    {
        return $this->hasOne(Task::class, 'user_id', 'id');
    }

    public function scopeOnlyStudents($query)
    {
        return $query->where('role_id', self::USER_ROLE_ID);
    }

    public function scopeOnlyAdmins($query)
    {
        return $query->where(function ($query){
            $query->orWhere('role_id', self::SUPERADMIN_ROLE_ID)
                ->orWhere('role_id', self::ADMIN_ROLE_ID);
        });
    }


    public function isSuperAdmin()
    {
        return $this->role_id === self::SUPERADMIN_ROLE_ID;
    }

    public function isAdmin()
    {
        return $this->role_id === self::ADMIN_ROLE_ID;
    }

    public function isUser()
    {
        return $this->role_id === self::USER_ROLE_ID;
    }

    public function news()
    {
        return $this->hasMany('App\Models\News', 'users_id');
    }

    public function pelanggaran_peserta()
    {
        return $this->hasMany(Pelanggaran::class, 'peserta_id');
    }

    public function pelanggaran_panitia()
    {
        return $this->hasMany('App\Models\Pelanggaran', 'panitia_id');
    }


    //perhitungan hasil
}
