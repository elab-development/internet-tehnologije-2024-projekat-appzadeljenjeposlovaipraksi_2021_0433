<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/users
     */
    public function index()
    {
        return new UserCollection(User::all());
    }

    /**
     * Display the specified resource.
     * GET /api/users/{user}
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/users/{id}
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'sometimes|in:user,admin,kompanija',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Samo admin moze da menja role
        if ($request->has('role') && !auth()->user()->isAdmin()) {
            return response()->json('You are not authorized to change user roles.');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('role')) {
            $user->role = $request->role;
        }
        $user->save();

        return response()->json(['User is updated successfully.', new UserResource($user)]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/users/{user}
     */
    public function destroy(User $user)
    {
        // Samo admin moze da brise korisnike
        if (!auth()->user()->isAdmin()) {
            return response()->json('You are not authorized to delete users.');
        }

        $user->delete();

        return response()->json('User is deleted successfully.');
    }
}
