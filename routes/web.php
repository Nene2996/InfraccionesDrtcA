<?php

use App\Http\Controllers\InspectionAct\PDFController;
use App\Http\Controllers\UploadFileServerController;
use App\Http\Livewire\ControlAct\CreateControlAct;
use App\Http\Livewire\ControlAct\EditControlAct;
use App\Http\Livewire\ControlAct\EditResolution as ControlActEditResolution;
use App\Http\Livewire\ControlAct\PaimentControlAct;
use App\Http\Livewire\ControlAct\ShowControlAct;
use App\Http\Livewire\ControlAct\UploadResolution as ControlActUploadResolution;
use App\Http\Livewire\Infraction\ShowInfraction;
use App\Http\Livewire\InspectionAct\CreateInspection;
use App\Http\Livewire\InspectionAct\EditInspection;
use App\Http\Livewire\InspectionAct\EditResolution;
use App\Http\Livewire\InspectionAct\PaimentInspection;
use App\Http\Livewire\InspectionAct\ShowInspections;
use App\Http\Livewire\InspectionAct\UploadResolution;
use App\Http\Livewire\Paiment\PaimentControlAct as PaimentPaimentControlAct;
use App\Http\Livewire\Paiment\PaimentInspectionAct;
use App\Http\Livewire\Resolution\CreateResolution;
use App\Http\Livewire\Resolution\ShowResolution;
use App\Http\Livewire\Resolution\UpdateResolution;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified', 'ipaddress'])->get('/dashboard', function () {
    return view('redirect');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'registrar_infracciones', 'ipaddress'])->group(function (){
    Route::get('/acta-de-fiscalizacion/create', CreateInspection::class)->name('actasDeFiscalizacion.create');
    Route::get('/acta-de-control/create', CreateControlAct::class)->name('actasDeControl.create');
});

Route::middleware(['auth:sanctum', 'editar_infracciones', 'ipaddress'])->group(function (){
    Route::get('/actas-de-fiscalizacion/{inspection}/edit', EditInspection::class)->name('actasDeFiscalizacion.edit');
    Route::get('/actas-de-control/{controlAct}/edit', EditControlAct::class)->name('actasDeControl.edit');
});

Route::middleware([ 'auth:sanctum', 'pagar_infracciones', 'ipaddress'])->group(function (){
    Route::get('/pago-acta-fiscalizacion/{inspection}', PaimentInspection::class)->name('actasDeFiscalizacion.paiment');

    //pago de Infracciones
    Route::get('/pagar-acta-fiscalizacion/{inspection}', PaimentInspectionAct::class)->name('actaFiscalizacion.pagar');
    Route::get('/pagar-acta-control/{controlAct}', PaimentPaimentControlAct::class)->name('actaControl.pagar');
});

Route::middleware(['auth:sanctum', 'verified', 'ipaddress'])->group(function (){
    Route::get('/actas-de-fiscalizacion', ShowInspections::class)->name('actasDeFiscalizacion.show');
    Route::get('/actas-de-control', ShowControlAct::class)->name('actasDeControl.show');

    Route::get('/actas-de-fiscalizacion/subir-resolucion/{inspection}', UploadResolution::class)->name('actasDeFiscalizacion.SubirResolucion');
    Route::get('/actas-de-fiscalizacion/modificar-resolucion/{inspection}', EditResolution::class)->name('actasDeFiscalizacion.EditarResolucion');

    Route::get('/actas-de-control/subir-resolucion/{controlAct}', ControlActUploadResolution::class)->name('actasDeControl.SubirResolucion');
    Route::get('/actas-de-control/modificar-resolucion/{controlAct}', ControlActEditResolution::class)->name('actasDeControl.EditarResolucion');
    
    Route::get('/subir-resolucion', CreateResolution::class)->name('SubirResolucion');
    Route::get('/resoluciones', ShowResolution::class)->name('MostrarResoluciones');
    Route::get('/editar-resolucion/{resolution}', UpdateResolution::class)->name('EditarResolucion');

    Route::get('tabla-de-infracciones', ShowInfraction::class)->name('MostrarTablaInfracciones');

    Route::post('subir-acta', [UploadFileServerController::class, 'store']);

    //Route::get('pdfs', [PDFController::class, 'preview'])->name('actasDeFiscalizacion.verResolucion');
    //Route::get('pdf/download', [PDFController::class, 'generatePDF'])->name('actasDeFiscalizacion.descargarResolucion');
    
});




