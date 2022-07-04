<?php

namespace App\Http\Livewire\Resolution;

use App\Models\Campus;
use App\Models\Resolution;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;

class CreateResolution extends Component
{
    use WithFileUploads;
    public $type_resolution = '', $title, $date_resolution, $url_path, $folderName;
    public Collection $campus;
    public $campus_id = '';
    public $document_title;
    public $document_year = '';

    protected $rules = [
        'campus_id' => 'required',
        'title' => 'required',
        'date_resolution' => 'required',
        'type_resolution' => 'required',
        'url_path' => 'required|mimes:pdf|max:5120', 
        'document_title' => 'required',
        'document_year' => 'required'
    ];

    protected $messages = [
        'campus_id.required' => 'Es obligatorio seleccionar la sede.',
        'title.required' => 'Es obligatorio ingresar el titulo de la resolucion.',
        'date_resolution.required' => 'Es obligatorio ingresar la fecha de emision.',
        'type_resolution.required' => 'Es obligatorio seleccionar el tipo de resolucion.',
        'url_path.required' => 'Es obligatorio seleccionar un archivo pdf',
        'url_path.mimes' => 'El archivo seleccionado debe ser de tipo: pdf.',
        'url_path.max' => 'El archivo pdf no debe pesar más de 5MB',
        'document_title.required' => 'Es obligatorio el registro del Titulo/Nombre del informe de Sanción/Técnico',
        'document_year.required' => 'Es obligatorio el seleccionar el año de emision del informe de Sanción/Técnico'
    ];

    public function mount()
    {
        $this->campus = Campus::get();
    }

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
    }

    public function uploadToServer()
    {
        $this->validate($this->rules, $this->messages);
        
        if($this->type_resolution == 'RESOLUCIÓN DE SANCION'){;
            $this->folderName = 'public/ResolucionesSancion';
        }elseif($this->type_resolution == 'RESOLUCIÓN DE NULIDAD'){
            $this->folderName = 'public/ResolucionesNulidad';
        }elseif($this->type_resolution == 'RESOLUCIÓN DE PRESCRIPCION'){
            $this->folderName = 'public/ResolucionesPrescripcion';
        }elseif($this->type_resolution == 'RESOLUCIÓN DE IMPROCEDENCIA'){
            $this->folderName = 'public/ResolucionesImprocedencia';
        }
        $fileName = $this->url_path->storeAs($this->folderName, $this->url_path->getClientOriginalName());
        $size = $this->url_path->getSize();
        $resolution = new Resolution();
        $resolution->title = $this->title;
        $resolution->date_resolution = $this->date_resolution;
        $resolution->type = $this->type_resolution;
        $resolution->url = $fileName;
        $resolution->size = $size;
        $resolution->document_title = $this->document_title;
        $resolution->document_year = $this->document_year;
        $resolution->save();

        $this->redirect('/resoluciones');

        session()->flash('message', 'Se ha realizado el registro de la resolución: '.$this->title);
        $this->clearInputs();
    }
}
