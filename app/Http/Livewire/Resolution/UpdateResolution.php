<?php

namespace App\Http\Livewire\Resolution;

use App\Models\Resolution;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateResolution extends Component
{
    use WithFileUploads; 

    public $resolution, $resolution_id, $type_resolution = '', $title, $date_resolution, $url_path, $folderName, $size, $iteration;

    protected $rules = [
        'title' => 'required',
        'date_resolution' => 'required',
        'type_resolution' => 'required',
        'url_path' => 'required|mimes:pdf|max:5120', // 5MB Max
    ];

    protected $messages = [
        'title.required' => 'Es obligatorio ingresar el titulo de la resolucion.',
        'date_resolution.required' => 'Es obligatorio ingresar la fecha de la resolucion.',
        'type_resolution.required' => 'Es obligatorio seleccionar una resolucion.',
        'url_path.required' => 'Es obligatorio seleccionar un archivo pdf',
        'url_path.mimes' => 'El archivo seleccionado debe ser de tipo: pdf.',
        'url_path.max' => 'El archivo pdf no debe pesar más de 5MB'
    ];

    public function mount(Resolution $resolution)
    {
        
        $this->resolution = $resolution;
        $this->resolution_id = $resolution->id;
        $this->title = $resolution->title;
        $this->type_resolution = $resolution->type;
        $this->date_resolution = $resolution->date_resolution;
        $this->url_path = $resolution->url;
        $this->size = $resolution->size;
        
    }
    public function render()
    {
        return view('livewire.resolution.update-resolution');
    }

    public function updateToServer()
    {
        $rules = $this->rules;
        $messages = $this->messages;
        
        $resolution = Resolution::find($this->resolution_id);
        $type_resolution = $resolution->type;
        $url_path = $resolution->url;
        $url = Storage::url($url_path);
        $storageName = basename($url);
        
        $data = [];

        //detectar si cambia de tipo de resolucion
        if( $this->type_resolution == $type_resolution ){
            dd($this->url_path);
            if(Storage::exists( $this->url_path )){
                
                $data['url'] = $this->url_path;
                $data['size'] = $this->size;
            }else{

                if( $this->type_resolution == 'RESOLUCIÓN DE SANCION' ){
                    $fileName = $this->url_path->storeAs('public/ResolucionesSancion', $this->url_path->getClientOriginalName());
                }elseif( $this->type_resolution == 'RESOLUCIÓN DE NULIDAD' ){
                    $fileName = $this->url_path->storeAs('public/ResolucionesNulidad', $this->url_path->getClientOriginalName());
                }elseif( $this->type_resolution == 'RESOLUCIÓN DE PRESCRIPCION' ){
                    $fileName = $this->url_path->storeAs('public/ResolucionesPrescripcion', $this->url_path->getClientOriginalName());
                }
                $data['url'] = $fileName;
                $data['size'] = $this->url_path->getSize();
                Storage::delete($url_path);
            }  
        }else{ // obligatoriamente se va mover el archivo pdf
            if( $this->type_resolution == 'RESOLUCIÓN DE SANCION' ){

                if(Storage::exists( $this->url_path )){
                    $data['url'] = 'public/ResolucionesSancion/' . $storageName;
                    $data['size'] = $this->size;
                    if(Storage::exists( $data['url'] )){
                        $data['url'] = $url_path;
                    }else{
                        Storage::move($url_path, 'public/ResolucionesSancion/'.$storageName);
                    }

                }else{
                    dd();
                    $fileName = $this->url_path->storeAs('public/ResolucionesSancion', $this->url_path->getClientOriginalName());
                    $data['url'] = $fileName;
                    $data['size'] = $this->url_path->getSize();
                    Storage::delete($url_path);
                }  
            }elseif( $this->type_resolution == 'RESOLUCIÓN DE NULIDAD' ){

                if(Storage::exists( $this->url_path )){
                    $data['url'] = 'public/ResolucionesNulidad/' . $storageName;
                    $data['size'] = $this->size;
                    if(Storage::exists( $data['url'] )){
                        $data['url'] = $url_path;
                    }else{
                        Storage::move($url_path, 'public/ResolucionesNulidad/'.$storageName);
                    }
                }else{
                    $fileName = $this->url_path->storeAs('public/ResolucionesNulidad/', $this->url_path->getClientOriginalName());
                    $data['url'] = $fileName;
                    $data['size'] = $this->url_path->getSize();
                    Storage::delete($url_path);
                }  
            }elseif( $this->type_resolution == 'RESOLUCIÓN DE PRESCRIPCION' ){

                if(Storage::exists( $this->url_path )){
                    $data['url'] = 'public/ResolucionesPrescripcion/' . $storageName;
                    $data['size'] = $this->size;
                    if(Storage::exists( $data['url'] )){
                        $data['url'] = $url_path;
                    }else{
                        Storage::move($url_path, 'public/ResolucionesPrescripcion/'.$storageName);
                    }
                }else{
                    $fileName = $this->url_path->storeAs('public/ResolucionesPrescripcion/', $this->url_path->getClientOriginalName());
                    $data['url'] = $fileName;
                    $data['size'] = $this->url_path->getSize();
                    Storage::delete($url_path);
                }  
            }
        }
        $data['title'] = $this->title;
        $data['date_resolution'] = $this->date_resolution;
        $data['type'] = $this->type_resolution;
        $resolution->fill($data);
        $saved = $resolution->save();
        if($saved)
            session()->flash('message', 'Se ha realizado correctamente la actualizacion de datos.');
            $this->clearInputs();
            $this->redirect('/resoluciones');

/*
        if( $this->type_resolution == 'RESOLUCIÓN DE SANCION' ){
            
            if(isset($this->url_path)){
                
                $fileName = $this->url_path->storeAs('public/ResolucionesSancion', $this->url_path->getClientOriginalName());
                Storage::delete($url_path);
                $data['url'] = $fileName;
                $data['size'] = $this->url_path->getSize();
                
            }else{
                $data['url'] = 'public/ResolucionesSancion/' . $storageName;
                $data['size'] = $this->size;
                if(Storage::exists( $data['url'] )){
                    $data['url'] = $url_path;
                }else{
                    Storage::move($url_path, 'public/ResolucionesSancion/'.$storageName);
                }  
            }
             
        }elseif($this->type_resolution == 'RESOLUCIÓN DE NULIDAD'){

            //si o si va existir una url_path

            if(isset($this->url_path)){
                $fileName = $this->url_path->storeAs('public/ResolucionesNulidad', $this->url_path->getClientOriginalName());
                Storage::delete($url_path);
                $data['url'] = $fileName;
                $data['size'] = $this->url_path->getSize();
               
            }else{

            }

        }elseif($this->type_resolution == 'RESOLUCIÓN DE PRESCRIPCION'){

            if(isset($this->url_path)){
                $fileName = $this->url_path->storeAs('public/ResolucionesPrescripcion', $this->url_path->getClientOriginalName());
                Storage::delete($url_path);
                $data['url'] = $fileName;
                $data['size'] = $this->url_path->getSize();
                
            }else{
                $data['url'] = 'public/ResolucionesPrescripcion/'.$storageName;
                $data['size'] = Storage::size($data['url']);
                if(Storage::exists( $data['url'] )){
                    $data['url'] = $url_path;
                }else{
                    Storage::move($url_path, 'public/ResolucionesPrescripcion/'.$storageName);
                }
            }
            
        }
        
        $data['title'] = $this->title;
        $data['date_resolution'] = $this->date_resolution;
        $data['type'] = $this->type_resolution;
        $resolution->fill($data);
        $saved = $resolution->save();

        if($saved)
            session()->flash('message', 'Se ha realizado la actualizacion de la resolucion correctamente.');
            $this->clearInputs();
            $this->redirect('/resoluciones');
*/
    }

    public function clearInputs()
    {
        $this->type_resolution = '';
        $this->title = '';
        $this->type_act = '';
        $this->date_resolution = '';
        $this->url_path = '';
        $this->size = 0;
        $this->iteration++;
    }
}
