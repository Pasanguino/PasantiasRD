<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \stdClass;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request){
// Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'type_user_id' => 'required|interger',
            'province_id' => 'required|interger',
            'company_id' => 'required|interger',
            'company_name' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type_user_id' => $request->type_user_id,
            'province_id' => $request->province_id,
            'company_id' => $request->company_id,
            'company_name' => $request->company_name,

        ]);

        $token = $user->createToken('aut_token')->plainTextToken;

        return response()->json(['data'=>$user, 'access_token'=>$token, 'token_type'=>'Bearer']);
    }

    public function login(Request $request){
        if (!Auth::attempt($request->only('email', 'password'))){
            return response()->json(['message' => 'Unauthorized', 'login' => False], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('aut_token')->plainTextToken;
        return response()->json([
            'user' => $user->first_name,
            'accessToken' => $token,
            'token_type' => 'Bearer',
            'login' => True,
            'message' => 'Authorized'
    
        ]);
    }

    public function viewUser(){
        

        
    }
    public function logout (Request $request){
        $request->user()->tokens()->delete();
        return [
            "message" => "Tus tokens han sido borrados"
        ];
    }
}
