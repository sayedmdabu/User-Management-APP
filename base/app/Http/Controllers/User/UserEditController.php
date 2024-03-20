<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use App\Models\User;

class UserEditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        return view('user.edit', [
            'user' => User::findOrFail(AppHelper::openDecrypt($id))
        ]);
    }
}
