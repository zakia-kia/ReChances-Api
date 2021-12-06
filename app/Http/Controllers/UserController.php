<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Str;
use App\Models\Product;

class UserController extends Controller
{
    public function registerUser(Request $request) {
        $data = $request->only(['name','email','phone_number','password']);
        $validator = Validator::make (
            $data,
            [
                'name' => 'required|string|max:100',
                'email' =>'required|string|unique:users,email',
                'phone_number' => 'required|string',
                'password' => 'required|string|min:5'
            ]);

            if ($validator->fails()) {
                $error = $validator->errors();
                return response()->json(compact('error'), 401);
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->password = Hash::make($request->password);
            $user->save();

            $status = 'success regiser user';
            return response()->json(compact('user','status'), 200);
    }

    public function getUser($id) {
        $user = User::find($id);
        return response()->json(compact('user'), 200);
    }

    public function loginUser (Request $request) {
        $user = User::where('email',$request['email'])->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = Str::random(60);
            $user->remember_token = $token;
            $user->save();

            return response()-> json([
                'status' => 200,
                'message' =>'success',
                'token' => $token,
                'user' => $user
            ],200);
        }

        return response()-> json([
                'status' => 401,
                'message' =>'failed'
            ],401);
    }

    public function logoutUser(Request $request) {

        $user = User::where('remember_token', $request->bearerToken())->first();

        if ($user) {
            $user->remember_token = null;
            $user->save();

            return response()->json([
                'status'=> 200,
                'message' => 'success'
            ],200);
        }

        return response()->json([
            'status' => 401,
            'message' => 'failed'
        ],401);

    }

    public function updateUser (Request $request, $id) {
            $user = User::find($id);
            $data = $request->all();

            if (asset($request->name)) {
                $user->name = $data['name'];
            }

            if (asset($request->email)) {
                $user->email = $data['email'];
            }

            if (asset($request->phone_number)) {
                $user->phone_number = $data['phone_number'];
            }

            if (asset($request->password)) {
                $user->password = Hash::make ($data['password']);
            }

            $user->save();
            return response()->json(compact('user'),200);
        }
}
