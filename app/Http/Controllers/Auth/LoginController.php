<?php

namespace App\Http\Controllers\Auth;

use App\Models\PasswordResets;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class LoginController extends Controller {

    public function login() {
        if (Auth::check()) {
            return redirect('/');
        }
    }

    public function authenticate(Request $request) {
        $remember = $request->request->get('remember');


        $userdata = array(
            'name' => $request->get('email') ,
            'password' => $request->get('password')
        );

        if (Auth::attempt($userdata)) {
            $request->session()->regenerate();
            return redirect()->intended('/list_beer');
        }
        return back();
    }



    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
