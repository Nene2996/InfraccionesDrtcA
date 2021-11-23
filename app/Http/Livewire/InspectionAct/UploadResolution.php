<?php

namespace App\Http\Livewire\InspectionAct;

use App\Models\Inspection;
use App\Models\InspectionActResolution;
use App\Models\Resolution;

use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Response;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadResolution extends Component
{
    use WithFileUploads;
    

    //resolutions
    public $resolutions;

    //resolution atrib.
    public $resolution_id = "", $date_notification_driver;
    public $file;


    public $inspection;
    public $inspection_act_id, $act_number, $names_business_name, $document_number, $licence_number, $date_infraction, $code, $description, $infringement_agent, $uit_penalty, $pecuniary_sanction, $administrative_sanction, $discount_five_days, $discount_fifteen_days, $status;

    protected $rules = [
        'resolution_id' => 'required',
    ];

    protected $messages = [
        'resolution_id.required' => 'Es obligatorio seleccionar una resolucion'
    ];

    public function getResolutionProperty()
    {
        return Resolution::find($this->resolution_id); 
    }

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
        $this->discount_five_days = $inspection->infraction->discount_five_days;
        $this->discount_fifteen_days = $inspection->infraction->discount_fifteen_days;
        $this->status = $inspection->status;
        
        $this->resolutions = Resolution::all();

    }

    public function render()
    {
        return view('livewire.inspection-act.upload-resolution');
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

                $this->inspection->status = 'ANULADO MEDIANTE '.$resolutionName;
                $this->inspection->save();

            }else{

                $this->inspection->status = 'PRESCRITA MEDIANTE '.$resolutionName;
                $this->inspection->save();
            }

            
            InspectionActResolution::create([
                'inspection_act_id' => $this->inspection_act_id,
                'resolution_id' => $this->resolution_id,
                'date_notification_driver' => $this->date_notification_driver,
                'type_act' => 'ACTA DE FISCALIZACION',  
            ]);

            $this->resetInput();
            session()->flash('message', 'Se ha adjuntado correctamente la resolucion: '.$resolutionName.' con la Acta de Fiscalizacion Nº: '.$this->act_number);
            return redirect('/actas-de-fiscalizacion');
        }
        
    }

    public function resetInput()
    {
        $this->inspection_act_id = '';
        $this->resolution_id = '';
        $this->date_notification_driver = '';
    }
    
}
