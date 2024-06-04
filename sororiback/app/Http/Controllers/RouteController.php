<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Warning;
use App\Models\User;
use App\Models\Profile;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::all();
        if ($routes) {
            return response()->json([
                'success' =>true,
                'data' =>$routes,
            ],200);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error listing routes',
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'coordinates_start' => 'required',
            'coordinates_end' => 'required',
            'time_end' => 'required',
            'user' => 'required|exists:users,id',
            'share' => 'required',
        ]);
        $route = Route::create([
            'coordinates_start' => $request->coordinates_start,
            'coordinates_end' => $request->coordinates_end,
            'time_start' => new Date,
            'time_end' => $request->time_end,
            'user' => $request->user,
            'share' => $request->share,
            'status' => "active",
        ]);
        if ($route){
            return response()->json([
                'success' =>true,
                'route' => $route
            ], 201);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error creating route',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $route = Route::find($id);
        if ($route) {
            return response()->json([
                'success' => true,
                'data' => $route,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error showing route',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $route = Route::find($id);
        if($route){
            $route->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $route,
            ], 200);
        } else{
            return response()->json([
                'success'  => false,
                'message' => 'Error finding route'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $route = Route::find($id);

        if ($route) {
            $route->delete();
            return response()->json([
                'success' => true,
                'data' => $route,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Route not found',
            ], 404);
        }
    }
    public function verifyPassword(Request $request, string $id)
    {
        $route = Route::find($id);
    
        if (!$route) {
            return response()->json(['error' => 'Route not found'], 404);
        }
        $request->validate([
            'password' => 'required',
        ]);
        $user = User::find($route->user);
        $profile = Profile::where('user_id', $user->id)->first();
        if (Hash::check($request->password, $profile->alert_password)) {
            $route->status = 'alarm';
            $route->save();
            $warning = new Warning();
            $warning->route = $id;
            $warning->reason = 'alert_password';
            $warning->details = 'Ha introducido la contraseña de emergencia';
            $warning->save();
            return response()->json(['message' => 'Password verified and actions taken accordingly'], 200);
        } else if (Hash::check($request->password, $user->password)){
            $route->status = 'ended';
            $route->save();
            return response()->json(['message' => 'Password verified and actions taken accordingly'], 200);
        } else {
            return response()->json(['error' => 'Invalid password'], 401);
        }
    }
    
}

