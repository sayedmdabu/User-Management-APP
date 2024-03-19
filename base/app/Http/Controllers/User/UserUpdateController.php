<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
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

    public function __invoke(UpdateUserRequest $request)
    {

        // dd($request->method());
        $user = User::findOrFail(AppHelper::openDecrypt($request->id));
        // dd($user->id, $request->avatar);


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // dd($validator, $user->id, $request->avatar);

        if ($request->isMethod('PATCH'))
        {
            // dd($validator, $user->id, $request->avatar);
            try{

                //create brand

                // $brand = new Brand();

                $user->name = $request->name;
                $user->email = $request->email;

                // dd($request->avatar, $request->hasFile('avatar'));
                if($request->hasFile('avatar')){

                    $image=$request->avatar;

                    $image_name=strtolower(Str::random(10)).time().".".$image->getClientOriginalExtension();


                    $original_path = 'user/';
                    // File::makeDirectory(public_path($original_path), 0755, true, true);
                    // $original_image = public_path($original_path . $image_name);
                    // Image::make($image)->save($original_image);
                    // dd($original_image);

                    // $image=$img;
                    // $extension = $image->getClientOriginalExtension();
                    // $filename =$product->slug .'-'.time().'-'.$key.'.' . $extension;
                    // $path = public_path('assets/products/' .$slug);
                    // $path = 'assets/products/' .$product->slug;


                    // Create the folder if it doesn't exist
                    if (!file_exists($original_path)) {
                        File::makeDirectory(public_path($original_path), 0755, true, true);
                        mkdir($original_path, 0755, true);
                    }

                    $img_url = $original_path. $image_name;
                    // dd($img_url,File::makeDirectory(public_path().'system',0777,true));
                    $success = $image->move($original_path, $image_name);



                    // $request->image->move($original_image);
                    // $request->image->move(public_path('images'), $original_image);

                    $user->avatar = $img_url;

                }
                // dd($user->avatar);

                $ch = $user->save();
                // dd($ch );

                return redirect()->route('user.list')->with('success', __('Update Successfully'));

            }catch (QueryException $e){

                $error = $e->getMessage();

                return \response()->json([
                    'error' => $error,
                    'status_code' => 500
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            dd("Invalid Request");
        }

    }
}
