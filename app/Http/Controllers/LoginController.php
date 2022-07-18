<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            // 'email' => 'required|email:rfc,dns',
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', '=', $request->email)->first();

        if ($user !== null) {
            if (Hash::check($request->password, $user->password)) {
                $credentials = $request->only('email', 'password');
                if (!Auth::attempt($credentials)) {
                    return back()->with('wrong', 'Something is worng!');
                }
            } else {
                return back()->with('pswInvalid', 'Wrong Password!');
            }
        } else {
            return back()->with('invaild', 'E-mail address not found!');
        }

        if (Gate::allows('admin')) {
            return redirect('/admin');
        }
        return redirect()->route('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('/');
    }
}
