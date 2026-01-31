<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Prijava;
use App\Http\Resources\PrijavaCollection;

class UserPrijavaController extends Controller
{
    /**
     * Get all applications for the authenticated user
     * GET /api/myPrijave
     */
    public function myPrijave()
    {
        $prijave = Prijava::where('user', auth()->user()->id)->get();
        return new PrijavaCollection($prijave);
    }

    /**
     * Get all applications for a specific user
     * GET /api/users/{id}/prijave
     */
    public function index($id)
    {
        $prijave = Prijava::where('user', $id)->get();
        return new PrijavaCollection($prijave);
    }
}
