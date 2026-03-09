<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(request $request)
    {
        $date = Carbon::today()->subYears(6)->toDateString();

        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['max:255', 'string'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'max:255', 'confirmed'],
            'date_of_birth' => ["before:$date"],
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
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'token' => $request->token,

        ]);

        return response()->json(["user"=>$user], 201);
    }
}
