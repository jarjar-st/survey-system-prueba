<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Answer::all();
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
        $request->validate([
            'description' => 'required|max:150',
            'ask_id' => 'required|exists:asks,id',
        ]);

        $answer = Answer::create($request->all());

        return response()->json(['message' => 'Respuesta creada con exito', 'data' => $answer], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        return $answer;
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
    public function update(Request $request, Answer $answer)
    {
        if ($answer->votings()->exists()) {
            return response()->json(['message' => 'No se puede actualizar la respuesta porque ya tiene votos'], 409);
        }

        $request->validate([
            'description' => 'required|max:150',
        ]);

        $answer->update($request->all());

        return response()->json(['message' => 'Respuesta actualizada con exito', 'data' => $answer], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        if ($answer->votings()->exists()) {
            return response()->json(['message' => 'No se puede eliminar la respuesta porque ya tiene votos'], 409);
        }

        $answer->delete();

        return response()->json(['message' => 'Respuesta eliminada con exito'], 200);
    }
}
