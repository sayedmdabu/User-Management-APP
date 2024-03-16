<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use App\Models\User;

class UserSingleViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('user.single', [
            'user' => User::findOrFail(AppHelper::openDecrypt($request->id))
        ]);
    }
}
