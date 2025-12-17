<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prijava extends Model
{
    use HasFactory;

    // Vezuje model za tabelu "prijave"
    protected $table = 'prijave';

    // Primarni ključ tabele
    public $primaryKey = 'id';

    protected $fillable = [
        'user',
        'oglas',
        'motivaciono_pismo',
        'status',
        'datum_prijave',
    ];

    // belongsTo znači da svaki zapis u tabeli prijave pripada tačno jednom zapisu u tabeli users
    public function userkey()
    {
        return $this->belongsTo(User::class, 'user');
    }

    // belongsTo znači da svaki zapis u tabeli prijave pripada tačno jednom zapisu u tabeli oglasi
    public function oglaskey()
    {
        return $this->belongsTo(Oglas::class, 'oglas');
    }
}
