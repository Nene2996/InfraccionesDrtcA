<?php

namespace App\Http\Livewire\InspectionAct;

use App\Models\Campus;
use App\Models\Department;
use App\Models\District;
use App\Models\Evidence;
use App\Models\Infraction;
use App\Models\Inspection;
use App\Models\Inspector;
use App\Models\Province;
use App\Models\TypeName;
use App\Models\Vehicle;
use Carbon\Carbon;
use Livewire\Component;

class EditInspection extends Component
{
    public $names_business_names, $inspection, $provinces, $districts, $departments, $infractions, $evidences, $campus, $inspectors, $vehicles, $plate_number, $identification_card_number;

    public $infraction_id;
    public $province_id;
    public $evidence_id;
    public $campus_id;
    public $campus_inspection;
    public $inspector_id;
    public $vehicle_id;
    public $typeNames_id;


    protected $rules = [
        'inspection.act_number' => 'required|regex:/^[0-9]+$/',
        'inspection.typeNames_id' => 'required',
        'inspection.names_business_name' => 'required|regex:/^[A-Z,a-z, ,Á,É,Ó,Ñ,Ú,á,é,í,ó,ú,ñ]+$/',
        'inspection.typeDocument_id' => 'required',
        'inspection.address' => 'required',
        'inspection.document_number' => 'required|regex:/^[0-9]+$/',
        'inspection.licence_number' => 'required|regex:/^[A-Z,a-z]{1}[0-9]{8}$/',
        'inspection.infraction_id' => 'required',
        'inspection.qualification' => 'required',
        'inspection.date_infraction' => 'required|date',
        'inspection.hour_infraction' => 'required',
        'inspection.additional_Information' => 'nullable',
        'inspection.place' => 'required',
        'province_id' => 'required',
        'inspection.district_id' => 'required',
        'inspection.reference' => 'nullable',
        'inspection.observation' => 'nullable',
        'plate_number' => 'required|regex:/^[A-Z,0-9]{3}[-][A-Z,0-9]{3}+$/',
        'identification_card_number' => 'required|regex:/^[0-9]{10}$/',
        'inspection.evidence_id' => 'required',
        'inspection.description' => 'required',
        'inspection.inspector_id' => 'required',
        'inspection.status' => 'required',
    ];

    protected $messages = [
        'inspection.act_number.required' => 'El campo Número de Acta es obligatorio.',
        'inspection.act_number.regex' => 'El formato del Número de Acta es inválido.',
        'inspection.names_business_name.required' => 'El campo Nombres Apellidos/Razon Social es obligatorio.',
        'inspection.names_business_name.regex' => 'El campo Nombres Apellidos/Razón Social es inválido.',
        'inspection.document_number.required' => 'Es obligatorio ingresar el número de Dni / Ruc.',
        'inspection.document_number.regex' => 'El formato del campo Número de Documento es inválido.',
        'inspection.licence_number.required' => 'Es obligatorio ingresar el número de Licencia de Conducir.',
        'inspection.qualification.required' => 'La calificación(LEVE, GRAVE, MUY GRAVE) es obligatorio',
        'plate_number.regex' => 'En número de placa no es un formato válido.',
        'plate_number.required' => 'En número de placa es obligatorio.',
        'identification_card_number.required' => 'El Número de Tarjeta de Identificación vehicular es obligatorio.',
        'identification_card_number.regex' => 'El un Número Tarjeta de Identificación vehicular no es válido',
        
    ];
    
    public function mount(Inspection $inspection)
    {
        $this->inspection = $inspection;
        //dd($inspection);

        $this->departments = Department::all();

        $this->names_business_names = TypeName::all();
        $this->typeNames_id = $inspection->typeName->id;

        $this->provinces = Province::all();
        $this->province_id = $inspection->district->province->id;
        $this->districts = District::where('province_id', $this->province_id)->get();

        $this->infractions = Infraction::all();
        $this->infraction_id = $inspection->infraction->id;

        $this->evidences = Evidence::all();
        $this->evidence_id = $inspection->evidence->id;

        
        $this->campus_id = $inspection->campus->id;
        $this->campus_inspection = $inspection->campus->campus_name;

        //$this->inspectors = Inspector::all();
        $this->inspectors = Campus::find(auth()->user()->campus->id)->inspectors->where('status', '=', 1);
        $this->inspector_id = $inspection->inspector->id;

        $this->vehicles = Vehicle::all();
        $this->vehicle_id = $inspection->vehicle->id;
        $this->plate_number = $inspection->vehicle->plate_number;
        $this->identification_card_number = $inspection->vehicle->identification_card_number;

    }
    public function updatedProvinceId($value)
    {
        $this->districts = District::where('province_id', $value)->get();
        $this->district_id = "";  
    }

    public function getInfractionProperty()
    {
        return Infraction::find($this->inspection->infraction_id);
    }

    public function save()
    {
        $nowHour = Carbon::now()->format('g:i A');;
        $tomorrow = Carbon::tomorrow('America/Lima');
        $end = $tomorrow->subYear()->format('d-m-Y');
        
        $rules = $this->rules;
        $messages = $this->messages;

        $rules['inspection.date_infraction'] = 'before:tomorrow';
        $messages['inspection.date_infraction.before'] = 'La fecha de infracción debe ser una fecha anterior a '.$end;

        
        if($this->inspection['typeNames_id'] == 1){
            $this->inspection['typeDocument_id'] = 1;
        }else{
            $this->inspection['typeDocument_id'] = 2;
        }

        $this->validate($rules, $messages);
        $this->inspection->save();

        session()->flash('message', 'La Infraccion con Numero de Acta '.$this->inspection->act_number.' ha sido actualizada correctamente.');
        return redirect('/papeletas');
    }



    public function render()
    {
        return view('livewire.inspection-act.edit-inspection');
    }

    
}
