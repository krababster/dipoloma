<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function registration(Request $request){
        User::create([
            "user_name"=>$request->user_name,
            "user_login"=>$request->user_login,
            "user_password"=>Hash::make($request->user_password),
            "user_email"=>$request->user_email,
            "user_phone_number"=>$request->user_phone_number,
            "address_id"=>$request->address_id
        ]);

        return response()->json([
            "status"=>true
        ]);
    }

    public function login(Request $request){
        $user = User::where('user_login',$request->user_login)->first();

        if(is_null($user)){
            return response()->json([
                "status"=>false
            ],401);
        }

        if(Hash::check($request->user_password,$user->user_password)) {
            $token = Str::random(150);
            $user->user_token = $token;
            $user->save();

            return response()->json([
                "status"=>true,
                "token"=>$token
            ]);
        }else{
            return response()->json([
                "status"=>false
            ],401);
        }
    }

    public function logout(Request $request){
        $user = User::where('user_login',$request->user_login)->first();
        if(is_null($user)){
            return response()->json([
                "status"=>false
            ],401);
        }
        $user->user_token = "";
        $user->save();

        return response()->json([
            "status"=>true,
            "message"=>"User log out"
        ],200);
    }

    public function deleteUser($id){
        $delete_user = User::find($id);


        if(is_null($delete_user)){
            return response()->json([
                "status"=>false
            ],400);
        }
        $delete_user->delete();
        return response()->json([
            "status"=>true,
            "message"=>"User was deleted"
        ],200);

    }
}
