<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Warning;
use App\Models\User;
use App\Models\Profile;
use App\Models\Relation;
use App\Models\RoutePartner;
use DateTime;

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
            'coordinates_lat_start' => 'required',
            'coordinates_lon_start' => 'required',
            'coordinates_lat_end' => 'required',
            'coordinates_lon_end' => 'required',
            'time_estimated' => 'required',
            'time_user_end' => 'required',
            'user' => 'required|exists:users,id',
            'share' => 'required',
        ]);
        $coordinatesLatStart = $request->input('coordinates_lat_start');
        $coordinatesLonStart = $request->input('coordinates_lon_start');
        $coordinatesLatEnd = $request->input('coordinates_lat_end');
        $coordinatesLonEnd = $request->input('coordinates_lon_end');
        if (is_null($coordinatesLatStart) || is_null($coordinatesLonStart) || is_null($coordinatesLatEnd) || is_null($coordinatesLonEnd)) {
            return response()->json([
                'success' => false,
                'message' => 'One or more required fields are missing.',
            ], 400);
        }
        $route = Route::create([
            'coordinates_lat_start' => $coordinatesLatStart,
            'coordinates_lon_start' => $coordinatesLonStart,
            'coordinates_lat_end' => $coordinatesLatEnd,
            'coordinates_lon_end' => $coordinatesLonEnd,
            'coordinates_lat_now' => $coordinatesLatStart, 
            'coordinates_lon_now' => $coordinatesLonStart, 
            'time_start' => now(),
            'time_estimated' => $request->input('time_estimated'),
            'time_user_end' => $request->input('time_user_end'),
            'user' => $request->input('user'),
            'share' => $request->input('share'),
            'duration' => $request->input('duration'),
            'distance' => $request->input('distance'),
            'status' => "active",
        ]);
    
        if ($route) {
            $relatedUserIds = [];
            if ($request->share == 'first') {
                $relatedUsers = Relation::where('user_1', $request->user)
                    ->whereIn('type', ['first', 'second'])
                    ->get();
            } elseif ($request->share == 'second') {
                $relatedUsers = Relation::where('user_1', $request->user)
                    ->where('type', 'second')
                    ->get();
            } elseif ($request->share == 'extended') {
                $firstSecondRelations = Relation::where('user_1', $request->user)
                    ->whereIn('type', ['first', 'second'])
                    ->get();
    
                $blockedUsers = Relation::where('user_1', $request->user)
                    ->where('type', 'blocked')
                    ->pluck('user_2');
                $secondRelations = Relation::whereIn('user_1', $firstSecondRelations->where('type', 'second')->pluck('user_2'))
                    ->where('type', 'second')
                    ->whereNotIn('user_2', $blockedUsers)
                    ->get();
    
                $relatedUsers = $firstSecondRelations->merge($secondRelations)->unique('user_2');
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid share type, like, really?, is this a joke?.',
                ], 400);
            }
    
            foreach ($relatedUsers as $relation) {
                $relatedUserIds[] = $relation->user_2;
                $RoutePartner = RoutePartner::create([
                    'route' => $route->id,
                    'user' => $relation->user_2,
                ]);
            }
    
            return response()->json([
                'success' => true,
                'route' => $route,
                'related_users' => $relatedUserIds,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error creating route',
            ], 500);
        }
    }
    
    
    
     
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $route = Route::find($id);
        if ($route) {
            $profile = Profile::find($route->user);
            if ($profile) {
                $routePartner = RoutePartner::where('route', $route->id)
                                             ->where('user', auth()->id())
                                             ->first();
                if ($routePartner) {
                    $routePartner->update([
                        'viewed' => true,
                        'coordinates_lat_last' => $route->coordinates_lat_now,
                        'coordinates_lon_last' => $route->coordinates_lon_now,
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error finding route partner',
                    ], 404);
                }
    
                return response()->json([
                    'success' => true,
                    'route' => $route,
                    'profile' => $profile,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Error finding profile',
                ], 404);
            }
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
            $route->time_end = new Date();
            $route->save();
            $warning = new Warning();
            $warning->route = $id;
            $warning->reason = 'alert_password';
            $warning->details = 'Ha introducido la contraseña de emergencia';
            $warning->save();
            return response()->json(['message' => 'Password verified and actions taken accordingly'], 200);
        } else if (Hash::check($request->password, $user->password)){
            $route->status = 'ended';
            $route->time_end = new Date();
            $route->save();
            return response()->json(['message' => 'Password verified and actions taken accordingly'], 200);
        } else {
            return response()->json(['error' => 'Invalid password'], 401);
        }
    }

    public function explore(string $id)
    {
        $currentUser = User::find($id);
        if ($currentUser){
            $routeIds = RoutePartner::where('user', $currentUser->id)->pluck('route');
    
            $routes = Route::whereIn('id', $routeIds)
                           ->whereIn('status', ['active', 'alarm'])
                           ->get();
            if ($routes->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No routes available.',
                ], 404);
            }
            $response = $routes->map(function ($route) {
                $profile = Profile::find($route->user);
                return [
                    'route' => $route,
                    'profile' => $profile
                ];
            });
        
            return response()->json([
                'success' => true,
                'data' => $response,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
        
    }

    
}
