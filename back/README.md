# Job Assignment and Internship Application - Backend API

Laravel backend API za aplikaciju za deljenje poslova i praksi.

## Zahtevi

- PHP 8.2+
- Composer
- SQLite / MySQL / PostgreSQL

## Instalacija

1. Klonirajte repozitorijum
2. Navigirajte do backend foldera:
   ```bash
   cd backend
   ```

3. Instalirajte zavisnosti:
   ```bash
   composer install
   ```

4. Kopirajte `.env.example` u `.env`:
   ```bash
   cp .env.example .env
   ```

5. Generišite aplikacioni ključ:
   ```bash
   php artisan key:generate
   ```

6. Kreirajte SQLite bazu (ili konfigurišite MySQL):
   ```bash
   touch database/database.sqlite
   ```

7. Pokrenite migracije:
   ```bash
   php artisan migrate
   ```

8. (Opciono) Popunite bazu test podacima:
   ```bash
   php artisan db:seed
   ```

9. Pokrenite razvojni server:
   ```bash
   php artisan serve
   ```

API će biti dostupan na `http://localhost:8000`

## API Rute

### Javne rute (bez autentifikacije)
- `POST /api/register` - Registracija korisnika
- `POST /api/login` - Prijava korisnika
- `GET /api/kompanije` - Lista kompanija
- `GET /api/kompanije/{id}` - Detalji kompanije
- `GET /api/kompanije/search/{naziv}` - Pretraga kompanija
- `GET /api/oglasi` - Lista oglasa
- `GET /api/oglasi/{id}` - Detalji oglasa
- `GET /api/oglasi/search/{naslov}` - Pretraga oglasa
- `GET /api/prijave` - Lista prijava
- `GET /api/prijave/{id}` - Detalji prijave
- `GET /api/kompanije/{id}/oglasi` - Oglasi određene kompanije
- `GET /api/oglasi/{id}/prijave` - Prijave za određeni oglas

### Zaštićene rute (potrebna autentifikacija)
- `POST /api/logout` - Odjava korisnika
- `POST /api/kompanije` - Kreiranje kompanije
- `PUT /api/kompanije/{id}` - Ažuriranje kompanije
- `DELETE /api/kompanije/{id}` - Brisanje kompanije
- `POST /api/oglasi` - Kreiranje oglasa
- `PUT /api/oglasi/{id}` - Ažuriranje oglasa
- `DELETE /api/oglasi/{id}` - Brisanje oglasa
- `POST /api/prijave` - Kreiranje prijave
- `PUT /api/prijave/{id}` - Ažuriranje prijave
- `DELETE /api/prijave/{id}` - Brisanje prijave
- `GET /api/users/{id}/prijave` - Prijave određenog korisnika

## Modeli

- **User** - Korisnik sistema (role: user, admin, kompanija)
- **Kompanija** - Kompanija koja objavljuje oglase
- **Oglas** - Oglas za posao ili praksu
- **Prijava** - Prijava korisnika na oglas

## Autentifikacija

API koristi Laravel Sanctum za token-based autentifikaciju. 

### Primer autentifikacije:

1. Registrujte se:
```bash
POST /api/register
{
    "name": "Ime Prezime",
    "email": "email@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

2. Prijavite se:
```bash
POST /api/login
{
    "email": "email@example.com",
    "password": "password"
}
```

3. Koristite vraćeni token u zaglavlju:
```
Authorization: Bearer {token}
```

## Migracije

Projekat sadrži 5+ različitih tipova migracija:
1. Kreiranje tabela (create_users_table, create_kompanije_table, itd.)
2. Dodavanje kolona (add_column_role_to_users_table)
3. Modifikovanje kolona (change_telefon_constraint_in_kompanije_table)
4. Foreign key ograničenja
5. Personal access tokens tabela za Sanctum
