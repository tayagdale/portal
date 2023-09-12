


<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Permissions;
use Illuminate\Support\Facades\DB;

function checkPermission($user_id, $permission_id)
{

    if (!$user_id) {
        $user = Auth::user(); // Get the authenticated user
        if (!$user) {
            return false; // No authenticated user, permission denied
        }
        $user_id = $user->id;
    }

    try {
        // Check if the user has the permission
        $authorized = DB::table('PERMISSION_TO_ROLES')
            ->join('USER_TO_ROLES', 'PERMISSION_TO_ROLES.ROLE_ID', '=', 'USER_TO_ROLES.ROLE_ID')
            ->where('USER_TO_ROLES.USER_ID', $user_id)
            ->where('PERMISSION_TO_ROLES.PERMISSION_ID', $permission_id)
            ->count();

        if ($authorized > 0) {
            // User has the permission
            $authorized = true;
        } else {
            // User does not have the permission
            $authorized = false;
        }

        return $authorized;
    } catch (Exception $e) {
        // Handle exceptions if needed
        return false;
    }
}


function userRole($userID = null)
{
    if (!$userID) {
        $user = Auth::user(); // Get the authenticated user
        if (!$user) {
            return false; // No authenticated user, permission denied
        }
        $userID = $user->id;
    }
    $q = DB::table('users')
        ->select('roles.description')
        ->leftJoin('user_to_roles', 'users.id', '=', 'user_to_roles.user_id')
        ->leftJoin('roles', 'user_to_roles.role_id', '=', 'roles.id')
        ->where('users.id', $userID)
        ->first();
    if ($q) {
        return $q->description;
    }
}


?>