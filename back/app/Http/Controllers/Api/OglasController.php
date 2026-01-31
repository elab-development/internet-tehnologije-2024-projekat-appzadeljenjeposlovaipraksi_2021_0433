<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Oglas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * OglasController - Resource Controller for Job Listings
 */
class OglasController extends Controller
{
    /**
     * Display a listing of all job listings
     * GET /api/oglasi
     */
    public function index(Request $request)
    {
        $query = Oglas::with('kompanija');

        // Filter by job type
        if ($request->has('tip_posla')) {
            $query->where('tip_posla', $request->tip_posla);
        }

        // Filter by location
        if ($request->has('lokacija')) {
            $query->where('lokacija', 'like', '%' . $request->lokacija . '%');
        }

        // Filter by active status
        if ($request->has('aktivan')) {
            $query->where('aktivan', $request->boolean('aktivan'));
        } else {
            $query->where('aktivan', true);
        }

        // Search by title or description
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('naslov', 'like', '%' . $search . '%')
                  ->orWhere('opis', 'like', '%' . $search . '%');
            });
        }

        // Filter by salary range
        if ($request->has('min_plata')) {
            $query->where('plata', '>=', $request->min_plata);
        }
        if ($request->has('max_plata')) {
            $query->where('plata', '<=', $request->max_plata);
        }

        $oglasi = $query->orderBy('created_at', 'desc')->paginate(10);

        return $this->successResponse($oglasi, 'Job listings retrieved successfully');
    }

    /**
     * Store a newly created job listing
     * POST /api/oglasi
     * Requires authentication
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'naslov' => 'required|string|max:255',
            'opis' => 'required|string',
            'lokacija' => 'nullable|string|max:255',
            'tip_posla' => 'required|in:praksa,posao,part-time',
            'plata' => 'nullable|numeric|min:0',
            'zahtevi' => 'nullable|string',
            'kompanija_id' => 'required|exists:kompanije,id',
            'rok_prijave' => 'nullable|date|after:today',
            'trajanje_meseci' => 'nullable|integer|min:1',
            'datum_pocetka' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $oglas = Oglas::create($request->all());

        return $this->successResponse($oglas->load('kompanija'), 'Job listing created successfully', 201);
    }

    /**
     * Display the specified job listing
     * GET /api/oglasi/{id}
     */
    public function show($id)
    {
        $oglas = Oglas::with(['kompanija', 'prijave'])->find($id);

        if (!$oglas) {
            return $this->errorResponse('Job listing not found', 404);
        }

        return $this->successResponse($oglas, 'Job listing retrieved successfully');
    }

    /**
     * Update the specified job listing
     * PUT /api/oglasi/{id}
     * Requires authentication
     */
    public function update(Request $request, $id)
    {
        $oglas = Oglas::find($id);

        if (!$oglas) {
            return $this->errorResponse('Job listing not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'naslov' => 'sometimes|string|max:255',
            'opis' => 'sometimes|string',
            'lokacija' => 'nullable|string|max:255',
            'tip_posla' => 'sometimes|in:praksa,posao,part-time',
            'plata' => 'nullable|numeric|min:0',
            'zahtevi' => 'nullable|string',
            'aktivan' => 'sometimes|boolean',
            'rok_prijave' => 'nullable|date',
            'trajanje_meseci' => 'nullable|integer|min:1',
            'datum_pocetka' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $oglas->update($request->all());

        return $this->successResponse($oglas->load('kompanija'), 'Job listing updated successfully');
    }

    /**
     * Remove the specified job listing
     * DELETE /api/oglasi/{id}
     * Requires authentication
     */
    public function destroy($id)
    {
        $oglas = Oglas::find($id);

        if (!$oglas) {
            return $this->errorResponse('Job listing not found', 404);
        }

        $oglas->delete();

        return $this->successResponse(null, 'Job listing deleted successfully');
    }

    /**
     * Get latest job listings
     * GET /api/oglasi/latest
     */
    public function latest()
    {
        $oglasi = Oglas::with('kompanija')
            ->where('aktivan', true)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return $this->successResponse($oglasi, 'Latest job listings retrieved successfully');
    }

    /**
     * Get job listings by type
     * GET /api/oglasi/tip/{tip}
     */
    public function poTipu($tip)
    {
        if (!in_array($tip, ['praksa', 'posao', 'part-time'])) {
            return $this->errorResponse('Invalid job type', 400);
        }

        $oglasi = Oglas::with('kompanija')
            ->where('tip_posla', $tip)
            ->where('aktivan', true)
            ->paginate(10);

        return $this->successResponse($oglasi, 'Job listings by type retrieved successfully');
    }
}
