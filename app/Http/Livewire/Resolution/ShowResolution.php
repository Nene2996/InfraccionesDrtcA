<?php

namespace App\Http\Livewire\Resolution;

use App\Models\Resolution;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ShowResolution extends Component
{
    public $showDeleteModal = false;
    public $resolution, $resolution_id, $resolution_title, $url_path;

    public function render()
    {
        $resolutions = Resolution::all();
        //dd($resolutions);
        return view('livewire.resolution.show-resolution', ['resolutions' => $resolutions]);
    }

    public function showModal(Resolution $resolution)
    {
        

        $this->showDeleteModal = true;
        $this->resolution = $resolution;
        $this->resolution_id = $resolution->id;
        $this->url_path = $resolution->url;
        $this->resolution_title = $resolution->title;

        
       
    }
    public function delete()
    {
        foreach($this->resolution->inspections as $inspection){
            $inspection->status = 'PENDIENTE DE PAGO';
        }
        
        $inspection->save();
  
        if($this->resolution)
            Storage::delete($this->url_path);
            $this->resolution->delete();
            
        $this->showDeleteModal = false;
        session()->flash('message', 'Se ha realizado la eliminacion de la Resolución correctamente.');
        
    }

    public function toReturn()
    {
        return redirect('/resoluciones');
    }
    
}
