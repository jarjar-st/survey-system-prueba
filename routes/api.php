<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AskController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\VotingController;


Route::apiResource('users', UserController::class);
Route::apiResource('asks', AskController::class);
Route::apiResource('answers', AnswerController::class);
Route::apiResource('votings', VotingController::class);

Route::get('answers/{id}/votes', [VotingController::class, 'countVotes']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
