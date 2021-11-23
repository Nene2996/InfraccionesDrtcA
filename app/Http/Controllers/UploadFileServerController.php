<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadFileServerController extends Controller
{
    public function store(Request $request)
    {
        if($request->hasFile('file_pdf')){
            $file = $request->file('file_pdf');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('avatars/' . $folder, $filename);

            return $folder;
        }

        return '';
    }
}

