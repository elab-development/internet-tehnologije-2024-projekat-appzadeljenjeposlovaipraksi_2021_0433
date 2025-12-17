<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Oglas extends Model
{
    use HasFactory;

    // Vezuje model za tabelu "oglasi"
    protected $table = 'oglasi';

    // Primarni ključ tabele
    protected $primaryKey = 'id';

    protected $fillable = [
        'naslov',
        'opis',
        'lokacija',
        'tip_posla',
        'plata',
        'zahtevi',
        'kompanija',
    ];

    // belongsTo znači da svaki zapis u tabeli oglasi pripada tačno jednom zapisu u tabeli kompanije
    public function kompanijakey()
    {
        return $this->belongsTo(Kompanija::class, 'kompanija');
    }

    // Relacija - jedan Oglas ima mnogo Prijava
    public function prijave()
    {
        return $this->hasMany(Prijava::class, 'oglas');
    }
}
