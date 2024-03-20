<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserViewController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('user.view', [
            'users' => User::all()
        ]);
    }
}
