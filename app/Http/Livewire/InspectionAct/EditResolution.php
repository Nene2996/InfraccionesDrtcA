<?php

namespace App\Http\Livewire\InspectionAct;

use App\Models\Inspection;
use App\Models\InspectionActResolution;
use App\Models\Resolution;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditResolution extends Component
{
    //resolution atrib.
    public  //$resolutions,
            $resolution_id = '', 
            $date_notification_driver,
            $resolution_id_value,
            $resolution_id_edit;
            
    public  $file;

    public  $isCreateModalOpen = false;
    public  $isUpdateModalOpen = false;

    //pivot table
    public  $inspection_act_resolution_id;
    public  $created_at;

    public  $inspection,
            $inspection_act_id,
            $act_number, 
            $names_business_name, 
            $document_number, 
            $licence_number, 
            $date_infraction, 
            $code, 
            $description, 
            $infringement_agent, 
            $uit_penalty, 
            $pecuniary_sanction, 
            $administrative_sanction,  
            $status,
            $resolutions_name;

    //
    public $something = null;

    protected $rules = [
        'resolution_id' => 'required',
    ];

    protected $messages = [
        'resolution_id.required' => 'Es obligatorio seleccionar una resolución'
    ];

    public function mount(Inspection $inspection)
    {

        $this->inspection = $inspection;
        $this->inspection_act_id = $inspection->id;
        $this->act_number = $inspection->act_number;
        $this->names_business_name = $inspection->names_business_name;
        $this->document_number = $inspection->document_number;
        $this->licence_number = $inspection->licence_number;
        $this->date_infraction = $inspection->date_infraction;
        $this->code = $inspection->infraction->code;
        $this->description = $inspection->infraction->description;
        $this->infringement_agent = $inspection->infraction->infringement_agent;
        $this->uit_penalty = $inspection->infraction->uit_penalty;
        $this->pecuniary_sanction = $inspection->infraction->pecuniary_sanction;
        $this->administrative_sanction = $inspection->infraction->administrative_sanction;
        $this->status = $inspection->status;

        $this->something = 'Nene';
        $this->resolutions_name = ['au' => 'Australia', 'be' => 'Belgium', 'cn' => 'China']; 
    }

    public function render()
    {
        $associated_resolutions = Inspection::find($this->inspection_act_id)->resolutions;
        $resolutions = Resolution::all(); 
        
        $this->status = $this->inspection->status;

        return view('livewire.inspection-act.edit-resolution', ['associated_resolutions' => $associated_resolutions, 'resolutions' => $resolutions]);
    }

/*=====================================================================================*/
    public function getResolutionProperty()
    {
        return Resolution::find($this->resolution_id);

    }
    public function createResolution()
    {
        $this->isCreateModalOpen = true;
        $this->resolution_id_value = null;
        $this->resolution = null;
    }

    public function editResolution($resolution_id)
    {
        $this->isUpdateModalOpen = true;
        $this->resolution_id_value = $resolution_id;
        $this->resolution = Resolution::find($resolution_id);
        $this->resolution_id = $resolution_id;
        $this->resolution_id_edit = $resolution_id;

        foreach($this->resolution->inspections as $inspection){
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

                    $rules = $this->rules;
                    $messages = $this->messages;
    
                    $tomorrow = Carbon::tomorrow('America/Lima');
                    $date_limit = $tomorrow->subYear()->format('d-m-Y');
    
                    $rules['date_notification_driver'] = 'required|before:tomorrow';
                    $messages['date_notification_driver.required'] = 'Es obligatorio ingresar la fecha de notificación al infractor';
                    $messages['date_notification_driver.before'] = 'La notificacion al infractor debe ser una fecha anterior a: '.$date_limit;
    
                    $this->validate($rules, $messages);
    
                    $data['date_notification_driver'] = $this->date_notification_driver;
    
                    $this->inspection->status = 'PENDIENTE DE PAGO';
                    $this->inspection->save();
    
                }elseif($resolutionType == 'RESOLUCIÓN DE NULIDAD'){
    
                    $data['date_notification_driver'] = null;
                    $this->inspection->status = 'ANULADO MEDIANTE '.$resolutionName;
                    $this->inspection->save();
    
                }else{
    
                    $data['date_notification_driver'] = null;
                    $this->inspection->status = 'PRESCRITA MEDIANTE '.$resolutionName;
                    $this->inspection->save();
                }

                $data['inspection_act_id'] = $this->inspection_act_id;
                $data['resolution_id'] = $resolution->id;
                $data['type_act'] = 'ACTA DE FISCALIZACION';
                $resolution->inspections()->attach($this->inspection_act_id, $data);
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
            

            $rules['resolution_id'] = Rule::unique('inspection_act_resolution', 'resolution_id')->ignore($this->resolution_id_edit, 'resolution_id');
            $messages['resolution_id.unique'] = 'La resolucion que ha seleccionado ya fue asociada anteriormente.';
            
            $this->validate($rules, $messages);
            
            //$exists = $this->existsResolution();

            //if($exists){
                if($resolutionType == 'RESOLUCIÓN DE SANCION'){
    
                    $tomorrow = Carbon::tomorrow('America/Lima');
                    $date_limit = $tomorrow->subYear()->format('d/m/Y');
    
                    $rules['date_notification_driver'] = 'required|before:tomorrow';
                    $messages['date_notification_driver.required'] = 'Es obligatorio ingresar la fecha de notificación al infractor';
                    $messages['date_notification_driver.before'] = 'La notificacion al infractor debe ser una fecha anterior a: '.$date_limit;
    
                    $this->validate($rules, $messages);
    
                    $data['date_notification_driver'] = $this->date_notification_driver;
    
                    $this->inspection->status = 'PENDIENTE DE PAGO';
                    $this->inspection->save();
    
                }elseif($resolutionType == 'RESOLUCIÓN DE NULIDAD'){
    
                    $data['date_notification_driver'] = null;
                    $this->inspection->status = 'ANULADO MEDIANTE '.$resolutionName;
                    $this->inspection->save();
    
                }else{
    
                    $data['date_notification_driver'] = null;
                    $this->inspection->status = 'PRESCRITA MEDIANTE '.$resolutionName;
                    $this->inspection->save();
                }
                
                $index = $this->getIdResolutions();
                $data['created_at'] = $this->created_at;
                $index[$this->resolution_id] = $data;

                $this->inspection->resolutions()->sync($index);

                $this->closeUpdateModal();
            //}else{
            //    $this->addError('exists_resolution', 'La resolucion que ha seleccionado ya fue asociada anteriormente.');
            //} 
        }
    }

    private function getIdResolutions()
    {
        $datas = [];

        foreach($this->inspection->resolutions as $resolution){
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

    public function deleteResolution($resolution_id)
    {
        $resolution = Resolution::find($resolution_id);
        if( $resolution ){
            $resolution->inspections()->detach($this->inspection_act_id);
            $this->resolution_id = '';
        }
        
    }

    public function closeUpdateModal()
    {
        $this->isUpdateModalOpen = false;
        $this->resetInput();
    }
    public function closeCreateModal()
    {
        $this->isCreateModalOpen = false;
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
        $exists = InspectionActResolution::where('resolution_id', $this->resolution_id)
                ->where('inspection_act_id', $this->inspection_act_id)
                ->exists();

        return !$exists; 
    }
}
