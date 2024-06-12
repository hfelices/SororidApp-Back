<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Town;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);
        $user = User::create([
            'email' => $request->email,
            'made_profile' => false,
            'password' => Hash::make($request->password),
        ]);
        if ($user){
            $profile = Profile::create([
                'id_user' => $user->id,
                'town' => 1,
            ]);
            return response()->json([
                'success' =>true,
                'data' => ['user' =>$user, 'profile' => $profile]
            ], 201);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error creating user',
            ],500);
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email'     => 'required|email',
                'password'  => 'required',
            ]);
    
            if (Auth::attempt($credentials)) {
                $user = User::where("email", $credentials["email"])->firstOrFail();
    
                $user->tokens()->delete();
                $token = $user->createToken("authToken")->plainTextToken;
    
                $profile = Profile::where("id_user", $user->id)->firstOrFail();
    
                $town = Town::where([
                    ['id', "=", $profile->town]
                ])->firstOrFail();    
                
                return response()->json([
                    "success"   => true,
                    "authToken" => $token,
                    "tokenType" => "Bearer",
                    "user"      => $user,
                    "profile"   => $profile,
                    "town" => $town,
                ], 200);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "Invalid login credentials"
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "Invalid login " .$th
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json([
                "success"   => true,
                'message' => 'Logged out successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "Logout error:" . $th
            ], 401);
        }
    }
}
