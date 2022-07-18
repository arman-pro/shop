<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index()
    {

        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fName' => 'required|max:20|nullable',
            'lName' => 'required|nullable|max:20',
            'email' => 'required|email:rfc,dns',
            'phone' => 'numeric',
            'password' => 'min:6|max:25',
            'birthYear' => 'required',
            'birthMonth' => 'required',
            'birthDay' => 'required',
            'gender' => 'required'
        ]);

        $user = new User();
        $user->fName = $request->fName;
        $user->lName = $request->lName;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->dof = $request->birthDay . "/" . $request->birthMonth . "/" . $request->birthYear;
        $user->gender = $request->gender;
        $user->save();
        return back()->with('status', 'Registrations successfully!');
    }
}
