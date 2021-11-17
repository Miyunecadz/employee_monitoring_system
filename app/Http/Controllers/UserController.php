<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        return Inertia::render('User/Index',['users' => $users]);
    }

    public function filter(Request $request)
    {
        dd($request->all());
    }
}
