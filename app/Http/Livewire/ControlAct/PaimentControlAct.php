<?php

namespace App\Http\Livewire\ControlAct;

use App\Models\ControlAct;
use App\Models\TypeProof;
use Livewire\Component;

class PaimentControlAct extends Component
{
    
    public $controlAct;
    public $type_proofs, $nro_acta, $nombre_apellidos;

    public function mount(ControlAct $controlAct)
    {
        dd($controlAct);
        $this->controlAct = $controlAct;

        $this->nro_acta = $controlAct->nro_acta;
        $this->nombre_apellidos = $controlAct->nombre_apellidos;

        $this->type_proofs = TypeProof::all();
    }
    public function render()
    {
        return view('livewire.control-act.paiment-control-act');
    }
}
