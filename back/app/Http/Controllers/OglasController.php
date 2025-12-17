<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Oglas;
use App\Models\Kompanija;
use App\Models\Prijava;
use App\Http\Resources\OglasResource;
use App\Http\Resources\OglasCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class OglasController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/oglasi
     */
    public function index()
    {
        return new OglasCollection(Oglas::all());
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/oglasi
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'naslov' => 'required|string|max:150',
            'opis' => 'required|string',
            'lokacija' => 'nullable|string|max:255',
            'tip_posla' => 'required|in:praksa,posao,part-time',
            'plata' => 'nullable|numeric|min:0',
            'zahtevi' => 'nullable|string',
            'kompanija' => 'required|exists:kompanije,id',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        if (auth()->user()->isUser())
            return response()->json('You are not authorized to create new job listings.');

        $oglas = Oglas::create([
            'naslov' => $request->naslov,
            'opis' => $request->opis,
            'lokacija' => $request->lokacija,
            'tip_posla' => $request->tip_posla,
            'plata' => $request->plata,
            'zahtevi' => $request->zahtevi,
            'kompanija' => $request->kompanija,
        ]);

        return response()->json(['Oglas is created successfully.', new OglasResource($oglas)]);
    }

    /**
     * Display the specified resource.
     * GET /api/oglasi/{oglas}
     */
    public function show(Oglas $oglas)
    {
        return new OglasResource($oglas);
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/oglasi/{id}
     */
    public function update(Request $request, $id)
    {
        $oglas = Oglas::find($id);
        if (!$oglas) {
            return response()->json(['error' => 'Oglas not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'naslov' => 'required|string|max:150',
            'opis' => 'required|string',
            'lokacija' => 'nullable|string|max:255',
            'tip_posla' => 'required|in:praksa,posao,part-time',
            'plata' => 'nullable|numeric|min:0',
            'zahtevi' => 'nullable|string',
            'kompanija' => 'required|exists:kompanije,id',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        if (auth()->user()->isUser())
            return response()->json('You are not authorized to update job listings.');

        $oglas->naslov = $request->naslov;
        $oglas->opis = $request->opis;
        $oglas->lokacija = $request->lokacija;
        $oglas->tip_posla = $request->tip_posla;
        $oglas->plata = $request->plata;
        $oglas->zahtevi = $request->zahtevi;
        $oglas->kompanija = $request->kompanija;
        $oglas->save();

        return response()->json(['message' => 'Oglas is updated successfully.', 'oglas' => new OglasResource($oglas)]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/oglasi/{oglas}
     */
    public function destroy(Oglas $oglas)
    {
        if (auth()->user()->isUser()) {
            return response()->json('You are not authorized to delete job listings.');
        }

        // Provera da li oglas ima prijave
        $prijave = Prijava::where('oglas', $oglas->id)->get();
        if ($prijave->count() > 0) {
            return response()->json('You cannot delete job listings that have applications.');
        }

        $oglas->delete();

        return response()->json('Oglas is deleted successfully.');
    }

    /**
     * Search job listings
     * GET /api/oglasi/search
     */
    public function search(Request $request)
    {
        Log::info('Pretraga oglasa', ['request' => $request->all()]);

        $query = Oglas::query();

        if ($request->has('naslov') && !empty($request->naslov)) {
            $query->where('naslov', 'like', '%' . $request->naslov . '%');
        }

        if ($request->has('lokacija') && !empty($request->lokacija)) {
            $query->where('lokacija', 'like', '%' . $request->lokacija . '%');
        }

        if ($request->has('tip_posla') && !empty($request->tip_posla)) {
            $query->where('tip_posla', $request->tip_posla);
        }

        $oglasi = $query->get();

        return response()->json($oglasi);
    }
}
