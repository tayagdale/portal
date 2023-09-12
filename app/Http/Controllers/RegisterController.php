<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserToRole;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('pages/file_maintenance/users');
    }

    public function show()
    {
        return view('pages/file_maintenance/users');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        $user_to_role = new UserToRole();
        $user_to_role->role_id = $request->input('role_id');
        $user_to_role->user_id = $user->id;
        $user_to_role->save();

        return redirect('admin/users')->with('success', "Account successfully registered.");
    }
}
