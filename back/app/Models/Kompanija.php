<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompanija extends Model
{
    use HasFactory;

    protected $table = 'kompanije';

    protected $fillable = [
        'naziv',
        'opis',
        'adresa',
        'grad',
        'email',
        'telefon',
        'website',
        'logo',
        'aktivna',
    ];

    protected $casts = [
        'aktivna' => 'boolean',
    ];

    /**
     * Get all job listings for this company
     */
    public function oglasi()
    {
        return $this->hasMany(Oglas::class, 'kompanija_id');
    }

    /**
     * Get all users (employees) of this company
     */
    public function zaposleni()
    {
        return $this->hasMany(User::class, 'kompanija_id');
    }
}
