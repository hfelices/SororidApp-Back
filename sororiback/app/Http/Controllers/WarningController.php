<?php

namespace App\Http\Controllers;

use App\Models\Warning;
use Illuminate\Http\Request;

class WarningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warnings = Warning::all();
        if ($warnings) {
            return response()->json([
                'success' =>true,
                'data' =>$warnings,
            ],200);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error al listar los warnings',
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
            'reason' => 'required|in:still_device,incomplete_route,alert_password',
            'details' => 'required'
        ]);

        $warning = Warning::create($request->all());
        if ($warning){
            return response()->json([
                'success' =>true,
                'data' => $warning
            ], 201);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error al crear el warning',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $warning = Warning::find($id);
        if ($warning) {
            return response()->json([
                'success' => true,
                'data' => $warning,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al mostrar el warning',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $warning = Warning::find($id);
        if($warning){
            $request->validate([
                'route' => 'exists:routes,id',
                'reason' => 'in:still_device,incomplete_route,alert_password',
                'details' => ''
            ]);
            $warning->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $warning,
            ], 200);
        } else{
            return response()->json([
                'success'  => false,
                'message' => 'Error finding warning'
            ], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warning = Warning::find($id);

        if ($warning) {
            $warning->delete();
            return response()->json([
                'success' => true,
                'data' => $warning,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Warning no encontrado',
            ], 404);
        }
    }
}
