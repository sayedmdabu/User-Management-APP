<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;


class UserUpdateController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(UpdateUserRequest $request, User $user)
    {

        $validatedData = $request->validated();

        if ($request->isMethod('PATCH'))
        {
            try{
                if($request->hasFile('avatar')){

                    $image=$request->avatar;
                    $image_name=strtolower(Str::random(10)).time().".".$image->getClientOriginalExtension();
                    $original_path = 'user/';

                    // Create the folder if it doesn't exist
                    if (!file_exists($original_path)) {
                        File::makeDirectory(public_path($original_path), 0755, true, true);
                        mkdir($original_path, 0755, true);
                    }

                    $img_url = $original_path. $image_name;
                    $image->move($original_path, $image_name);
                    $validatedData['avatar'] = $img_url;
                }

                $user = $this->userService->updateUser($user, $validatedData);

                return redirect()->route('user.list')->with('success', __('Update Successfully'));
            }catch (QueryException $e){
                $error = $e->getMessage();
                return \response()->json([
                    'error' => $error,
                    'status_code' => 500
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            return \response()->json([
                'error' => "Invalid Request",
                'status_code' => 500
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
