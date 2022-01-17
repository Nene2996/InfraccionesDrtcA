<?php

namespace App\Http\Livewire;

use App\Models\ControlAct;
use App\Models\Inspection;
use Livewire\Component;

class Welcome extends Component
{
    public $search = '';
    public $typeSearch;

    public $isModalOpen = 0;
    public $isModalInspectionActOpen = 0;
    public $isOpendivLastName = 0;
    public $isOpendivNumberLicence = 0;
    public $isOpendivNumberAct = 0;

    public $lastName = '';
    public $numberLicence = '';
    public $numberActa = '';

    public $selectValue = '';

    //atributos del acta de control
    public $ballot, $apellidos_nombres_conductor, $placa_vehiculo, $origen, $destino, $nombre_conductor, $direccion_infractor, $nro_licencia, $fecha_infraccion, $hora_infraccion, $clase_categoria_licencia, $nro_tarjeta_vehicular, $manifestacion_usuario, $numero_acta, $tipo_servicio, $estado_actual, $sede_infraccion, $id_district, $informacion_adicional, $referencia, $descripcion, $ruc_dni, $nro_dni_conductor, $razon_social_nombre, $lugar_intervencion, $codigo_infraccion, $nro_comprobante;

    //atributos del acta de fiscalizacion
    public $act_number, $names_business_name, $document_number, $address, $licence_number, $date_infraction, $hour_infraction, $description, $status, $typeNames_id, $typeDocument_id, $inspector_surnames_and_names, $operator_surnames_and_names, $inspection_created_at, $inspection_campus, $infraction_code, $infraction_description, $infraction_infringement_agent, $infraction_uit_penalty, $infraction_administrative_sanction, $place, $district, $province, $department, $vehicle_plate_number, $vehicle_identification_card_number, $hasPaiments;

    //informacion de pagos
    public  $paiments;

    protected $rules = [
        'numberLicence' => 'required|regex:/^[A-Z,a-z]{1}[0-9]{8}$/',
        'lastName' => 'required|regex:/^[A-Z,a-z, ,Á,É,Ó,Ñ,Ú,á,é,í,ó,ú,ñ]+$/',
        'numberActa' => 'required|regex:/^[0-9]+$/',
        'selectValue' => 'required'
    ];

    protected $messages = [
        'numberLicence.regex' => 'El número de licencia ingresado no tiene un formato válido. Ejem: Q755998975',
        'numberLicence.required' => 'Es obligatorio ingresar el número de licencia',
        'numberActa.regex' => 'Solo ingresar valores numéricos',
        'numberActa.required' => 'Es obligatorio ingresar el número de Acta',
        'lastName.required' => 'Es obligatorio ingresar los apellidos y nombres',
        'lastName.regex' => 'El valor ingresado no es válido',
    ];
    
    public function mount()
    {
        $this->typeSearch = 0;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        if(($this->typeSearch == 0))
        {
            $this->openDivLastName();
            $this->closeDivNumberLicence();
            $this->closeDivNumberAct();
            
            if(strlen($this->lastName) > 5)
            {
                if($this->selectValue == ""){
                    $this->addError('numberLicence', 'Es obligatorio seleccionar el Tipo de Acta');
                }

                if($this->selectValue == 1){
                    $this->resetValidation();
                    $ballots = ControlAct::where('apellidos_nombres_conductor', 'LIKE' , '%' . $this->lastName. '%')->take(10)->get();
                    return view('livewire.welcome', ['ballots' => $ballots]);
                }else{
                    $ballots = Inspection::where('names_business_name', 'LIKE', '%' . $this->lastName. '%')->take(10)->get();
                    return view('livewire.welcome', ['ballots' => $ballots]);
                }
            }else
            {
                $ballots = collect();
                return view('livewire.welcome', ['ballots' => $ballots]);
            } 

        }elseif($this->typeSearch == 1)
        {
            $this->closeDivNumberAct();
            $this->closeDivLastName();
            $this->openDivNumberLicence();

            if($this->selectValue == ""){
                $this->addError('numberLicence', 'Es obligatorio seleccionar el Tipo de Acta');
            }

            if($this->selectValue == 1){
                $ballots = ControlAct::where('nro_licencia', $this->numberLicence)->get();
                return view('livewire.welcome', ['ballots' => $ballots]);
            }else{
                $ballots = Inspection::where('licence_number', $this->numberLicence)->get(); 
                return view('livewire.welcome', ['ballots' => $ballots]);
            }
        }else
        {
            $this->closeDivLastName();
            $this->closeDivNumberLicence();
            $this->openDivNumberAct();

            if($this->selectValue == ""){
                $this->addError('numberLicence', 'Es obligatorio seleccionar el Tipo de Acta');
            }

            if($this->selectValue == 1){
                $ballots = ControlAct::where('numero_acta', $this->numberActa)->get();
                return view('livewire.welcome', ['ballots' => $ballots]);
            }else{
                $ballots = Inspection::where('act_number', $this->numberActa)->get();
                return view('livewire.welcome', ['ballots' => $ballots]);
            }
        }
    }

    public function searchId($id){
        $ballot = ControlAct::findOrFail($id);
        $this->lugar_intervencion = $ballot->lugar_intervencion;

        $this->openModalPopover();
    }

    public function showControlAct($id)
    {
        $ballot = ControlAct::findOrFail($id);
        $this->ballot = $ballot;
        $this->numero_acta = $ballot->numero_acta;
        $this->lugar_intervencion = $ballot->lugar_intervencion;
        $this->origen = $ballot->origen;
        $this->destino = $ballot->destino;
        $this->placa_vehiculo = $ballot->placa_vehiculo;
        $this->apellidos_nombres_conductor = $ballot->apellidos_nombres_conductor;
        $this->nro_dni_conductor = $ballot->nro_dni_conductor;
        $this->ruc_dni = $ballot->ruc_dni;
        $this->razon_social_nombre = $ballot->razon_social_nombre;
        $this->nro_licencia = $ballot->nro_licencia; 
        $this->fecha_infraccion = $ballot->fecha_infraccion;
        $this->hora_infraccion = $ballot->hora_infraccion;
        $this->clase_categoria_licencia = $ballot->clase_categoria_licencia;
        $this->tipo_servicio = $ballot->tipo_servicio;
        $this->nro_tarjeta_vehicular = $ballot->nro_tarjeta_vehicular;
        $this->manifestacion_usuario = $ballot->manifestacion_usuario;
        $this->codigo_infraccion = $ballot->infractions->code;
        $this->estado_actual = $ballot->estado_actual;
        $this->sede_infraccion = $ballot->campus->alias;
        $this->nro_comprobante = $ballot->nro_boleta_pago;

        $this->paiments = ControlAct::find($ballot->id)->paiments;

        $this->openModalPopover();
    }

    public function showInspectionAct($id)
    {
        $inspection = Inspection::findOrFail($id);
        //==============================================================
        $this->typeNames_id = $inspection->typeNames_id;
        $this->names_business_name = $inspection->names_business_name;
        $this->inspector_surnames_and_names = $inspection->inspector->surnames_and_names;
        $this->typeDocument_id = $inspection->typeDocument_id;
        $this->document_number = $inspection->document_number;
        $this->operator_surnames_and_names = $inspection->user->name;
        $this->licence_number = $inspection->licence_number;
        $this->inspection_created_at = $inspection->created_at;
        $this->address = $inspection->address;
        $this->inspection_campus = $inspection->campus->campus_name;
        $this->infraction_code = $inspection->infraction->code;
        $this->infraction_description = $inspection->description;
        $this->infraction_infringement_agent = $inspection->infraction->infringement_agent;
        $this->infraction_uit_penalty = $inspection->infraction->uit_penalty;
        $this->infraction_administrative_sanction = $inspection->infraction->administrative_sanction;
        $this->place = $inspection->place;
        $this->district = $inspection->district->name_district;
        $this->province = $inspection->district->province->name_province;
        $this->department = $inspection->district->province->department->name_department;
        $this->date_infraction = $inspection->date_infraction;
        $this->hour_infraction = $inspection->hour_infraction;
        $this->vehicle_plate_number = $inspection->vehicle->plate_number;
        $this->vehicle_identification_card_number = $inspection->vehicle->identification_card_number;
        $this->status = $inspection->status;

        if($inspection->hasPaiment($inspection->id)){

            $this->hasPaiments = true;
            $this->paiments = $inspection->paiments;

        }else{
            $this->hasPaiments = false;
        }

        $this->openModalInspection();

    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    public function openModalInspection()
    {
        $this->isModalInspectionActOpen = true;
    }

    public function closeModalInspection()
    {
        $this->isModalInspectionActOpen = false;
    }

    //Div para numero de Licencia
    public function openDivNumberLicence()
    {
        $this->isOpendivNumberLicence = true;
    }

    public function closeDivNumberLicence()
    {
        $this->isOpendivNumberLicence = false;
    }

    //Div para numero apellidos y nombres
    public function openDivLastName()
    {
        $this->isOpendivLastName = true;
    }

    public function closeDivLastName()
    {
        $this->isOpendivLastName = false;
    }

    //Div para numero de Acta
    public function openDivNumberAct()
    {
        $this->isOpendivNumberAct  = true;
    }

    public function closeDivNumberAct()
    {
        $this->isOpendivNumberAct  = false;
    }

    public function resetInput()
    {
        $this->lastName = '';
        $this->numberLicence = '';
        $this->numberActa = '';
    }
 
}
