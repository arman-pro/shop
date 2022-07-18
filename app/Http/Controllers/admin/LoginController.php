<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', '=', $request->email)->first();

        if ($user == null) {
            return back()->with('status', 'E-mail is wrong!');
        }
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('status', 'Password is wrong!');
        }

        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            return redirect('/admin');
        } else {
            return back()->with('status', 'Something is worng!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
