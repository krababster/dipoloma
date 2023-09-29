<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{

    public function registration(Request $request){

        $responses = [];
        $errors= [];

        if(Register::where('user_login', $request->user_login)->first() || Register::where('user_email', $request->user_email)->first()) {
            if (Register::where('user_login', $request->user_login)->first()) {
                array_push($errors, 'This login is already taken');
            }
            if (Register::where('user_email', $request->user_email)->first()) {
                array_push($errors, 'This email is already taken');
            }
            return response()->json([
                "status" => false,
                "message" => $errors
            ], 404);
        }

        if($request->user_login && $request->user_password && $request->user_email) {
            $user = Register::create([
                "user_login" => $request->user_login,
                "user_password" => Hash::make($request->user_password),
                "user_email" => $request->user_email,
            ]);
            return response()->json([
                "status" => true,
                'user'=> $user
            ],200);
        }

        if(!$request->user_login ){
            $response = 'Login is can not be blank';
            array_push($responses,$response);
        }
        if(!$request->user_password){
            $response = 'Password is can not be blank';
            array_push($responses,$response);
        }
        if(!$request->user_email ){
            $response = 'Email is can not be blank';
            array_push($responses,$response);
        }

        return response()->json([
            "status"=>false,
            "message"=>$responses
        ],404);

    }

    public function login(Request $request){
        $user = Register::where('user_login',$request->user_login)->first();

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
        $user = Register::where('user_login',$request->user_login)->first();
        if(is_null($user)){
            return response()->json([
                "status"=>false
            ],401);
        }
        $user->user_token = null;
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
    public function getUsers(){
        $users = User::all();

        return response()->json($users);
    }

}
