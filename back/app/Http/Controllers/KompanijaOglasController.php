<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Oglas;
use App\Http\Resources\OglasCollection;

class KompanijaOglasController extends Controller
{
    /**
     * Get all job listings for a specific company
     * GET /api/kompanije/{id}/oglasi
     */
    public function index($id)
    {
        $oglasi = Oglas::where('kompanija_id', $id)->get();
        return new OglasCollection($oglasi);
    }
}
