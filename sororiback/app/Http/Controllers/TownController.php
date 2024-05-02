<?php

namespace App\Http\Controllers;

use App\Models\Town;
use Illuminate\Http\Request;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $towns = Town::all();
        if ($towns) {
            return response()->json([
                'success' =>true,
                'data' =>$towns,
            ],200);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error al listar las ciudades',
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
            'region' => 'required|exists:regions,id'
        ]);

        $town = Town::create($request->all());
        if ($town){
            return response()->json([
                'success' =>true,
                'data' => $town
            ], 201);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error al crear la ciudad',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $town = Town::find($id);
        if ($town) {
            return response()->json([
                'success' => true,
                'data' => $town,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al mostrar la ciudad',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Town $town)
    {
        $request->validate([
            'name' => 'required',
            'region' => 'required|exists:regions,id'
        ]);

        $town->update($request->all());
        return response()->json(['town' => $town], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $town = Town::find($id);

        if ($town) {
            $town->delete();
            return response()->json([
                'success' => true,
                'data' => $town,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ciudad no encontrada',
            ], 404);
        }
    }
}
