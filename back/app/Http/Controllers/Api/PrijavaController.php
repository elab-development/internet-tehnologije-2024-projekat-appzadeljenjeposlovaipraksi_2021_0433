<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prijava;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * PrijavaController - Controller for Job Applications
 */
class PrijavaController extends Controller
{
    /**
     * Display all applications for the current user
     * GET /api/prijave
     * Requires authentication
     */
    public function index(Request $request)
    {
        $prijave = Prijava::with(['oglas.kompanija'])
            ->where('korisnik_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $this->successResponse($prijave, 'Applications retrieved successfully');
    }

    /**
     * Store a new application
     * POST /api/prijave
     * Requires authentication
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oglas_id' => 'required|exists:oglasi,id',
            'motivaciono_pismo' => 'nullable|string',
            'cv_path' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        // Check if user already applied
        $existingPrijava = Prijava::where('korisnik_id', $request->user()->id)
            ->where('oglas_id', $request->oglas_id)
            ->first();

        if ($existingPrijava) {
            return $this->errorResponse('You have already applied to this job listing', 400);
        }

        $prijava = Prijava::create([
            'korisnik_id' => $request->user()->id,
            'oglas_id' => $request->oglas_id,
            'motivaciono_pismo' => $request->motivaciono_pismo,
            'cv_path' => $request->cv_path,
            'status' => 'pending',
        ]);

        return $this->successResponse($prijava->load('oglas.kompanija'), 'Application submitted successfully', 201);
    }

    /**
     * Display the specified application
     * GET /api/prijave/{id}
     * Requires authentication
     */
    public function show(Request $request, $id)
    {
        $prijava = Prijava::with(['oglas.kompanija', 'korisnik'])->find($id);

        if (!$prijava) {
            return $this->errorResponse('Application not found', 404);
        }

        // Check if user owns this application or is admin/company
        if ($prijava->korisnik_id !== $request->user()->id && 
            $request->user()->tip_korisnika === 'student') {
            return $this->errorResponse('Unauthorized', 403);
        }

        return $this->successResponse($prijava, 'Application retrieved successfully');
    }

    /**
     * Update application status (for company/admin)
     * PUT /api/prijave/{id}
     * Requires authentication
     */
    public function update(Request $request, $id)
    {
        $prijava = Prijava::find($id);

        if (!$prijava) {
            return $this->errorResponse('Application not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'sometimes|in:pending,accepted,rejected',
            'napomena' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $prijava->update($request->only(['status', 'napomena']));

        return $this->successResponse($prijava->load('oglas.kompanija'), 'Application updated successfully');
    }

    /**
     * Delete an application
     * DELETE /api/prijave/{id}
     * Requires authentication
     */
    public function destroy(Request $request, $id)
    {
        $prijava = Prijava::find($id);

        if (!$prijava) {
            return $this->errorResponse('Application not found', 404);
        }

        // Only allow deletion by the applicant
        if ($prijava->korisnik_id !== $request->user()->id) {
            return $this->errorResponse('Unauthorized', 403);
        }

        $prijava->delete();

        return $this->successResponse(null, 'Application deleted successfully');
    }

    /**
     * Get all applications for a specific job listing (for company/admin)
     * GET /api/oglasi/{id}/prijave
     * Requires authentication
     */
    public function zaOglas(Request $request, $oglasId)
    {
        $prijave = Prijava::with('korisnik')
            ->where('oglas_id', $oglasId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $this->successResponse($prijave, 'Applications for job listing retrieved successfully');
    }
}
