<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Region::all();

        if ($regions) {
            return response()->json([
                'success' =>true,
                'data' =>$regions,
            ],200);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error listing regions',
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:regions|max:255',
        ]);

        $region = Region::create($request->all());
        if ($region){
            return response()->json([
                'success' =>true,
                'data' => $region
            ], 201);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error creating region',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $region = Region::find($id);
        if ($region) {
            return response()->json([
                'success' => true,
                'data' => $region,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error showing region :_(',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $region = Region::find($id);
        if($region){
            $request->validate([
                'name' => 'required',
            ]);
            $region->update([
                'name' => $request->input('name')
            ]);
            return response()->json([
                'success' => true,
                'data' => $region,
            ], 200);
        } else{
            return response()->json([
                'success'  => false,
                'message' => 'Error finding region'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {        
        $region = Region::find($id);

        if ($region) {
            $region->delete();
            return response()->json([
                'success' => true,
                'data' => $region,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Region not found',
            ], 404);
        }
    }
}
