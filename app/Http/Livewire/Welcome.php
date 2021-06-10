<?php

namespace App\Http\Livewire;

use App\Models\Ballot;
use Livewire\Component;

class Welcome extends Component
{
    public $search = '';
    public $typeSearch;
    public $isModalOpen = 0;

    public $lugar_intervencion, $nombre_razon_social, $placa_vehiculo, $origen, $destino, $nombre_conductor, $direccion_infractor, $nro_licencia, $fecha_infraccion, $hora_infraccion, $clase_categoria_licencia, $nro_tarjeta_vehicular, $manifestacion_usuario, $nro_acta, $servicio, $estado_actual, $sede_infraccion;

    public function mount()
    {
  
    }
    public function render()
    {
        
        if(($this->typeSearch == 0) && (strlen($this->search) > 5))
        {
            
            $ballots = Ballot::where('nombre_conductor', 'LIKE' , '%' . $this->search. '%')->get();
            return view('livewire.welcome', [ 'ballots' => $ballots]);
            
             
        }elseif($this->typeSearch == 1)
        {
            $ballots = Ballot::where('nro_licencia', $this->search)->get();
            return view('livewire.welcome', [ 'ballots' => $ballots]);
        }else
        {
            $ballots = Ballot::where('nro_acta', $this->search)->get();
            return view('livewire.welcome', [ 'ballots' => $ballots]);
        }
    }

    public function searchId($id){
        $ballot = Ballot::findOrFail($id);
        $this->lugar_intervencion = $ballot->lugar_intervencion;

        $this->openModalPopover();
    }

    public function resetInput()
    {
        $this->search = '';
    }

    public function show($id)
    {
        $ballot = Ballot::findOrFail($id);
        $this->lugar_intervencion = $ballot->lugar_intervencion;
        $this->nombre_razon_social = $ballot->nombre_razon_social;
        $this->origen = $ballot->origen;
        $this->destino = $ballot->destino;
        $this->nombre_conductor = $ballot->nombre_conductor;
        $this->direccion_infractor = $ballot->direccion_infractor;
        $this->nro_licencia = $ballot->nro_licencia; 
        $this->fecha_infraccion = $ballot->fecha_infraccion;
        $this->hora_infraccion = $ballot->hora_infraccion;
        $this->clase_categoria_licencia = $ballot->clase_categoria_licencia;
        $this->nro_tarjeta_vehicular = $ballot->nro_tarjeta_vehicular;
        $this->manifestacion_usuario = $ballot->manifestacion_usuario;
        $this->nro_acta = $ballot->nro_acta;
        $this->servicio = $ballot->servicio;
        $this->estado_actual = $ballot->estado_actual;
        $this->sede_infraccion = $ballot->sede_infraccion;

        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }
 
}
