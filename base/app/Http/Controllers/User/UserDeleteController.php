<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDeleteController extends Controller
{
    /**
     * Soft delete the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        User::findOrFail(AppHelper::openDecrypt($request->id))->delete();

        return redirect()->route('user.list')
                        ->with('success', 'User soft deleted successfully!');
    }

    /**
     * Display a listing of soft-deleted users.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        return view('user.trashed', [
            'trashedUsers' => User::onlyTrashed()->get()
        ]);
    }


    /**
     * Restore the specified soft-deleted user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        // dd(AppHelper::openDecrypt($request->id));
        // $user->restore();
        User::withTrashed()->findOrFail(AppHelper::openDecrypt($request->id))->restore();

        return redirect()->route('user.trashed')
                        ->with('success', 'User restored successfully!');
    }

    /**
     * Permanently delete the specified user (force delete).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Request $request)
    {
        // $user->forceDelete();
        User::withTrashed()->findOrFail(AppHelper::openDecrypt($request->id))->forceDelete();

        return redirect()->route('user.trashed')
                        ->with('success', 'User permanently deleted!');
    }
}
