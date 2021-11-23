<?php

namespace App\Http\Controllers\InspectionAct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    // function to display preview
    public function preview()
    {
        $url = Storage::url('app/public/xEp5dfVrnCSqij2lIXRPSLCjMKb7mMM4uVW3aHWD.pdf');
        return response()->file($url);
       
    }

    public function generatePDF()
    {
        $filePath = public_path('storage/PDF031.pdf');
        
        $url = Storage::url('app/public/ResolucionesNulidad/PDF031.pdf');
    	$headers = ['Content-Type: application/pdf'];
    	$fileName = time().'.pdf';

    	return response()->download($url, $fileName, $headers);
    }
}
