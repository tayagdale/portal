<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Roles::all();
        return response()->json(['success' => true, 'data' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function assign(string $role_id)
    {
        $data = [
            'role_id'  => $role_id,
        ];
        return view('pages/file_maintenance/assign_permission')->with($data);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|string|min:3|max:20|unique:roles,description',
            // Add validation rules for other attributes as needed
        ]);


        $role = Roles::create($validatedData);

        $newrole = Roles::find($role->id);

        return response()->json(['success' => true, 'data' => $newrole]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the input data from the edit form
        $request->validate([
            'description' => 'required|string|min:3|max:20',
            // Add validation rules for other attributes as needed
        ]);

        $role = Roles::find($id);

        if (!$role) {
            return response()->json(['error' => 'Role not found.'], 404);
        }

        $role->description = $request->input('description');

        $role->save();

        return response()->json(['message' => 'Role updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Roles::find($id);

        if (!$role) {
            return response()->json(['error' => 'Role not found.'], 404);
        }

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully.']);
    }
}
