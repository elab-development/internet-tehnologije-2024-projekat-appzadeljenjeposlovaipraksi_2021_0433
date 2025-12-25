<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kompanija;
use App\Models\Oglas;
use App\Http\Resources\KompanijaResource;
use App\Http\Resources\KompanijaCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class KompanijaController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/kompanije
     */
    public function index()
    {
        return new KompanijaCollection(Kompanija::all());
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/kompanije
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'naziv' => 'required|string|max:150',
            'email' => 'required|email|unique:kompanije',
            'opis' => 'nullable|string',
            'grad' => 'nullable|string|max:100',
            'telefon' => 'nullable|string|max:20|unique:kompanije',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        if (auth()->user()->isUser())
            return response()->json('You are not authorized to create new companies.');

        $kompanija = Kompanija::create([
            'naziv' => $request->naziv,
            'opis' => $request->opis,
            'grad' => $request->grad,
            'telefon' => $request->telefon,
        ]);

        return response()->json(['Kompanija is created successfully.', new KompanijaResource($kompanija)]);
    }

    /**
     * Display the specified resource.
     * GET /api/kompanije/{kompanija}
     */
    public function show(Kompanija $kompanija)
    {
        return new KompanijaResource($kompanija);
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/kompanije/{id}
     */
    public function update(Request $request, $id)
    {
        $kompanija = Kompanija::find($id);
        if (!$kompanija) {
            return response()->json(['error' => 'Kompanija not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'naziv' => 'required|string|max:150',
            'email' => 'required|email|unique:kompanije,email,' . $kompanija->id,
            'opis' => 'nullable|string',
            'grad' => 'nullable|string|max:100',
            'telefon' => 'nullable|string|max:20|unique:kompanije,telefon,' . $kompanija->id,
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        if (auth()->user()->isUser())
            return response()->json('You are not authorized to update companies.');

        $kompanija->naziv = $request->naziv;
        $kompanija->opis = $request->opis;
        $kompanija->grad = $request->grad;
        $kompanija->email = $request->email;
        $kompanija->telefon = $request->telefon;
        $kompanija->save();

        return response()->json(['message' => 'Kompanija is updated successfully.', 'kompanija' => new KompanijaResource($kompanija)]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/kompanije/{kompanija}
     */
    public function destroy(Kompanija $kompanija)
    {
        if (auth()->user()->isUser()) {
            return response()->json('You are not authorized to delete companies.');
        }

        // Provera da li kompanija ima oglase
        $oglasi = Oglas::where('kompanija', $kompanija->id)->get();
        if ($oglasi->count() > 0) {
            return response()->json('You cannot delete companies that have job listings.');
        }

        $kompanija->delete();

        return response()->json('Kompanija is deleted successfully.');
    }

    /**
     * Search companies by name
     * GET /api/kompanije/search
     */
    public function search(Request $request)
    {
        Log::info('Pretraga kompanija', ['request' => $request->all()]);

        $query = Kompanija::query();

        if ($request->has('naziv') && !empty($request->naziv)) {
            $query->where('naziv', 'like', '%' . $request->naziv . '%');
        }

        if ($request->has('grad') && !empty($request->grad)) {
            $query->where('grad', 'like', '%' . $request->grad . '%');
        }

        $kompanije = $query->get();

        return response()->json($kompanije);
    }
}
