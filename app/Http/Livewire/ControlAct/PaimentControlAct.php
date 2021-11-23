<?php

namespace App\Http\Livewire\ControlAct;

use App\Models\ControlAct;
use App\Models\TypeProof;
use Carbon\Carbon;
use Livewire\Component;

class PaimentControlAct extends Component
{
    
    public  $controlAct;
    public  $type_proofs, 
            $nro_acta, 
            $nombre_apellidos_conductor, 
            $nro_licencia, 
            $dni_conductor,
            $fecha_infraccion, 
            $codigo_infraccion, 
            $estado_actual, 
            $monto_uit,
            $descuento_15_dias_resolucion;

    public  $fecha_pago, 
            $numero_comprobante, 
            $monto_pagado, 
            $usuario_id, 
            $cajero_nombres;

    public  $select_value = '';


    protected $rules = [
        'fecha_pago' => 'date|required|before:tomorrow',
        'numero_comprobante' => 'required',
        'monto_pagado' => 'required|regex:/^[0-9]+$/',
    ];


    public function mount(ControlAct $controlAct)
    {
        //dd($controlAct);
        $this->controlAct = $controlAct;

        $this->nro_acta = $controlAct->nro_acta;
        $this->nombre_apellidos_conductor = $controlAct->nombre_apellidos_conductor;
        $this->nro_licencia = $controlAct->nro_licencia;
        $this->dni_conductor = $controlAct->dni_conductor;
        $this->fecha_infraccion = $controlAct->fecha_infraccion;
        $this->codigo_infraccion = $controlAct->infractions->code;
        $this->monto_uit = $controlAct->infractions->pecuniary_sanction;
        $this->descuento_15_dias_resolucion = $controlAct->infractions->discount_fifteen_days;

        $this->estado_actual = $controlAct->estado_actual;
        $this->cajero_nombres = auth()->user()->name;

        $this->type_proofs = TypeProof::all();
    }
    public function render()
    {
        return view('livewire.control-act.paiment-control-act');
    }

    public function getPlaceholderProperty()
    {
        if($this->select_value == 0){
            return $placeholder = '0001-0050448';

        }elseif($this->select_value == 1){
            return $placeholder = '0001-0002474';

        }elseif($this->select_value == 2){
            return $placeholder = '14518573-5-M';

        }elseif($this->select_value == 3){
            return $placeholder = '210362';
        }
    }

    public function savePaiment()
    {
        $tomorrow = Carbon::tomorrow('America/Lima');
        $date_limit = $tomorrow->subYear()->format('d-m-Y');

        $messages['fecha_pago.before'] = 'La fecha de pago debe ser una fecha anterior a: '.$date_limit;
        $messages['monto_pagado.regex'] = 'El formato del campo monto pagado solo permite ingresar números válidos';
        
        $this->validate($this->rules, $messages);

        if($this->select_value == 0){
            $numero_comprobante = 'BOLETA DE VENTA Nº '.$this->numero_comprobante;

        }elseif($this->select_value == 1){
            $numero_comprobante = 'FACTURA N° '.$this->numero_comprobante;

        }elseif($this->select_value == 2){
            $numero_comprobante = 'BAUCHER BN Nº '.$this->numero_comprobante;

        }else{
            $numero_comprobante = 'BAUCHER BN Nº OPERACION: '.$this->numero_comprobante;
        }

        dd($numero_comprobante);
        $this->controlAct->estado_actual = 'CANCELADO';
        $this->controlAct->monto_pagado = $this->monto_pagado;
        $this->controlAct->nro_boleta_pago = $numero_comprobante;
        $this->controlAct->fecha_pago_infraccion = $this->fecha_pago;
        $this->controlAct->update();

        session()->flash('message', 'Se ha procesado correctamente el pago de infraccion con numero de Acta '.$this->nro_acta);
        return redirect('/actas-de-control');
    }
}
