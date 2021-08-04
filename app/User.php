<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Divisi;
use App\Notification;
use App\Perakitan;
use App\UserLog;
use App\PeminjamanAlat;

class User extends Authenticatable
{
    use Notifiable;

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

    public function department()
    {
        return $this->belongsTo('App\digidocu\Department');
    }

    public function documents()
    {
        return $this->hasMany('App\digidocu\Document');
    }

    public function PersiapanPackingProduk()
    {
        return $this->hasMany(PersiapanPackingProduk::class);
    }

    public function Produk()
    {
        return $this->hasMany(Produk::class, 'ppic_id');
    }

    public function Kalibrasi()
    {
        return $this->belongsTo(User::class, 'pic_id');
    }

    public function AnalisaPsPerakitan()
    {
        return $this->hasMany(AnalisaPsPerakitan::class, 'ppic_id');
    }
}
