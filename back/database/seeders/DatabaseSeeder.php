<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kompanija;
use App\Models\Oglas;
use App\Models\Prijava;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular users
        $user1 = User::create([
            'name' => 'Petar Petrović',
            'email' => 'petar@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $user2 = User::create([
            'name' => 'Marija Marić',
            'email' => 'marija@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create company user
        $kompanijaUser = User::create([
            'name' => 'Kompanija Manager',
            'email' => 'kompanija@example.com',
            'password' => Hash::make('password'),
            'role' => 'kompanija',
        ]);

        // Create companies
        $kompanija1 = Kompanija::create([
            'naziv' => 'Tech Solutions d.o.o.',
            'adresa' => 'Bulevar Mihajla Pupina 10',
            'grad' => 'Beograd',
            'telefon' => '+381 11 1234567',
            'email' => 'info@techsolutions.rs',
            'opis' => 'Vodeća IT kompanija u regionu specijalizovana za razvoj softvera.',
            'logo' => 'tech_solutions_logo.png',
        ]);

        $kompanija2 = Kompanija::create([
            'naziv' => 'Digital Marketing Agency',
            'adresa' => 'Knez Mihailova 22',
            'grad' => 'Beograd',
            'telefon' => '+381 11 7654321',
            'email' => 'contact@digitalmarketing.rs',
            'opis' => 'Agencija za digitalni marketing i oglašavanje na društvenim mrežama.',
            'logo' => 'digital_marketing_logo.png',
        ]);

        $kompanija3 = Kompanija::create([
            'naziv' => 'Finance Corp',
            'adresa' => 'Terazije 5',
            'grad' => 'Beograd',
            'telefon' => '+381 11 9876543',
            'email' => 'hr@financecorp.rs',
            'opis' => 'Finansijska kompanija koja nudi razne usluge u oblasti finansija.',
            'logo' => 'finance_corp_logo.png',
        ]);

        // Create job listings (oglasi)
        $oglas1 = Oglas::create([
            'naslov' => 'Junior PHP Developer',
            'opis' => 'Tražimo Junior PHP developera sa znanjem Laravel frameworka. Potrebno je poznavanje MySQL baze podataka i Git sistema za kontrolu verzija.',
            'lokacija' => 'Beograd',
            'tip' => 'Posao',
            'plata' => '800-1200 EUR',
            'kompanija_id' => $kompanija1->id,
        ]);

        $oglas2 = Oglas::create([
            'naslov' => 'Frontend Developer - React',
            'opis' => 'Potreban Frontend developer sa iskustvom u React.js. Rad na modernim web aplikacijama.',
            'lokacija' => 'Remote',
            'tip' => 'Posao',
            'plata' => '1000-1500 EUR',
            'kompanija_id' => $kompanija1->id,
        ]);

        $oglas3 = Oglas::create([
            'naslov' => 'Praksa - Digital Marketing',
            'opis' => 'Nudimo praksu u oblasti digitalnog marketinga. Idealno za studente marketinga i komunikacija.',
            'lokacija' => 'Beograd',
            'tip' => 'Praksa',
            'plata' => 'Neplaćena praksa',
            'kompanija_id' => $kompanija2->id,
        ]);

        $oglas4 = Oglas::create([
            'naslov' => 'Junior Finansijski Analitičar',
            'opis' => 'Tražimo Junior finansijskog analitičara sa završenim ekonomskim fakultetom.',
            'lokacija' => 'Novi Sad',
            'tip' => 'Posao',
            'plata' => '700-900 EUR',
            'kompanija_id' => $kompanija3->id,
        ]);

        $oglas5 = Oglas::create([
            'naslov' => 'Praksa - Software Development',
            'opis' => 'Plaćena praksa za studente računarskih nauka. Rad na realnim projektima pod mentorstvom iskusnih developera.',
            'lokacija' => 'Beograd',
            'tip' => 'Praksa',
            'plata' => '300 EUR',
            'kompanija_id' => $kompanija1->id,
        ]);

        // Create applications (prijave)
        Prijava::create([
            'user_id' => $user1->id,
            'oglas_id' => $oglas1->id,
            'status' => 'Na čekanju',
            'motivaciono_pismo' => 'Zainteresovan sam za poziciju Junior PHP Developer jer imam iskustva sa Laravel frameworkom kroz fakultetske projekte.',
            'datum_prijave' => now(),
        ]);

        Prijava::create([
            'user_id' => $user1->id,
            'oglas_id' => $oglas5->id,
            'status' => 'Prihvaćena',
            'motivaciono_pismo' => 'Želim da se prijavim za praksu kako bih stekao praktično iskustvo u razvoju softvera.',
            'datum_prijave' => now()->subDays(5),
        ]);

        Prijava::create([
            'user_id' => $user2->id,
            'oglas_id' => $oglas3->id,
            'status' => 'Na čekanju',
            'motivaciono_pismo' => 'Kao studentkinja marketinga, verujem da bi ova praksa bila odlična prilika za sticanje praktičnog iskustva.',
            'datum_prijave' => now()->subDays(2),
        ]);

        Prijava::create([
            'user_id' => $user2->id,
            'oglas_id' => $oglas2->id,
            'status' => 'Odbijena',
            'motivaciono_pismo' => 'Imam osnovno znanje React.js i želela bih da ga unapredim na ovoj poziciji.',
            'datum_prijave' => now()->subDays(10),
        ]);
    }
}
