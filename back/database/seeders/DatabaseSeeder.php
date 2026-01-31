<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---- KORISNICI ----
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin123@gmail.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ---- KOMPANIJE ----
        DB::table('kompanije')->insert([
            [
                'naziv' => 'Tech Solutions',
                'grad' => 'Beograd',
                'telefon' => '0111234567',
                'opis' => 'IT kompanija koja se bavi razvojem softvera',
                'aktivna' => 1,
                'broj_zaposlenih' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'naziv' => 'Creative Minds',
                'grad' => 'Novi Sad',
                'telefon' => '0217654321',
                'opis' => 'Marketinška i dizajn agencija',
                'aktivna' => 1,
                'broj_zaposlenih' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ---- OGLASI ----
        DB::table('oglasi')->insert([
            [
                'naslov' => 'Junior Developer',
                'opis' => 'Tražimo junior developera za rad u timu.',
                'lokacija' => 'Beograd',
                'tip_posla' => 'praksa',
                'plata' => 50000,
                'zahtevi' => 'Poznavanje PHP-a i Laravel-a',
                'kompanija_id' => 1, // <-- promenjeno
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'naslov' => 'Marketing Specialist',
                'opis' => 'Pozicija za marketing stručnjaka u agenciji.',
                'lokacija' => 'Novi Sad',
                'tip_posla' => 'posao',
                'plata' => 70000,
                'zahtevi' => 'Poznavanje društvenih mreža i SEO',
                'kompanija_id' => 2, // <-- promenjeno
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
