<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kompanija;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * KompanijaController - Resource Controller
 * Implements full REST API for companies
 */
class KompanijaController extends Controller
{
    /**
     * Display a listing of all companies
     * GET /api/kompanije
     */
    public function index(Request $request)
    {
        $query = Kompanija::query();

        // Filter by city
        if ($request->has('grad')) {
            $query->where('grad', $request->grad);
        }

        // Filter by active status
        if ($request->has('aktivna')) {
            $query->where('aktivna', $request->boolean('aktivna'));
        }

        // Search by name
        if ($request->has('search')) {
            $query->where('naziv', 'like', '%' . $request->search . '%');
        }

        $kompanije = $query->withCount('oglasi')->paginate(10);

        return $this->successResponse($kompanije, 'Companies retrieved successfully');
    }

    /**
     * Store a newly created company
     * POST /api/kompanije
     * Requires authentication
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'naziv' => 'required|string|max:255',
            'opis' => 'required|string',
            'adresa' => 'nullable|string|max:255',
            'grad' => 'nullable|string|max:100',
            'email' => 'required|email|unique:kompanije',
            'telefon' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|string|max:255',
            'broj_zaposlenih' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $kompanija = Kompanija::create($request->all());

        return $this->successResponse($kompanija, 'Company created successfully', 201);
    }

    /**
     * Display the specified company
     * GET /api/kompanije/{id}
     */
    public function show($id)
    {
        $kompanija = Kompanija::with('oglasi')->find($id);

        if (!$kompanija) {
            return $this->errorResponse('Company not found', 404);
        }

        return $this->successResponse($kompanija, 'Company retrieved successfully');
    }

    /**
     * Update the specified company
     * PUT /api/kompanije/{id}
     * Requires authentication
     */
    public function update(Request $request, $id)
    {
        $kompanija = Kompanija::find($id);

        if (!$kompanija) {
            return $this->errorResponse('Company not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'naziv' => 'sometimes|string|max:255',
            'opis' => 'sometimes|string',
            'adresa' => 'nullable|string|max:255',
            'grad' => 'nullable|string|max:100',
            'email' => 'sometimes|email|unique:kompanije,email,' . $id,
            'telefon' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|string|max:255',
            'broj_zaposlenih' => 'nullable|integer|min:1',
            'aktivna' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $kompanija->update($request->all());

        return $this->successResponse($kompanija, 'Company updated successfully');
    }

    /**
     * Remove the specified company
     * DELETE /api/kompanije/{id}
     * Requires authentication
     */
    public function destroy($id)
    {
        $kompanija = Kompanija::find($id);

        if (!$kompanija) {
            return $this->errorResponse('Company not found', 404);
        }

        $kompanija->delete();

        return $this->successResponse(null, 'Company deleted successfully');
    }

    /**
     * Get all job listings for a specific company
     * GET /api/kompanije/{id}/oglasi
     */
    public function oglasi($id)
    {
        $kompanija = Kompanija::find($id);

        if (!$kompanija) {
            return $this->errorResponse('Company not found', 404);
        }

        $oglasi = $kompanija->oglasi()->where('aktivan', true)->get();

        return $this->successResponse($oglasi, 'Company job listings retrieved successfully');
    }
}
