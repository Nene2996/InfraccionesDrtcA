<?php

namespace App\Http\Livewire\ControlAct;

use App\Models\ControlAct;
use Livewire\Component;
use Livewire\WithPagination;

class ShowControlAct extends Component
{
    use WithPagination;

    public  $isOpendivLastName = true;

    public  $radioValue, 
            $searchvalue;

    public  $isModalShowOpen = false;

    //atributos de acta de control
    public  $nro_acta,
            $ruc_dni,  
            $razonsocial_nombre, 
            $tipo_servicio,
            $placa_vehiculo,
            $lugar_intervencion,
            $origen,
            $destino,
            $nombres_conductor,
            $nrolicencia_conductor,
            $dni_conductor,
            $clase_categoria_licencia,
            $fecha_infraccion,
            $hora_infraccion,
            $codigo_infraccion,
            $observaciones,
            $manifestacion_usuario,
            $fecha_registro_infraccion,
            $sede_infraccion,
            $cod_infraccion,
            $estado,
            $monto_pagado,
            $nro_boleta_pago,
            $fecha_pago_infraccion;

    //almacenar los pagos asociados
    public  $paiments;
    public $cant = 10;

    public  $placeholder_search;

    protected $rules = [];
    protected $messages = [];

    public function updatingSearchName()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->radioValue = 0;
        $this->isOpendivLastName = true;
    }

    public function render()
    {
        $rules = $this->rules;
        $messages = $this->messages;

        switch($this->radioValue){
            case 0:
                $this->placeholder_search = 'Apellidos y Nombres';
                if(strlen($this->searchvalue) > 5){
                    $controlActs = ControlAct::where('apellidos_nombres_conductor', 'LIKE' , '%' . $this->searchvalue.'%')->paginate($this->cant);
                    return view('livewire.control-act.show-control-act', ['controlActs' => $controlActs]);
                }else{
                    $controlActs = ControlAct::orderBy('numero_acta', 'asc')->paginate($this->cant);
                    return view('livewire.control-act.show-control-act', ['controlActs' => $controlActs]);
                }
                break;
            
            case 1: 
                $this->placeholder_search = 'Nro de Licencia de Conducir';
                $controlActs = ControlAct::where('nro_licencia', $this->searchvalue)->paginate($this->cant);
                return view('livewire.control-act.show-control-act', ['controlActs' => $controlActs]);
                break;

            case 2: 
                $this->placeholder_search = 'Nro de DNI';
                $controlActs = ControlAct::where('nro_dni_conductor', $this->searchvalue)->paginate($this->cant);
                return view('livewire.control-act.show-control-act', ['controlActs' => $controlActs]);
                break;

            case 3: 
                $this->placeholder_search = 'Nro de Acta de Control';
                $controlActs = ControlAct::where('numero_acta', $this->searchvalue)->paginate($this->cant);
                return view('livewire.control-act.show-control-act', ['controlActs' => $controlActs]);
                break;
        }

    }

    public function resetInput()
    {
        $this->searchvalue = '';
    }

    public function openModalShow()
    {
        $this->isModalShowOpen = true;
    }

    public function closeModalShow()
    {
        $this->isModalShowOpen = false;
    }

    public function loadControlActId($id)
    {
        $controlAct = ControlAct::findOrFail($id);
        $this->nro_acta = $controlAct->numero_acta;
        $this->ruc_dni = $controlAct->ruc_dni;
        $this->razonsocial_nombre = $controlAct->razon_social_nombre;
        $this->tipo_servicio = $controlAct->tipo_servicio;
        $this->placa_vehiculo = $controlAct->placa_vehiculo;
        $this->lugar_intervencion = $controlAct->lugar_intervencion;
        $this->origen = $controlAct->origen;
        $this->destino = $controlAct->destino;
        $this->nombres_conductor = $controlAct->apellidos_nombres_conductor;
        $this->nrolicencia_conductor = $controlAct->nro_licencia;
        $this->dni_conductor = $controlAct->nro_dni_conductor;
        $this->clase_categoria_licencia = $controlAct->clase_categoria_licencia;
        $this->fecha_infraccion = $controlAct->fecha_infraccion;
        $this->hora_infraccion = $controlAct->hora_infraccion;
        $this->observaciones = $controlAct->descripcion_infraccion;
        $this->manifestacion_usuario = $controlAct->manifestacion_usuario;
        $this->fecha_registro_infraccion = $controlAct->fecha_registro_infraccion;

        $this->sede_infraccion = $controlAct->campus->alias;

        $this->cod_infraccion = $controlAct->infractions->code;
        $this->estado = $controlAct->estado_actual;

        

        if($this->estado == 'CANCELADO'){

            $this->paiments = $controlAct->paiments;
        }
        $this->openModalShow();
    }
}
