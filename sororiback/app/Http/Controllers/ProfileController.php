<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
                'message' => 'Error listing Profiles',
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
                'message' => 'Error showing profile',
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
        $validatedData = $request->validate([
            'name' => 'required',
            'alert_password' => 'required',
            'birthdate' => 'required|date',
            'town' => 'required',
            'gender' => 'required|in:female,male,nonbinary',
        ]);

        $validatedData['alert_password'] = Hash::make($validatedData['alert_password']);

        $user = User::find($id);
        if ($user) {
            $user->update(['made_profile' => true]);
        }
        
        $profile->update($validatedData);

        return response()->json([
            'success' => true,
            'profile' => $profile,
            'user' => $user
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Profile not found :(',
        ], 404);
    }
}

    public function updateProfileImage(Request $request, string $id)
{
    $profile = Profile::where('id_user', $id)->first();
    if ($profile) {
        $request->validate([
            'profile_image' => 'required|image|mimes:raw,webp,tiff,bmp,heif,heic,dng,jpeg,png,jpg,gif|max:10240', 
        ]);
        if ($profile->profile_img_path && file_exists(public_path($profile->profile_img_path))) {
            unlink(public_path($profile->profile_img_path));
        }
        $image = $request->file('profile_image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('profile-images/'.$id."/"), $imageName);
        $profile->update(['profile_img_path' => "/profile-images/".$id."/".$imageName]);

        return response()->json([
            'success' => true,
            'message' => 'Profile image updated succesfully :)',
            'data' => $profile,
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Profile not found',
        ], 404);
    }
}
}
