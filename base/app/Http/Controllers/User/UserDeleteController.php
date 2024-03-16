<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDeleteController extends Controller
{
    public function destroy(Request $request)
    {

        User::findOrFail(AppHelper::openDecrypt($request->id))->delete();

        return redirect()->route('user.list')
                        ->with('success', 'User soft deleted successfully!');
    }

    public function trashed()
    {
        return view('user.trashed', [
            'trashedUsers' => User::onlyTrashed()->get()
        ]);
    }

    public function restore(Request $request)
    {
        User::withTrashed()->findOrFail(AppHelper::openDecrypt($request->id))->restore();

        return redirect()->route('user.trashed')
                        ->with('success', 'User restored successfully!');
    }

    public function forceDelete(Request $request)
    {
        User::withTrashed()->findOrFail(AppHelper::openDecrypt($request->id))->forceDelete();

        return redirect()->route('user.trashed')
                        ->with('success', 'User permanently deleted!');
    }
}
