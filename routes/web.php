<?php

use App\Http\Controllers\BallotController;
use App\Http\Livewire\ControlAct\CreateControlAct;
use App\Http\Livewire\ControlAct\EditControlAct;
use App\Http\Livewire\ControlAct\PaimentControlAct;
use App\Http\Livewire\ControlAct\ShowControlAct;
use App\Http\Livewire\InspectionAct\CreateInspection;
use App\Http\Livewire\InspectionAct\EditInspection;
use App\Http\Livewire\InspectionAct\PaimentInspection;
use App\Http\Livewire\InspectionAct\ShowInspections;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('redirect');
})->name('dashboard');

Route::get('/actas-de-fiscalizacion', ShowInspections::class)->name('actasDeFiscalizacion.show')->middleware('auth');
Route::get('/acta-de-fiscalizacion/create', CreateInspection::class)->name('actasDeFiscalizacion.create')->middleware('auth');
Route::get('/actas-de-fiscalizacion/{inspection}/edit', EditInspection::class)->name('actasDeFiscalizacion.edit')->middleware('auth');

Route::get('/actas-de-control', ShowControlAct::class)->name('actasDeCotrol.show')->middleware('auth');
Route::get('/acta-de-control/create', CreateControlAct::class)->name('actasDeCotrol.create')->middleware('auth');

Route::get('/pago-acta-fiscalizacion/{inspection}', PaimentInspection::class)->name('actasDeFiscalizacion.paiment')->middleware('auth');
Route::get('/pago-acta-control/{controlAct}', PaimentControlAct::class)->name('actasDeCotrol.paiment')->middleware('auth');
