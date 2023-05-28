<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('edit-user', ['model' => $user]);
    }

    public function create()
    {
        return view('create-user', ['model' => new User()]);
    }
}
