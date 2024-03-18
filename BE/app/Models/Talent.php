<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Talent extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'talents';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nik',
        'email',
        'namaL',
        'namaP',
        'gender',
        'noHP',
        'alamat_KTP',
        'alamat_domisili',
        'pendidikan_terakhir',
        'status_pekerjaan',
        'jenis_pekerjaan_yang_diminati',
        'skill_1',
        'skill_1_waktu',
        'skill_2',
        'skill_2_waktu',
        'level',
        'waktu_assign',
        'linkedin',
        'github',
        'cv',
        'password',
        'hunter',
        'email_verified_at'
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
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

    public function hunter()
    {
        return $this->belongsTo(User::class);
    }
}
