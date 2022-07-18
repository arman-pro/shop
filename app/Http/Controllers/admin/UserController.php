<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        $users = User::paginate();
        return view('admin.user.index', compact('users'));
    }

    public function show()
    {
        $id = request()->id;
        $user = User::find($id);
        $nSql = "SELECT MIN(id) as nextId FROM users WHERE id > $id";
        $nextId = DB::select($nSql)[0]->nextId;
        $pSql = "SELECT MAX(id) as preId FROM users WHERE id < $id";
        $preId = DB::select($pSql)[0]->preId;
        return view('admin.user.show', compact('user', 'nextId', 'preId'));
    }

    public function edit()
    {
        $id = request()->id;
        $user = User::find($id);
        $nSql = "SELECT MIN(id) as nextId FROM users WHERE id > $id";
        $nextId = DB::select($nSql)[0]->nextId;
        $pSql = "SELECT MAX(id) as preId FROM users WHERE id < $id";
        $preId = DB::select($pSql)[0]->preId;
        return view('admin.user.edit', compact('user', 'nextId', 'preId'));
    }

    public function save()
    {
        $user = User::find(request()->id);
        $user->fName = request()->fName;
        $user->lName = request()->lName;
        $user->email = request()->email;
        $user->phone = request()->phone;
        request()->dof != null ? $user->dof = request()->dof : null;
        $user->gender = request()->gender;
        $user->role = request()->role;
        $user->save();
        return back()->with('status', 'User Updated Successfully!');
    }
}
