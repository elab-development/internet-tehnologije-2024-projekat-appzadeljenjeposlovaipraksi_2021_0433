<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ime',
        'prezime',
        'email',
        'password',
        'telefon',
        'tip_korisnika', // 'student', 'kompanija', 'admin'
        'kompanija_id',
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

    /**
     * Get the company that the user belongs to (if company employee)
     */
    public function kompanija()
    {
        return $this->belongsTo(Kompanija::class, 'kompanija_id');
    }

    /**
     * Get all applications submitted by this user (if student)
     */
    public function prijave()
    {
        return $this->hasMany(Prijava::class, 'korisnik_id');
    }
}
