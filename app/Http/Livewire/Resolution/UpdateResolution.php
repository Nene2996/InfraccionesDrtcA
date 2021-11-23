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
        $url_path = $resolution->url;
        $url = Storage::url($url_path);
        $storageName = basename($url);
        
        $data = [];

        if( $this->type_resolution == 'RESOLUCIÓN DE SANCION' ){
            
            if(isset($this->url_path)){
                
                $fileName = $this->url_path->storeAs('public/ResolucionesSancion', $this->url_path->getClientOriginalName());
                Storage::delete($url_path);
                $data['url'] = $fileName;
                $data['size'] = $this->url_path->getSize();
                
            }else{
                $data['url'] = 'public/ResolucionesSancion/'.$storageName;
                $data['size'] = $this->size;
                if(Storage::exists( $data['url'] )){
                    $data['url'] = $url_path;
                }else{
                    Storage::move($url_path, 'public/ResolucionesSancion/'.$storageName);
                }  
            }
             
        }elseif($this->type_resolution == 'RESOLUCIÓN DE NULIDAD'){

            if(isset($this->url_path)){
                $fileName = $this->url_path->storeAs('public/ResolucionesNulidad', $this->url_path->getClientOriginalName());
                Storage::delete($url_path);
                $data['url'] = $fileName;
                $data['size'] = $this->url_path->getSize();
               
            }else{
                $data['url'] = 'public/ResolucionesNulidad/'.$storageName;
                $data['size'] = $this->size;
                if(Storage::exists( $data['url'] )){
                    $data['url'] = $url_path;
                }else{
                    Storage::move($url_path, 'public/ResolucionesNulidad/'.$storageName);
                }
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
    }

    public function clearInputs()
    {
        $this->type_resolution = '';
        $this->title = '';
        $this->type_act = '';
        $this->date_resolution = '';
        $this->url_path = null;
        $this->size = 0;
        $this->iteration++;
    }
}
