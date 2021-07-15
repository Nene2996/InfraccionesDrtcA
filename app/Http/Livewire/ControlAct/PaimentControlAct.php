<?php

namespace App\Http\Livewire\ControlAct;

use App\Models\ControlAct;
use App\Models\TypeProof;
use Livewire\Component;

class PaimentControlAct extends Component
{
    
    public $controlAct;
    public $type_proofs, $nro_acta, $nombre_apellidos, $nro_licencia, $fecha_infraccion, $codigo_infraccion, $estado_actual, $monto_uit;

    public $fecha_pago, $numero_comprobante, $monto_pagado, $usuario_id, $cajero_nombres;

    protected $rules = [
        'fecha_pago' => 'date|required',
        'numero_comprobante' => 'required',
        'monto_pagado' => 'required',
    ];

    public function mount(ControlAct $controlAct)
    {
        //dd($controlAct);
        $this->controlAct = $controlAct;

        $this->nro_acta = $controlAct->nro_acta;
        $this->nombre_apellidos = $controlAct->nombre_apellidos;
        $this->nro_licencia = $controlAct->nro_licencia;
        $this->fecha_infraccion = $controlAct->fecha_infraccion;
        $this->codigo_infraccion = $controlAct->infractions->code;
        $this->monto_uit = $controlAct->infractions->pecuniary_sanction;

        $this->estado_actual = $controlAct->estado_actual;
        $this->cajero_nombres = auth()->user()->name;

        $this->type_proofs = TypeProof::all();
    }
    public function render()
    {
        return view('livewire.control-act.paiment-control-act');
    }

    public function savePaiment()
    {
        $this->validate();

        $this->controlAct->estado_actual = 'CANCELADO';
        $this->controlAct->monto_pagado = $this->monto_pagado;
        $this->controlAct->nro_boleta_pago = $this->numero_comprobante;
        $this->controlAct->fecha_pago_infraccion = $this->fecha_pago;
        $this->controlAct->update();

        session()->flash('message', 'Se ha procesado el pago de infraccion correctamente'.$this->nro_acta);
        return redirect('/actas-de-control');
    }
}
