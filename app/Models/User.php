<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function nomorserial(){
        return $this->hasOne(Nomorserial::class, 'user_id');
    }
    public function alat(){
        return $this->hasOne(Alat::class, 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'rules',
        'username',
        'email',
        'password',
        'nomer',
        'gambar',
        'alat_terdaftar'
    ];
       // protected $guarded = ['user_id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
