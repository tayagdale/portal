<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permissions::all();
        return response()->json(['success' => true, 'data' => $permissions]);
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'permission_name' => 'required|string|min:3|max:20',
            // Add validation rules for other attributes as needed
        ]);


        $permission = Permissions::create($validatedData);

        $newpermission = Permissions::find($permission->id);

        return response()->json(['success' => true, 'data' => $newpermission]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permissions $permissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permissions $permissions)
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
            'permission_name' => 'required|string|min:3|max:20',
            // Add validation rules for other attributes as needed
        ]);

        $permission = Permissions::find($id);

        if (!$permission) {
            return response()->json(['error' => 'Permission not found.'], 404);
        }

        $permission->permission_name = $request->input('permission_name');

        $permission->save();

        return response()->json(['message' => 'Permission updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permissions::find($id);

        if (!$permission) {
            return response()->json(['error' => 'Permission not found.'], 404);
        }

        $permission->delete();

        return response()->json(['message' => 'Permission deleted successfully.']);
    }
}
