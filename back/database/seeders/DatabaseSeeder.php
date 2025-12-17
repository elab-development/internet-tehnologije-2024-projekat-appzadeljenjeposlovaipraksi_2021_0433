<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kompanija;
use App\Models\Oglas;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'ime' => 'Admin',
            'prezime' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'tip_korisnika' => 'admin',
        ]);

        // Create test student
        $student = User::create([
            'ime' => 'Petar',
            'prezime' => 'Petrovic',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'telefon' => '0641234567',
            'tip_korisnika' => 'student',
        ]);

        // Create companies
        $kompanija1 = Kompanija::create([
            'naziv' => 'Tech Solutions d.o.o.',
            'opis' => 'Vodeća IT kompanija u regionu specijalizovana za razvoj softvera.',
            'adresa' => 'Bulevar Mihajla Pupina 10',
            'grad' => 'Beograd',
            'email' => 'info@techsolutions.rs',
            'telefon' => '0112345678',
            'website' => 'https://techsolutions.rs',
            'broj_zaposlenih' => 150,
            'aktivna' => true,
        ]);

        $kompanija2 = Kompanija::create([
            'naziv' => 'Digital Agency',
            'opis' => 'Kreativna agencija za digitalni marketing i web dizajn.',
            'adresa' => 'Knez Mihailova 15',
            'grad' => 'Beograd',
            'email' => 'hello@digitalagency.rs',
            'telefon' => '0118765432',
            'website' => 'https://digitalagency.rs',
            'broj_zaposlenih' => 50,
            'aktivna' => true,
        ]);

        $kompanija3 = Kompanija::create([
            'naziv' => 'StartUp Hub',
            'opis' => 'Inkubator za startape i inovativne projekte.',
            'adresa' => 'Naučni park 5',
            'grad' => 'Novi Sad',
            'email' => 'contact@startuphub.rs',
            'telefon' => '0219876543',
            'website' => 'https://startuphub.rs',
            'broj_zaposlenih' => 25,
            'aktivna' => true,
        ]);

        // Create company user
        User::create([
            'ime' => 'Marko',
            'prezime' => 'Markovic',
            'email' => 'marko@techsolutions.rs',
            'password' => Hash::make('password'),
            'tip_korisnika' => 'kompanija',
            'kompanija_id' => $kompanija1->id,
        ]);

        // Create job listings
        Oglas::create([
            'naslov' => 'Junior PHP Developer',
            'opis' => 'Tražimo junior PHP developera za rad na Laravel projektima. Potrebno je osnovno znanje PHP-a, MySQL-a i Git-a.',
            'lokacija' => 'Beograd',
            'tip_posla' => 'posao',
            'plata' => 80000,
            'zahtevi' => 'PHP, MySQL, Git, Laravel (poželjno)',
            'kompanija_id' => $kompanija1->id,
            'aktivan' => true,
            'rok_prijave' => now()->addMonths(1),
            'trajanje_meseci' => null,
            'datum_pocetka' => now()->addWeeks(2),
        ]);

        Oglas::create([
            'naslov' => 'Frontend Developer Praksa',
            'opis' => 'Tražimo studente za plaćenu praksu u trajanju od 3 meseca. Rad na React projektima.',
            'lokacija' => 'Beograd',
            'tip_posla' => 'praksa',
            'plata' => 40000,
            'zahtevi' => 'HTML, CSS, JavaScript, React (osnovno)',
            'kompanija_id' => $kompanija1->id,
            'aktivan' => true,
            'rok_prijave' => now()->addWeeks(3),
            'trajanje_meseci' => 3,
            'datum_pocetka' => now()->addMonths(1),
        ]);

        Oglas::create([
            'naslov' => 'UI/UX Designer',
            'opis' => 'Potreban nam je kreativni UI/UX dizajner za rad na web i mobilnim aplikacijama.',
            'lokacija' => 'Beograd',
            'tip_posla' => 'posao',
            'plata' => 100000,
            'zahtevi' => 'Figma, Adobe XD, Photoshop, osnove HTML/CSS',
            'kompanija_id' => $kompanija2->id,
            'aktivan' => true,
            'rok_prijave' => now()->addMonths(2),
            'trajanje_meseci' => null,
            'datum_pocetka' => now()->addMonths(1),
        ]);

        Oglas::create([
            'naslov' => 'Part-time Social Media Manager',
            'opis' => 'Tražimo osobu za vođenje društvenih mreža na pola radnog vremena.',
            'lokacija' => 'Remote',
            'tip_posla' => 'part-time',
            'plata' => 35000,
            'zahtevi' => 'Iskustvo sa društvenim mrežama, kreativnost, poznavanje alata za dizajn',
            'kompanija_id' => $kompanija2->id,
            'aktivan' => true,
            'rok_prijave' => now()->addWeeks(2),
            'trajanje_meseci' => null,
            'datum_pocetka' => now()->addWeeks(1),
        ]);

        Oglas::create([
            'naslov' => 'Python Developer Intern',
            'opis' => 'StartUp Hub nudi priliku za studente da rade na real-world projektima koristeći Python i Django.',
            'lokacija' => 'Novi Sad',
            'tip_posla' => 'praksa',
            'plata' => 45000,
            'zahtevi' => 'Python (osnovno), želja za učenjem, timski rad',
            'kompanija_id' => $kompanija3->id,
            'aktivan' => true,
            'rok_prijave' => now()->addMonths(1),
            'trajanje_meseci' => 6,
            'datum_pocetka' => now()->addMonths(2),
        ]);

        echo "Database seeded successfully!\n";
        echo "Test accounts:\n";
        echo "- Admin: admin@example.com / password\n";
        echo "- Student: student@example.com / password\n";
        echo "- Company: marko@techsolutions.rs / password\n";
    }
}
