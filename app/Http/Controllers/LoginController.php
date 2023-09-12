<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)) :
            return redirect()->to('/admin/login')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }


    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }
}
