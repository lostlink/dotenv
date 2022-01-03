<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

class RegisterByEmailOnly extends RegisteredUserController
{
    public function store(Request $request, CreatesNewUsers $creator): RegisterResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $password = Str::random(8);
        $request->request->add(
            [
                'name' => Str::before($request->email, '@'),
                'password' => $password,
                'password_confirmation' => $password,
            ]
        );

        return parent::store($request, $creator);
    }
}
