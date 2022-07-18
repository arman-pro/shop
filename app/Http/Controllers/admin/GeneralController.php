<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $title = DB::table('settings')->select('value')->where('name', '=', 'title');
        dd($title->value);
        // return view('admin.setting.index', compact('settings')); 
    }

    public function store(Request $request)
    {
    }
}
