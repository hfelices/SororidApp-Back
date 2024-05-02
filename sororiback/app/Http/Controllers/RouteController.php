<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

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
                'message' =>'Error al listar las rutas',
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
            'time_start' => 'required',
            'time_end' => 'required',
            'user' => 'required|exists:users,id'
        ]);

        $route = Route::create($request->all());
        if ($route){
            return response()->json([
                'success' =>true,
                'data' => $route
            ], 201);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error al crear la ruta',
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
                'message' => 'Error al mostrar la relación',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        $request->validate([
            'coordinates_start' => 'required',
            'coordinates_end' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
            'user' => 'required|exists:users,id'
        ]);

        $route->update($request->all());
        return response()->json(['route' => $route], 200);
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
                'message' => 'Ruta no encontrada',
            ], 404);
        }
    }
}
