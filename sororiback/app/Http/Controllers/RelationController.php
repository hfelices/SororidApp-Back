<?php

namespace App\Http\Controllers;

use App\Models\Relation;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relations = Relation::all();
        if ($relations) {
            return response()->json([
                'success' =>true,
                'data' =>$relations,
            ],200);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error al listar las relaciones',
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_1' => 'required|exists:users,id',
            'user_2' => 'required|exists:users,id',
            'type' => 'required',
            'status' => 'required'
        ]);

        $relation = Relation::create($request->all());
        if ($relation){
            return response()->json([
                'success' =>true,
                'data' => $relation
            ], 201);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error al crear la relación',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $relation = Relation::find($id);
        if ($relation) {
            return response()->json([
                'success' => true,
                'data' => $relation,
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
    public function update(Request $request, Relation $relation)
    {
        $request->validate([
            'user_1' => 'exists:users,id',
            'user_2' => 'exists:users,id',
            'type' => 'required'
        ]);

        $relation->update($request->all());
        return response()->json(['relation' => $relation], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $relation = Relation::find($id);

        if ($relation) {
            $relation->delete();
            return response()->json([
                'success' => true,
                'data' => $relation,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Localización no encontrada',
            ], 404);
        }
    }
}
