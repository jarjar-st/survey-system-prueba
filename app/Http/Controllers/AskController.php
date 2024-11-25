<?php

namespace App\Http\Controllers;

use App\Models\Ask;
use Illuminate\Http\Request;
use App\Exports\AskReportExport;
use Maatwebsite\Excel\Facades\Excel;

class AskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Ask::all();
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
    public function store(Request $request)
    {
        $request->validate(([
            'description' => 'required|max:150',
        ]));

        $ask = Ask::create($request->all());

        return response()->json(['message' => 'La pregunta sea creado con exito', 'data' => $ask], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ask $ask)
    {
        return $ask;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ask $ask)
    {
        if ($ask->answers()->exists()) {
            return response()->json(['error' => 'No se pudo actualizar la pregunta'], 400);
        }

        $request->validate([
            'description' => 'required|max:150',
        ]);

        $ask->update($request->all());

        return response()->json(['message' => 'La pregunta ha sido actualizada', 'data' => $ask], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ask $ask)
    {
        if ($ask->answers()->exists()) {
            return response()->json(['error' => 'Ocurrio un error al intentar borrar la pregunta'], 400);
        }

        $ask->delete();

        return response()->json(['message' => 'La pregunta se ha borrado de manera correcto'], 200);
    }

    public function generateReport($id)
    {
        // Verifica que la pregunta exista
        $ask = Ask::find($id);

        if (!$ask) {
            return response()->json(['error' => 'Pregunta no encontrada'], 404);
        }

        // Genera y descarga el reporte en Excel
        return Excel::download(new AskReportExport($id), 'ask_report.xlsx');
    }
}
