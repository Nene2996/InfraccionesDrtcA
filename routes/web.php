<?php

use App\Exports\ControlActExport;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\UploadFileServerController;
use App\Http\Livewire\ControlAct\CreateControlAct;
use App\Http\Livewire\ControlAct\EditControlAct;
use App\Http\Livewire\ControlAct\EditResolution as ControlActEditResolution;
use App\Http\Livewire\ControlAct\ShowControlAct;
use App\Http\Livewire\Evidence\EvidenceInspectionAct;
use App\Http\Livewire\Infraction\ShowInfraction;
use App\Http\Livewire\InspectionAct\CreateInspection;
use App\Http\Livewire\InspectionAct\EditInspection;
use App\Http\Livewire\InspectionAct\EditResolution;
use App\Http\Livewire\InspectionAct\ShowInspections;
use App\Http\Livewire\Paiment\PaimentControlAct as PaimentPaimentControlAct;
use App\Http\Livewire\Paiment\PaimentInspectionAct;
use App\Http\Livewire\Reports\IndexReports;
use App\Http\Livewire\Resolution\AttachResolution;
use App\Http\Livewire\Resolution\CreateResolution;
use App\Http\Livewire\Resolution\ShowResolution;
use App\Http\Livewire\Resolution\UpdateResolution;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified', 'ipaddress', 'user_active_check'])->get('/dashboard', function () {
    //return view('dashboard');
    return view('redirect');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'registrar_infracciones', 'ipaddress', 'user_active_check'])->group(function (){
    Route::get('/acta-de-fiscalizacion/create', CreateInspection::class)->name('actasDeFiscalizacion.create');
    Route::get('/acta-de-control/create', CreateControlAct::class)->name('actasDeControl.create');

    //adjuntar medios probatorios del Acta de Control/Fiscalizacion
    Route::get('acta-de-fiscalizacion/{inspection}/adjuntar-evidencia', EvidenceInspectionAct::class)->name('actasDeFiscalizacion.evidence');
});

Route::middleware(['auth:sanctum', 'editar_infracciones', 'ipaddress', 'user_active_check'])->group(function (){
    Route::get('/actas-de-fiscalizacion/{inspection}/edit', EditInspection::class)->name('actasDeFiscalizacion.edit');
    Route::get('/actas-de-control/{controlAct}/edit', EditControlAct::class)->name('actasDeControl.edit');
});

Route::middleware([ 'auth:sanctum', 'pagar_infracciones', 'ipaddress', 'user_active_check'])->group(function (){
    //Route::get('/pago-acta-fiscalizacion/{inspection}', PaimentInspection::class)->name('actasDeFiscalizacion.paiment');

    //pago de  Acta de Control/Fiscalizacion
    Route::get('/pagar-acta-fiscalizacion/{inspection}', PaimentInspectionAct::class)->name('actaFiscalizacion.pagar');
    Route::get('/pagar-acta-control/{controlAct}', PaimentPaimentControlAct::class)->name('actaControl.pagar');
});

Route::middleware(['auth:sanctum', 'verified', 'ipaddress', 'user_active_check'])->group(function (){
    Route::get('/actas-de-fiscalizacion', ShowInspections::class)->name('actasDeFiscalizacion.show');
    Route::get('/actas-de-control', ShowControlAct::class)->name('actasDeControl.show');


    Route::get('/actas-de-fiscalizacion/modificar-resolucion/{inspection}', EditResolution::class)->name('actasDeFiscalizacion.EditarResolucion');

    Route::get('/actas-de-control/modificar-resolucion/{controlAct}', ControlActEditResolution::class)->name('actasDeControl.EditarResolucion');
    
    //Crud para resoluciones
    Route::get('/subir-resolucion', CreateResolution::class)->name('SubirResolucion');
    Route::get('/resoluciones', ShowResolution::class)->name('MostrarResoluciones');
    Route::get('/editar-resolucion/{resolution}', UpdateResolution::class)->name('EditarResolucion');
    Route::get('/adjuntar-resoluciones', AttachResolution::class)->name('AsociarResolucion');

    Route::get('tabla-de-infracciones', ShowInfraction::class)->name('MostrarTablaInfracciones');

    //Reportes 
    Route::get('reportes', IndexReports::class)->name('GenerarReportes');
});

Route::get('/excel', function () {
    //return Excel::download(new ControlActExport, 'products.xlsx');
});




