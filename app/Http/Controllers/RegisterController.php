<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
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

        return redirect('admin/users')->with('success', "Account successfully registered.");
    }
}
