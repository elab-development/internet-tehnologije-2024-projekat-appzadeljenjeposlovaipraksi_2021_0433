<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oglas extends Model
{
    use HasFactory;

    protected $table = 'oglasi';

    protected $fillable = [
        'naslov',
        'opis',
        'lokacija',
        'tip_posla', // 'praksa', 'posao', 'part-time'
        'plata',
        'trajanje',
        'zahtevi',
        'kompanija_id',
        'aktivan',
        'rok_prijave',
    ];

    protected $casts = [
        'aktivan' => 'boolean',
        'rok_prijave' => 'date',
        'plata' => 'decimal:2',
    ];

    /**
     * Get the company that owns this job listing
     */
    public function kompanija()
    {
        return $this->belongsTo(Kompanija::class, 'kompanija_id');
    }

    /**
     * Get all applications for this job listing
     */
    public function prijave()
    {
        return $this->hasMany(Prijava::class, 'oglas_id');
    }
}
