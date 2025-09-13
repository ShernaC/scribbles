<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class UserController
{
    public function userDetails()
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            return view('user.profile', compact('user'));
        }

        throw new AuthenticationException('Unauthenticated');
    }
}

