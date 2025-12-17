<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Prijava;
use App\Http\Resources\PrijavaCollection;

class OglasPrijavaController extends Controller
{
    /**
     * Get all applications for a specific job listing
     * GET /api/oglasi/{id}/prijave
     */
    public function index($id)
    {
        $prijave = Prijava::where('oglas', $id)->get();
        return new PrijavaCollection($prijave);
    }
}
