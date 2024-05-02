<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        if ($users) {
            return response()->json([
                'success' =>true,
                'data' =>$users,
            ],200);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error al listar los usuarios',
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'alert_password' => 'required|min:8',
            'birthdate' => 'required|date',
            'town' => 'required|exists:towns,id',
            'gender' => 'required|in:male,female,other'
        ]);

        $user = User::create($request->all());
        if ($user){
            return response()->json([
                'success' =>true,
                'data' => $user
            ], 201);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error al crear el usuario',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json([
                'success' => true,
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al mostrar el user',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8',
            'alert_password' => 'required|boolean',
            'birthdate' => 'required|date',
            'town' => 'required|exists:towns,id',
            'gender' => 'required|in:male,female,other'
        ]);

        $user->update($request->all());
        return response()->json(['user' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json([
                'success' => true,
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User no encontrado',
            ], 404);
        }
    }
}
