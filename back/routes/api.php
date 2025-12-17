<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KompanijaController;
use App\Http\Controllers\OglasController;
use App\Http\Controllers\PrijavaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\AuthController;

use App\Http\Controllers\UserPrijavaController;
use App\Http\Controllers\KompanijaOglasController;
use App\Http\Controllers\OglasPrijavaController;

use App\Http\Resources\UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| API rute koje vraćaju podatke u JSON formatu.
| Zaštićene rute zahtevaju autentifikaciju (auth:sanctum).
|
*/

// ========================================
// Ruta za profil ulogovanog korisnika
// ========================================
Route::middleware('auth:sanctum')->get('/myprofile', function (Request $request) {
    return new UserResource($request->user());
});

// ========================================
// ZAŠTIĆENE RUTE (potrebna autentifikacija)
// ========================================
Route::group(['middleware' => ['auth:sanctum']], function () {
    
    // Logout ruta
    Route::post('/logout', [AuthController::class, 'logout']);

    // Prikaz korisnika je moguć za ulogovanog korisnika
    Route::resource('users', UserController::class)->only(['index', 'show']);
    // Ažuriranje i brisanje je moguće samo za admina
    Route::resource('users', UserController::class)->only(['update']);
    Route::resource('users', UserController::class)->only(['destroy']);

    // Samo admin/kompanija može da doda, ažurira ili briše kompaniju
    Route::resource('kompanije', KompanijaController::class)->only(['store', 'update', 'destroy']);

    // Samo admin/kompanija može da doda, ažurira ili briše oglas
    Route::resource('oglasi', OglasController::class)->only(['store', 'update', 'destroy']);

    // Korisnik može da kreira prijavu, admin/kompanija može da ažurira/briše
    Route::resource('prijave', PrijavaController::class)->only(['store', 'update', 'destroy']);

    // Moje prijave (za ulogovanog korisnika)
    Route::get('/myPrijave', [UserPrijavaController::class, 'myPrijave']);
});

// ========================================
// JAVNE RUTE (bez autentifikacije)
// ========================================

// Autentifikacija
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Pretraga
Route::get('kompanije/search', [KompanijaController::class, 'search']);
Route::get('oglasi/search', [OglasController::class, 'search']);

// Svi mogu da pregledaju kompanije (resource ruta - samo index i show)
Route::resource('kompanije', KompanijaController::class)->only(['index', 'show']);

// Svi mogu da pregledaju oglase
Route::resource('oglasi', OglasController::class)->only(['index', 'show']);

// Svi mogu da pregledaju prijave
Route::resource('prijave', PrijavaController::class)->only(['index', 'show']);

// ========================================
// DODATNE RUTE (nested resources)
// ========================================

// Prijave određenog korisnika
Route::get('/users/{id}/prijave', [UserPrijavaController::class, 'index']);

// Oglasi određene kompanije
Route::get('/kompanije/{id}/oglasi', [KompanijaOglasController::class, 'index']);

// Prijave za određeni oglas
Route::get('/oglasi/{id}/prijave', [OglasPrijavaController::class, 'index']);
