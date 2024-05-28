<?php

namespace App\Http\Controllers;

use App\Models\RoutePartner;
use Illuminate\Http\Request;

class RoutePartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routePartners = RoutePartner::all();
        if ($routePartners) {
            return response()->json([
                'success' =>true,
                'data' =>$routePartners,
            ],200);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error listing RoutePartners',
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'route' => 'required|exists:routes,id',
            'user' => 'required|exists:users,id'
        ]);

        $routePartner = RoutePartner::create($request->all());
        if ($routePartner){
            return response()->json([
                'success' =>true,
                'data' => $routePartner
            ], 201);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error creating RoutePartner',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $routePartner = RoutePartner::find($id);
        if ($routePartner) {
            return response()->json([
                'success' => true,
                'data' => $routePartner,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Error showing RoutePartner, oh no, you are going alone aren't you",
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $routePartner = RoutePartner::find($id);
        if($routePartner){
            $request->validate([
                'route' => 'exists:routes,id',
                'user' => 'exists:users,id'
            ]);
            $routePartner->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $routePartner,
            ], 200);
        } else{
            return response()->json([
                'success'  => false,
                'message' => 'Error finding routePartner'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $routePartner = RoutePartner::find($id);

        if ($routePartner) {
            $routePartner->delete();
            return response()->json([
                'success' => true,
                'data' => $routePartner,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'routePartner not found',
            ], 404);
        }
    }
}
