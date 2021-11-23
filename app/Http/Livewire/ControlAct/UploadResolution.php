<?php

namespace App\Http\Livewire\ControlAct;

use App\Models\ControlAct;
use App\Models\ControlActResolution;
use App\Models\Resolution;
use Livewire\Component;

class UploadResolution extends Component
{
    public  $controlAct,
            $control_act_id,
            $ruc_dni,
            $dni_conductor,
            $razon_social_nombre,
            $placa_vehiculo,
            $lugar_intervencion,
            $origen,
            $destino,
            $nombre_apellidos_conductor,
            $nro_licencia,
            $fecha_infraccion,
            $hora_infraccion,
            $clase_categoria_licencia,
            $nro_tarjeta_vehicular,
            $codigo_infraccion,
            $sancion_administrativa,
            $sancion_pecuniaria,
            $agente_infractor,
            $descripcion,
            $monto_uit,
            $observaciones_intervenido,
            $manifestacion_usuario,
            $nro_acta,
            $servicio,
            $estado_actual,
            $fecha_registro_infraccion,
            $sede_infraccion;

    public  $resolution_id = '',
            $resolutions,
            $date_notification_driver;

    protected $rules = [
        'resolution_id' => 'required',
    ];

    protected $messages = [
        'resolution_id.required' => 'Es obligatorio seleccionar una resolucion'
    ];

    public function mount(ControlAct $controlAct){

        //dd($controlAct);
        $this->controlAct = $controlAct;
        $this->control_act_id = $controlAct->id;
        $this->ruc_dni = $controlAct->ruc_dni;
        $this->dni_conductor = $controlAct->dni_conductor;
        $this->razon_social_nombre = $controlAct->razon_social_nombre;
        $this->placa_vehiculo = $controlAct->placa_vehiculo;
        $this->lugar_intervencion = $controlAct->lugar_intervencion;
        $this->origen = $controlAct->origen;
        $this->destino = $controlAct->destino;
        $this->nro_acta = $controlAct->nro_acta;
        $this->nombre_apellidos_conductor = $controlAct->nombre_apellidos_conductor;
        $this->nro_licencia = $controlAct->nro_licencia;
        $this->fecha_infraccion = $controlAct->fecha_infraccion;
        $this->hora_infraccion = $controlAct->hora_infraccion;
        $this->clase_categoria_licencia = $controlAct->clase_categoria_licencia;
        $this->estado_actual = $controlAct->estado_actual;
        $this->codigo_infraccion = $controlAct->infractions->code;
        $this->sancion_administrativa = $controlAct->infractions->administrative_sanction;
        $this->sancion_pecuniaria = $controlAct->infractions->pecuniary_sanction;
        $this->agente_infractor = $controlAct->infractions->infringement_agent;
        $this->descripcion = $controlAct->infractions->description;
        $this->monto_uit = $controlAct->infractions->monto_uit;

        $this->resolutions = Resolution::all();

    }

    public function render()
    {
        return view('livewire.control-act.upload-resolution');
    }

    public function getResolutionProperty()
    {
        return Resolution::find($this->resolution_id); 
    }

    public function uploadToServer()
    {
        if($this->resolution_id){
            
            $resolution = Resolution::find($this->resolution_id); 
            $resolutionType = $resolution->type;
            $resolutionName = $resolution->title;
        
            if($resolutionType == 'RESOLUCIÓN DE SANCION'){

                $rules = $this->rules;
                $messages = $this->messages;
    
                $rules['date_notification_driver'] = 'required';
                $messages['date_notification_driver.required'] = 'Es obligatorio ingresar la fecha de notificacion al infractor';
                $this->validate($rules, $messages);

            }elseif($resolutionType == 'RESOLUCIÓN DE NULIDAD'){

                $this->controlAct->estado_actual = 'ANULADO MEDIANTE '.$resolutionName;
                $this->controlAct->save();

            }else{

                $this->controlAct->estado_actual = 'PRESCRITA MEDIANTE '.$resolutionName;
                $this->controlAct->save();
            }

            
            ControlActResolution::create([
                'control_act_id' => $this->control_act_id,
                'resolution_id' => $this->resolution_id,
                'date_notification_driver' => $this->date_notification_driver,
                'type_act' => 'ACTA DE CONTROL',  
            ]);

            $this->resetInput();
            session()->flash('message', 'Se ha adjuntado correctamente la resolucion: '.$resolutionName.' con la Acta de Control Nº: '.$this->nro_acta);
            return redirect('/actas-de-control');
        }
    }

    public function resetInput()
    {
        $this->control_act_id = '';
        $this->resolution_id = '';
        $this->date_notification_driver = '';
    }
}
