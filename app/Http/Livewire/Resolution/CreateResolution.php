<?php

namespace App\Http\Livewire\Resolution;

use App\Models\Resolution;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateResolution extends Component
{
    use WithFileUploads;

    public $type_resolution = '', $title, $date_resolution, $url_path, $folderName, $iteration;

    public $ip;

    protected $rules = [
        'title' => 'required',
        'date_resolution' => 'required',
        'type_resolution' => 'required',
        'url_path' => 'required|mimes:pdf|max:5120', 
    ];

    protected $messages = [
        'title.required' => 'Es obligatorio ingresar el titulo de la resolucion.',
        'date_resolution.required' => 'Es obligatorio ingresar la fecha de la resolucion.',
        'type_resolution.required' => 'Es obligatorio seleccionar una resolucion.',
        'url_path.required' => 'Es obligatorio seleccionar un archivo pdf',
        'url_path.mimes' => 'El archivo seleccionado debe ser de tipo: pdf.',
        'url_path.max' => 'El archivo pdf no debe pesar más de 5MB'
    ];

    public function render()
    {
        return view('livewire.resolution.create-resolution');
    }

    public function clearInputs()
    {
        $this->type_resolution = '';
        $this->title = '';
        $this->type_act = '';
        $this->date_resolution = '';
        $this->url_path = null;
        $this->iteration++;
    }

    public function uploadToServer()
    {
        $this->validate($this->rules, $this->messages);
        

        if( $this->type_resolution == 'RESOLUCIÓN DE SANCION'){
            $this->folderName = 'public/ResolucionesSancion';

        }elseif($this->type_resolution == 'RESOLUCIÓN DE NULIDAD'){
            $this->folderName = 'public/ResolucionesNulidad';

        }elseif($this->type_resolution == 'RESOLUCIÓN DE PRESCRIPCION'){
            $this->folderName = 'public/ResolucionesPrescripcion';
        }

        $fileName = $this->url_path->storeAs($this->folderName, $this->url_path->getClientOriginalName());
        
        $size = $this->url_path->getSize();
        
        $resolution = new Resolution();
        $resolution->title = $this->title;
        $resolution->date_resolution = $this->date_resolution;
        $resolution->type = $this->type_resolution;
        $resolution->url = $fileName;
        $resolution->size = $size;
        $resolution->save();

        $this->clearInputs();
        $this->redirect('/resoluciones');

        session()->flash('message', 'Se ha subido la resolucion correctamente.');
    }

    
}
