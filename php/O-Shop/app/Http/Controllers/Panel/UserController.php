<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view('users.index')->with([
            'users' => User::all(),
        ]);
    }


    public function update(User $user)
    {
        if ($user->isAdmin()) {
            $user->admin = null;
        } else {
            $user->admin = now();
        }

        $user->save();

        return redirect()
            ->route('users')
            ->withSuccess("User role for {$user->name} was updated.");
    }
}
