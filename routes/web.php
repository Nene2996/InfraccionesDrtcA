<?php

use App\Http\Controllers\BallotController;
use App\Http\Livewire\Ballot\CreateBallots;
use App\Http\Livewire\Ballot\ShowBallots;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('redirect');
})->name('dashboard');

Route::get('/papeletas', ShowBallots::class)->name('papeletas.show')->middleware('auth');
Route::get('/papeletas/create', CreateBallots::class)->name('papeletas.create')->middleware('auth');
