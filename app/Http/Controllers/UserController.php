<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
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
            'name' => 'required|max:80',
            'id_number' => 'required|unique:users|max:15',
        ]);
        User::create($request->all());
        return response()->json(['message' => 'Usuario Creado con Exito'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user;
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
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:80',
        ]);

        $user->update(['name' => $request->name]);

        return response()->json(['message' => 'Usuario Actualizado con Exito', 'data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->votings()->exists()) {
            return response()->json(['error' => 'No se puede eliminar el usuario porque ya ha votado'], 400);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario Eliminado con Exito'], 200);
    }
}
