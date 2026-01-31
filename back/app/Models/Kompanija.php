<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kompanija extends Model
{
    use HasFactory;

    // Vezuje model za tabelu "kompanije"
    protected $table = 'kompanije';

    // Primarni ključ tabele
    protected $primaryKey = 'id';

    protected $fillable = [
        'naziv',
        'opis',
        'grad',
        'email',
        'telefon',
    ];

    // Relacija - jedna Kompanija ima mnogo Oglasa
    public function oglasi()
    {
        return $this->hasMany(Oglas::class, 'kompanija');
    }
}
