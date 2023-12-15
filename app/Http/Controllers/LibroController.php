<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLibroRequest;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libros = Libro::all();

        return response()->json([
            'status' => true,
            'libros' => $libros,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLibroRequest $request)
    {
        $libro = new Libro();

        $libro->title = $request->input('title');
        $libro->description = $request->input('description');

        try {
            $libro->save();
            // Resto del código...
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => "Product Created successfully!",
            'libro' => $libro
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {
        return response()->json([
            'status' => true,
            'message' => "Mostrando libro",
            'libro' => $libro
        ], 202);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Libro $libro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        $libro->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Libro actualizado correctamente',
            'libro' => $libro
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();
        return response()->json([
            'status' => true,
            'message' => 'Libro eliminado correctamente'
        ], 200);
    }
}
