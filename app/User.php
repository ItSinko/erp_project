<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Divisi;
use App\Notification;
use App\Perakitan;
use App\UserLog;
use App\PeminjamanAlat;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'divisi_id', 'nama', 'username', 'email', 'password', 'foto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Messages()
    {
        return $this->hasMany(Message::class);
    }

    public function Divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function Notification()
    {
        return $this->hasMany(Notification::class);
    }

    public function Perakitan()
    {
        return $this->hasMany(Perakitan::class);
    }

    public function UserLog()
    {
        return $this->hasMany(UserLog::class);
    }

    public function PeminjamanAlat()
    {
        return $this->hasMany(PeminjamanAlat::class);
    }

    public function getIsSuperAdminAttribute()
    {
        return ($this->id == 1) ? true : false;
    }
}
