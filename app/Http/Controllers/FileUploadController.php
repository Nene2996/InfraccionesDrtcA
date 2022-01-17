<?php

namespace App\Http\Controllers;

use App\Models\FileEvidence;
use App\Models\Inspection;
use Illuminate\Http\Request;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function uploadLargeFiles(Request $request) {
        
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file

        
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            
            $fileName = str_replace('.'.$extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

            //Storage::disk('local');

            $inspection = Inspection::find($request->inspection_id);
            $campus = $inspection->campus->alias;
            if($extension == 'mp4'){
                $evidence_id = 1;
                $path = Storage::putFileAs('public/ActasDeFiscalizacion/ACTA-00'. $inspection->act_number . '-'. $campus. '/MEDIO_PROBATORIO/FILMICO' , $file, $fileName);
            }elseif($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                $evidence_id = 2;
                $path = Storage::putFileAs('public/ActasDeFiscalizacion/ACTA-00'. $inspection->act_number . '-'. $campus.'/MEDIO_PROBATORIO/FOTOGRAFICO' , $file, $fileName);
            }else{
                $evidence_id = 3;
                $path = Storage::putFileAs('public/ActasDeFiscalizacion/ACTA-00'. $inspection->act_number . '-'. $campus.'/MEDIO_PROBATORIO/OTROS' , $file, $fileName);
            }

            //create file_evidence
            $fileEvidence = FileEvidence::create([
                'size' => $file->getSize(),
                'url_path' => $path
            ]);

            $inspection->evidences()->attach([
                $evidence_id => ['file_evidence_id' => $fileEvidence->id]
            ]);

            // delete chunked file
            unlink($file->getPathname());

            return [
                'path' => asset('storage/' . $path),
                'filename' => $fileName,
                //'file_evidence_id' => $fileEvidence->id,
                //'evidence_id' => $evidence_id
            ];

        }
        
        // otherwise return percentage informatoin
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
}
