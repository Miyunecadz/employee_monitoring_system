<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5)->through(function ($user){
            return [
                'id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role,
            ];
        });

        return Inertia::render('User/Index',['users' => $users]);
    }

    public function filter(Request $request)
    {
        if(!$request->keyword)
        {
            return Redirect::route('users');
        }

        $users = User::where('firstname','LIKE', "%{$request->keyword}%")
                        ->orWhere('lastname','LIKE', "%{$request->keyword}%")
                        ->orWhereRaw("concat(firstname,' ',lastname)=?",$request->keyword)
                        ->orWhereRaw("concat(lastname,' ',firstname)=?",$request->keyword)
                        ->orWhere('username','LIKE', "%{$request->keyword}%")
                        ->orWhere('email','LIKE', "%{$request->keyword}%")
                        ->orWhere('role', $request->keyword)
                        ->paginate(10);

        return Inertia::render('User/Index',['users' => $users, 'isFiltered' => true]);
    }

    public function create()
    {
        return Inertia::render('User/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string',
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'firstname' => Str::title($request->firstname),
            'lastname' => Str::title($request->lastname),
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return Redirect::route('users');
    }
}
