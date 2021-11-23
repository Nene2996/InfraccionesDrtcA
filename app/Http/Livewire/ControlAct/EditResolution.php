<?php

namespace App\Http\Livewire\ControlAct;

use App\Models\ControlAct;
use App\Models\ControlActResolution;
use App\Models\Resolution;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditResolution extends Component
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
            $date_notification_driver,
            $resolution_id_edit;

    //modal
    public  $isCreateModalOpen = false;
    public  $isUpdateModalOpen = false;

    //pivot table
    public  $control_act_resolution_id;

    protected $rules = [
        'resolution_id' => 'required',
    ];

    protected $messages = [
        'resolution_id.required' => 'Es obligatorio seleccionar una Resolución'
    ];
    
    public function mount(ControlAct $controlAct)
    {
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
        /*
        foreach($controlAct->resolutions as $resolution){
            
            $this->resolution_id = $resolution->id;
            $this->date_notification_driver = $resolution->pivot->date_notification_driver;
            $this->control_act_resolution_id = $resolution->pivot->id;
        }
        */
    }

    public function render()
    {
        $associated_resolutions = ControlAct::find($this->control_act_id)->resolutions;
        $resolutions = Resolution::all();
        $this->estado_actual = $this->controlAct->estado_actual;

        return view('livewire.control-act.edit-resolution', ['associated_resolutions' => $associated_resolutions, 'resolutions' => $resolutions]);
    }

    public function getResolutionProperty()
    {
        return Resolution::find($this->resolution_id); 
    }

    public function createResolution()
    {
        $this->isCreateModalOpen = true;
        $this->resolution_id = '';
    }

    public function editResolution($resolution_id)
    {
        $this->isUpdateModalOpen = true;
        $this->resolution = Resolution::find($resolution_id);
        $this->resolution_id = $resolution_id;
        $this->resolution_id_edit = $resolution_id;

        foreach($this->resolution->controlActs as $inspection){
            $this->date_notification_driver = $inspection->pivot->date_notification_driver;
        }
        
    }

    public function saveCreateResolution()
    {
        $this->validate();
        if(!empty($this->resolution_id))
        {
            $resolution = Resolution::find($this->resolution_id); 
            $resolutionType = $resolution->type;
            $resolutionName = $resolution->title;
            $data = [];
            
            $exists = $this->existsResolution();

            if($exists){
                if($resolutionType == 'RESOLUCIÓN DE SANCION'){

                    $tomorrow = Carbon::tomorrow('America/Lima');
                    $date_limit = $tomorrow->subYear()->format('d-m-Y');
        
                    $rules = $this->rules;
                    $messages = $this->messages;
        
                    $rules['date_notification_driver'] = 'required|before:tomorrow';
                    $messages['date_notification_driver.required'] = 'Es obligatorio ingresar la fecha de notificación al infractor';
                    $messages['date_notification_driver.before'] = 'La notificacion al infractor debe ser una fecha anterior a: '.$date_limit;
                    $this->validate($rules, $messages);
        
                    $data['date_notification_driver'] = $this->date_notification_driver;
        
                    $this->controlAct->estado_actual = 'PENDIENTE DE PAGO';
                    $this->controlAct->save();
        
                }elseif($resolutionType == 'RESOLUCIÓN DE NULIDAD'){
        
                    $data['date_notification_driver'] = null;
                    $this->controlAct->estado_actual = 'ANULADO MEDIANTE '.$resolutionName;
                    $this->controlAct->save();
        
                }else{
        
                    $data['date_notification_driver'] = null;
                    $this->controlAct->estado_actual = 'PRESCRITA MEDIANTE '.$resolutionName;
                    $this->controlAct->save();
                }

                $data['control_act_id'] = $this->control_act_id;
                $data['resolution_id'] = $this->resolution_id;
                $resolution->controlActs()->attach($this->control_act_id, $data);
                $this->isCreateModalOpen = false;
                $this->resetInput();
            }else{
                $this->addError('exists_resolution', 'La resolucion que ha seleccionado ya fue asociada anteriormente.');
            } 
        }
    }

    public function saveUpdateResolution()
    {
        
        $this->validate();
        if(!empty($this->resolution_id))
        {
            $rules = $this->rules;
            $messages = $this->messages;

            $resolution = Resolution::find($this->resolution_id); 
            $resolutionType = $resolution->type;
            $resolutionName = $resolution->title;
            $data = [];
            

            $rules['resolution_id'] = Rule::unique('control_act_resolution', 'resolution_id')->ignore($this->resolution_id_edit, 'resolution_id');
            $messages['resolution_id.unique'] = 'La resolucion que ha seleccionado ya fue asociada anteriormente.';

            $this->validate($rules, $messages);
            
            if($resolutionType == 'RESOLUCIÓN DE SANCION'){

                $tomorrow = Carbon::tomorrow('America/Lima');
                $date_limit = $tomorrow->subYear()->format('d/m/Y');

                $rules['date_notification_driver'] = 'required|before:tomorrow';
                $messages['date_notification_driver.required'] = 'Es obligatorio ingresar la fecha de notificación al infractor';
                $messages['date_notification_driver.before'] = 'La notificacion al infractor debe ser una fecha anterior a: '.$date_limit;

                $this->validate($rules, $messages);

                $data['date_notification_driver'] = $this->date_notification_driver;

                $this->controlAct->estado_actual = 'PENDIENTE DE PAGO';
                $this->controlAct->save();

            }elseif($resolutionType == 'RESOLUCIÓN DE NULIDAD'){

                $data['date_notification_driver'] = null;
                $this->controlAct->estado_actual = 'ANULADO MEDIANTE '.$resolutionName;
                $this->controlAct->save();

            }else{

                $data['date_notification_driver'] = null;
                $this->controlAct->estado_actual = 'PRESCRITA MEDIANTE '.$resolutionName;
                $this->controlAct->save();
            }
            
            $index = $this->getIdResolutions();
            $data['created_at'] = $this->created_at;
            $index[$this->resolution_id] = $data;

            $this->controlAct->resolutions()->sync($index);

            $this->closeUpdateModal();

        }
    }

    public function deleteResolution($resolution_id)
    {
        $resolution = Resolution::find($resolution_id);
        if( $resolution ){
            $resolution->controlActs()->detach($this->control_act_id);
            $this->resolution_id = '';
        }
        
    }
    private function getIdResolutions()
    {
        $datas = [];

        foreach($this->controlAct->resolutions as $resolution){
            $data = [];
            $data['date_notification_driver'] = $resolution->pivot->date_notification_driver;
            $data['created_at'] = $resolution->pivot->created_at;
            $datas[$resolution->id] = $data;

        }

        $value = $datas[intval($this->resolution_id_edit)];
        $this->created_at = $value['created_at'];
        unset( $datas[intval($this->resolution_id_edit)] );
        
        return $datas;
    }

    public function closeCreateModal()
    {
        $this->isCreateModalOpen = false;
        $this->resetInput();
    }

    public function closeUpdateModal()
    {
        $this->isUpdateModalOpen = false;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->resolution_id = '';
        $this->date_notification_driver = '';
        $this->resetValidation();
    }

    public function existsResolution()
    {
        $exists = ControlActResolution::where('resolution_id', $this->resolution_id)
                ->where('control_act_id', $this->control_act_id)
                ->exists();

        return !$exists; 
    }
}
