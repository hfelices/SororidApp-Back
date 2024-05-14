<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::all();
        if ($profiles) {
            return response()->json([
                'success' => true,
                'data' => $profiles,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al listar los perfiles',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $profile = Profile::find($id);
        if ($profile) {
            return response()->json([
                'success' => true,
                'data' => $profile,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al mostrar el perfil',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = Profile::where('id_user', $id)->first();
        if ($profile) {
            $request->validate([
                'name' => 'required',
                'alert_password' => 'required',
                'birthdate' => 'required|date',
                'town' => 'required',
                'gender' => 'required|in:female,male,nonbinary',
            ]);

            $profile->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $profile,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Perfil no encontrado',
            ], 404);
        }
    }
    public function updateProfileImage(Request $request, string $id)
{
    $profile = Profile::where('id_user', $id)->first();
    if ($profile) {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:8192', 
        ]);
        $image = $request->file('profile_image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('profile-images/'.$id."/"), $imageName);
        $profile->update(['profile_img_path' => "/profile-images/".$imageName]);

        return response()->json([
            'success' => true,
            'message' => 'Imagen de perfil actualizada correctamente',
            'data' => $profile,
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Perfil no encontrado',
        ], 404);
    }
}
}
