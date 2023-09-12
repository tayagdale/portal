<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\PermissionToRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function get_unassigned(string $id)
    {
        $unassignedPermissions = DB::table('permissions')
            ->select('permission_name', 'id')
            ->whereNotIn('id', function ($query) use ($id) {
                $query->select('permission_id')
                    ->from('permission_to_roles')
                    ->join('permissions', 'permission_to_roles.permission_id', '=', 'permissions.id')
                    ->where('permission_to_roles.role_id', $id);
            })
            ->get();
        return response()->json(['success' => true, 'data' => $unassignedPermissions]);
    }

    public function get_current(string $id)
    {

        $current_permission = DB::table("permission_to_roles")
            ->select(array('permission_to_roles.*', 'permission_name'))
            ->leftJoin("permissions", "permission_to_roles.permission_id", "=", "permissions.id")
            ->where('role_id', $id)
            ->get();
        return response()->json(['success' => true, 'data' => $current_permission]);
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

    public function assign_permission(Request $request)
    {
        $selectedPermissions = $request->input('permission_ids');

        foreach ($selectedPermissions as $option) {
            // Your logic here
            DB::table('permission_to_roles')->insert([
                'role_id' => $request->input('r_id'),
                'permission_id' => $option
            ]);
        }

        return response()->json(['message' => 'Permission assigned successfully.']);
    }

    public function unassign_permission(string $id)
    {
        $permission = PermissionToRole::find($id);

        if (!$permission) {
            return response()->json(['error' => 'Permission not found.'], 404);
        }

        $permission->delete();

        return response()->json(['message' => 'Permission unassigned successfully.']);
    }
}
