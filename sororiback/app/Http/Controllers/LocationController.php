<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        if ($locations) {
            return response()->json([
                'success' =>true,
                'data' =>$locations,
            ],200);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error listing Locations',
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
            'coordinates' => 'required',
            'user' => 'required|exists:users,id'
        ]);

        $location = Location::create($request->all());
        if ($location){
            return response()->json([
                'success' =>true,
                'data' => $location
            ], 201);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Errior at creating location',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::find($id);
        if ($location) {
            return response()->json([
                'success' => true,
                'data' => $location,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error showing Location',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $location = Location::find($id);
        if($location){
            $request->validate([
                'name' => 'required',
                'coordinates' => 'required',
                'user' => 'required|exists:users,id'
            ]);
            $location->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $location,
            ], 200);
        } else{
            return response()->json([
                'success'  => false,
                'message' => 'Error finding location'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::find($id);

        if ($location) {
            $location->delete();
            return response()->json([
                'success' => true,
                'data' => $location,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Location not found',
            ], 404);
        }
    }
}
