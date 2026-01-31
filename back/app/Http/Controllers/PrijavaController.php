<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Prijava;
use App\Http\Resources\PrijavaResource;
use App\Http\Resources\PrijavaCollection;
use Illuminate\Support\Facades\Validator;

class PrijavaController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/prijave
     */
    public function index()
    {
        return new PrijavaCollection(Prijava::all());
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/prijave
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oglas' => 'required|exists:oglasi,id',
            'motivaciono_pismo' => 'nullable|string',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        // Provera da li korisnik vec ima prijavu za ovaj oglas
        $existingPrijava = Prijava::where('user', auth()->user()->id)
            ->where('oglas', $request->oglas)
            ->first();

        if ($existingPrijava) {
            return response()->json('You have already applied to this job listing.');
        }

        $prijava = Prijava::create([
            'user' => auth()->user()->id,
            'oglas' => $request->oglas,
            'motivaciono_pismo' => $request->motivaciono_pismo,
            'status' => 'pending',
            'datum_prijave' => now(),
        ]);

        return response()->json(['Prijava is created successfully.', new PrijavaResource($prijava)]);
    }

    /**
     * Display the specified resource.
     * GET /api/prijave/{prijava}
     */
    public function show(Prijava $prijava)
    {
        return new PrijavaResource($prijava);
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/prijave/{id}
     */
    public function update(Request $request, $id)
    {
        $prijava = Prijava::find($id);
        if (!$prijava) {
            return response()->json(['error' => 'Prijava not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,accepted,rejected',
            'motivaciono_pismo' => 'nullable|string',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        // Samo admin ili kompanija moze da menja status
        if (auth()->user()->isUser() && $prijava->user !== auth()->user()->id) {
            return response()->json('You are not authorized to update this application.');
        }

        $prijava->status = $request->status;
        if ($request->has('motivaciono_pismo')) {
            $prijava->motivaciono_pismo = $request->motivaciono_pismo;
        }
        $prijava->save();

        return response()->json(['message' => 'Prijava is updated successfully.', 'prijava' => new PrijavaResource($prijava)]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/prijave/{prijava}
     */
    public function destroy(Prijava $prijava)
    {
        // Samo vlasnik prijave ili admin moze da brise
        if (auth()->user()->isUser() && $prijava->user !== auth()->user()->id) {
            return response()->json('You are not authorized to delete this application.');
        }

        $prijava->delete();

        return response()->json('Prijava is deleted successfully.');
    }
}
