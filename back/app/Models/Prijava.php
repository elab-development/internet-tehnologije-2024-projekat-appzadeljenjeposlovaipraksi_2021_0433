<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prijava extends Model
{
    use HasFactory;

    protected $table = 'prijave';

    protected $fillable = [
        'korisnik_id',
        'oglas_id',
        'motivaciono_pismo',
        'cv_path',
        'status', // 'pending', 'accepted', 'rejected'
        'napomena',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who submitted this application
     */
    public function korisnik()
    {
        return $this->belongsTo(User::class, 'korisnik_id');
    }

    /**
     * Get the job listing this application is for
     */
    public function oglas()
    {
        return $this->belongsTo(Oglas::class, 'oglas_id');
    }
}
