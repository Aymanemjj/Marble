<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(request $request)
    {
        $date = Carbon::today()->subYears(6)->toDateString();
        $now = Carbon::today()->toDateString(); 

        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['max:255', 'string'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'max:255', 'confirmed'],
            'date_of_birth' => ["before:$date"],
            'date_of_death' => ["before:$now"],
            'main_medium' => ['max:255', 'exists:App\Models\Tag,name']

        ]);

        $user = User::first();
        if (is_null($user)) {
            $request['role'] = 1;
        } else {
            $request['role'] = 2;
        }
        $request['token'] = bin2hex(random_bytes(16));


        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'token' => $request->token,

        ]);
    }
}
