<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Town;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usersAll = User::all();
        foreach ($usersAll as $user) {
            $profile = Profile::where('id_user', $user->id)->first();
            $town = Town::find($profile->town);
            $users[] = ['user' => $user, 'profile' => $profile, 'town' => $town];
        }
        if ($users) {
            return response()->json([
                'success' =>true,
                'data' =>$users,
            ],200);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error listing users',
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);
        if (!$request->has('made_profile')) {
            $request->merge(['made_profile' => 'false']);
        }
        if (!$request->has('role')) {
            $request->merge(['role' => 'common']);
        }
        $user = User::create([
            'email' => $request->email,
            'made_profile' => $request->made_profile,
            'password' => Hash::make($request->password),
            'role' => $request->role,
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $profile = Profile::where([
            ["id_user", "=", $user->id]
        ])->firstOrFail();
        $town = Town::where([
            ['id', "=", $profile->town]
        ])->firstOrFail();
        if ($user) {
            return response()->json([
                'success' => true,
                'user' => $user,
                'profile' => $profile,
                'town'=>$town
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error showing user',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if($user){
            $request->validate([
                'email' => 'required|email|unique:users,email,'.$user->id,
                'password' => 'nullable|min:8',
            ]);
            $user->update($request->all());
            $profile = Profile::where([
                ["id_user", "=", $user->id]
            ])->firstOrFail();
            $town = Town::where([
                ['id', "=", $profile->town]
            ])->firstOrFail();    
            return response()->json([
                'success' => true,
                'user' => $user,
                'profile' => $profile,
                'town'=>$town
            ], 200);
        } else{
            return response()->json([
                'success'  => false,
                'message' => 'Error finding user'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $profile = Profile::where('id_user', $id)->first();

        if ($user) {
            $profile->delete();
            $user->delete();
            return response()->json([
                'success' => true,
                'data' => ['user' => $user, 'profile' => $profile],
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
    }
}
