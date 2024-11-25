<?php

namespace App\Http\Controllers;

use App\Models\Voting;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Voting::all();
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
            'user_id' => 'required|exists:users,id',
            'answer_id' => 'required|exists:answers,id',
        ]);

        if (Voting::where('user_id', $request->user_id)->where('answer_id', $request->answer_id)->exists()) {
            return response()->json(['message' => 'Ya has votado por esta respuesta'], 400);
        }

        $voting = Voting::create($request->all());

        return response()->json(['message' => 'Voto creado con exito', 'data' => $voting], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Voting $voting)
    {
        return $voting;
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function countVotesByAnswer($id)
    {
        $votesCount = Voting::where('answer_id', $id)->count();

        return response()->json(['votes' => $votesCount], 200);
    }
}
