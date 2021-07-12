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
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CreateInspection extends Component
{
    public $infractions;
    public $inspectors;

    public $provinces;
    public $province_id = "";

    public $districts = [];
    public $departments;

    public $campus;

    public $evidences;

    public $isOpenDivNamesDni = 0;
    public $isOpenDivBusinessNamesRuc = 0;
    public $select;
    public $_names_business_name;
    public $_document_number;
    public $dataReniec;
    public $messageApi;

    public $act_number, 
            $names_business_name, 
            $address, 
            $document_number, 
            $licence_number, 
            $qualification, 
            $date_infraction, 
            $hour_infraction, 
            $additional_Information, 
            $place, 
            $reference, 
            $observation, 
            $description, 
            $status, 
            $vehicle_id,
            $plate_number,
            $identification_card_number,
            $district_id,
            $evidence_id = "",
            $inspector_id = "",
            $infraction_id = "",
            $typeNames_id,
            $typeDocument_id,
            $user_id;

    protected $rules = [
        'act_number' => 'required|regex:/^[0-9]+$/',
        'address' => 'required',
        'licence_number' => 'required|regex:/^[A-Z,a-z]{1}[0-9]{8}$/',
        'infraction_id' => 'required',
        'qualification' => 'required',
        'date_infraction' => 'required|date',
        'hour_infraction' => 'required',
        'additional_Information' => 'nullable',
        'place' => 'required',
        'province_id' => 'required',
        'reference' => 'nullable',
        'observation' => 'nullable',
        'plate_number' => 'required|regex:/^[A-Z,0-9]{3}[-][A-Z,0-9]{3}+$/',
        'identification_card_number' => 'required|regex:/^[A-Z,0-9]+$/',
        'evidence_id' => 'required',
        'description' => 'required',
        'inspector_id' => 'required',
        'district_id' => 'required'
    ];

    protected $messages = [
        'act_number.required' => 'El campo Número de Acta es obligatorio.',
        'act_number.regex' => 'El formato del Número de Acta es inválido.',
        'address.required' => 'El Domicilio es obligatorio',
        'licence_number.required' => 'Es obligatorio ingresar el número de Licencia de Conducir.',
        'infraction_id.required' => 'El obligatorio seleccionar un codigo de infracción',
        'date_infraction.required' => 'El obligatorio ingresar la fecha de infracción',
        'hour_infraction.required' => 'El obligatorio ingresar la hora de infracción',
        'place.required' => 'El obligatorio ingresar el lugar de la infracción',
        'province_id.required' => 'El obligatorio seleccionar la provincia',
        'evidence_id.required' => 'Seleccionar un tipo de evidencia',
        'description.required' => 'Es necesario llenar la descripcion de la Infracción',
        'inspector_id.required' => 'Es necesario seleccionar un inspector',
        'qualification.required' => 'La calificación(LEVE, GRAVE, MUY GRAVE) es obligatorio',
        'plate_number.regex' => 'En número de placa no es un formato válido.',
        'plate_number.required' => 'En número de placa es obligatorio.',
        'identification_card_number.required' => 'El Número de Tarjeta de Identificación vehicular es obligatorio.',
        'identification_card_number.regex' => 'El un Número Tarjeta de Identificación vehicular no es válido',
        
    ];

    public function mount()
    {
        $this->infractions = Infraction::all();
        $this->departments = Department::all();
        $this->provinces = Province::all();
        //$this->inspectors = Inspector::all();
        //$this->campus = Campus::all();
        $this->evidences = Evidence::all();

        $this->inspectors = Campus::find(auth()->user()->campus->id)->inspectors->where('status', '=', 1);//->orderBy('surnames_and_names')->get();
        //dd($this->inspectors);
        $this->select = 1;
    }

    public function render()
    {

        if($this->select == '1')
        {
            $this->openDivNamesDni();
            $this->closeBusinessNamesRuc();
            $this->reset('_names_business_name');
            $this->reset('_document_number');
            
            
        }else
        {
            $this->closeDivNamesDni();
            $this->openDivBusinessNamesRuc();
            $this->reset('names_business_name');
            $this->reset('document_number');
            
        }

        return view('livewire.inspection-act.create-inspection');
        
    }

    public function getApiReniec()
    {
        $this->messageApi = '';
        $validatedData = $this->validate([
            'document_number' => 'required'
        ]);
        
        $response = Http::withToken('673dda73ae6223bd300b6db984f3ac6a125b2b8b9ed9ae9bffed87bfcb4b4b84')->get('https://apiperu.dev/api/dni/'.$this->document_number);

        //dd($response->getStatusCode());
        if($response->getStatusCode() == 200){
            $this->dataReniec = (json_decode($response->getBody(), true));
            if($this->dataReniec['success'] == true){
                $this->names_business_name = $this->dataReniec['data']['nombre_completo'];
            }else{
                $this->messageApi = $this->dataReniec['message'];
                $this->reset('names_business_name');
            }
        }else{
            $this->messageApi = 'Error de comunicación con el servicio(API) de Reniec';
        }
        
       
    }

    public function getApiSunat()
    {
        $this->messageApi = '';
        $validatedData = $this->validate([
            '_document_number' => 'required'
        ]);
        $response = Http::withToken('673dda73ae6223bd300b6db984f3ac6a125b2b8b9ed9ae9bffed87bfcb4b4b84')->get('https://apiperu.dev/api/ruc/'.$this->_document_number);
        /*
        $response02 = Http::get('https://dniruc.apisperu.com/api/v1/ruc/'.$this->_document_number.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imd1ZXZhcmFyb2phc2Rlbm5pc0BnbWFpbC5jb20ifQ.Mq9O3DdlzIIoaWHIkSFskEmQ8ulfGfYEuzB7jW7aKzA');*/
        //dd(json_decode($response->getBody(), true));
        if($response->getStatusCode() == 200){
            $this->dataSunat = (json_decode($response->getBody(), true));
            if($this->dataSunat['success'] == true){
                $this->_names_business_name = $this->dataSunat['data']['nombre_o_razon_social'];
            }else{
                $this->messageApi = $this->dataSunat['message'];
                $this->reset('_names_business_name');
            }
        }else{
            $this->messageApi = 'Error de comunicación con el servicio(API) de Sunat';
        }
    }

    public function save()
    {
       
        $nowHour = Carbon::now()->format('g:i A');;
        $tomorrow = Carbon::tomorrow('America/Lima');
        $end = $tomorrow->subYear()->format('d-m-Y');
        
        $rules = $this->rules;
        $messages = $this->messages;

        if($this->select == '1'){
            $nameBusinessName = $this->names_business_name;
            $dniRuc = $this->document_number;
            $typeDocument_id = 1;

            $rules['names_business_name'] = 'required';
            $rules['document_number'] = 'required|regex:/^[0-9]{8}$/';

            $messages['names_business_name.required'] = 'Es obligatorio ingresar los nombres y apellidos';
            $messages['document_number.required'] = 'Es obligatorio ingresar el número de Dni';
            $messages['document_number.regex'] = 'El formato del Número de DNI es inválido(8 dígitos)';
            
        }else{
            $nameBusinessName = $this->_names_business_name;
            $dniRuc = $this->_document_number;
            $typeDocument_id = 2;

            $rules['_names_business_name'] = 'required';
            $rules['_document_number'] = 'required|regex:/^[0-9]{11}$/';
            $messages['_names_business_name.required'] = 'Es obligatorio ingresar la Razón Social';
            $messages['_document_number.required'] = 'Es obligatorio ingresar el número de RUC';
            $messages['_document_number.regex'] = 'El número de RUC ingresado no es válido(11 dígitos)';
        }

        $rules['date_infraction'] = 'before:tomorrow';
        $messages['date_infraction.before'] = 'La fecha de infracción debe ser una fecha anterior a '.$end;

        //dd($nameBusinessName, $dniRuc, $this->select);
        $this->validate($rules, $messages);
     
        $vehicle = Vehicle::create([
            'plate_number' => $this->plate_number,
            'identification_card_number' => $this->identification_card_number
        ]);

        
        $vehicle->inspections()->create([
            'act_number' => $this->act_number,
            'names_business_name' => $nameBusinessName,
            'document_number' => $dniRuc,
            'address' => $this->address,
            'licence_number' => $this->licence_number,
            'qualification' => $this->qualification,
            'date_infraction' => $this->date_infraction,
            'hour_infraction' => $this->hour_infraction,
            'additional_Information' => $this->additional_Information,
            'place' => $this->place,
            'reference' => $this->reference,
            'observation' => $this->observation,
            'description' => $this->description,
            'status' => "PENDIENTE DE PAGO",
            'district_id' => $this->district_id,
            'evidence_id' => $this->evidence_id,
            'inspector_id' => $this->inspector_id,
            'campus_id' => auth()->user()->campus->id,
            'infraction_id' => $this->infraction_id,
            'typeNames_id' => $this->select,
            'typeDocument_id' => $typeDocument_id,
            'user_id' => auth()->user()->id

        ]);

        session()->flash('message', 'Infraccion con acta numero '.$this->act_number.' registrada correctamente.');
        return redirect('/papeletas');
        

        
        
    }

    public function getInfractionProperty()
    {
        return Infraction::find($this->infraction_id);
    }

    public function updatedProvinceId($value)
    {
        $this->districts = District::where('province_id', $value)->get();
        $this->reset('district_id');
    }

    public function openDivNamesDni()
    {
        $this->isOpenDivNamesDni = true;
    }

    public function closeDivNamesDni()
    {
        $this->isOpenDivNamesDni = false;
    }
    public function openDivBusinessNamesRuc()
    {
        $this->isOpenDivBusinessNamesRuc = true;
    }

    public function closeBusinessNamesRuc()
    {
        $this->isOpenDivBusinessNamesRuc = false;
    }
}
