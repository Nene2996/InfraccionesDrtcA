<?php

namespace App\Http\Livewire;

use App\Models\Ballot;
use App\Models\ControlAct;
use App\Models\Inspection;
use Livewire\Component;

class Welcome extends Component
{
    public $search = '';
    public $typeSearch;
    public $isModalOpen = 0;

    public $isOpendivLastName = 0;
    public $isOpendivNumberLicence = 0;
    public $isOpendivNumberAct = 0;

    public $lastName = '';
    public $numberLicence = '';
    public $numberActa = '';

    public $selectValue = '';

    public $lugar_intervencion, $nombre_apellidos, $placa_vehiculo, $origen, $destino, $nombre_conductor, $direccion_infractor, $nro_licencia, $fecha_infraccion, $hora_infraccion, $clase_categoria_licencia, $nro_tarjeta_vehicular, $manifestacion_usuario, $nro_acta, $servicio, $estado_actual, $sede_infraccion, $id_district, $informacion_adicional, $referencia, $descripcion, $ruc, $dni;

    protected $rules = [
        'numberLicence' => 'required|regex:/^[A-Z,a-z]{1}[0-9]{8}$/',
        'lastName' => 'required|regex:/^[A-Z,a-z, ,Á,É,Ó,Ñ,Ú,á,é,í,ó,ú,ñ]+$/',
        'numberActa' => 'required|regex:/^[0-9]+$/'
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
                if($this->selectValue == 1){
                    $ballots = ControlAct::where('nombre_apellidos', 'LIKE' , '%' . $this->lastName. '%')->get();
                    return view('livewire.welcome', [ 'ballots' => $ballots]);
                }else{
                    //$ballots = Inspection::has('paiments')->get();
                    //$ballots = Inspection::find(4);
                    $ballots = Inspection::where('names_business_name', 'LIKE', '%' . $this->lastName. '%')->get();
                    //dd($ballots->paiment->type_proof_id);
                    return view('livewire.welcome', [ 'ballots' => $ballots]);
                }
                
            }else
            {
                $ballots = collect();
                return view('livewire.welcome', [ 'ballots' => $ballots]);
            }
                
        }elseif($this->typeSearch == 1)
        {
            $this->closeDivNumberAct();
            $this->closeDivLastName();
            $this->openDivNumberLicence();

            $ballots = ControlAct::where('nro_licencia', $this->numberLicence)->get();
            return view('livewire.welcome', [ 'ballots' => $ballots]);
        }else
        {
            $this->closeDivLastName();
            $this->closeDivNumberLicence();
            $this->openDivNumberAct();

            $ballots = ControlAct::where('nro_acta', $this->numberActa)->get();
            return view('livewire.welcome', [ 'ballots' => $ballots]);
        }
    }

    public function searchId($id){
        $ballot = ControlAct::findOrFail($id);
        $this->lugar_intervencion = $ballot->lugar_intervencion;

        $this->openModalPopover();
    }

    public function resetInput()
    {
        $this->lastName = '';
        $this->numberLicence = '';
        $this->numberActa = '';
    }

    public function show($id)
    {
        $ballot = ControlAct::findOrFail($id);
        $this->lugar_intervencion = $ballot->lugar_intervencion;
        $this->nombre_apellidos = $ballot->nombre_apellidos;
        $this->dni = $ballot->dni;
        $this->direccion_infractor = $ballot->direccion_infractor;
        $this->nro_licencia = $ballot->nro_licencia; 
        $this->fecha_infraccion = $ballot->fecha_infraccion;
        $this->hora_infraccion = $ballot->hora_infraccion;
        $this->clase_categoria_licencia = $ballot->clase_categoria_licencia;
        $this->nro_tarjeta_vehicular = $ballot->nro_tarjeta_vehicular;
        $this->manifestacion_usuario = $ballot->manifestacion_usuario;
        $this->nro_acta = $ballot->nro_acta;
        $this->estado_actual = $ballot->estado_actual;
        $this->sede_infraccion = $ballot->sede_infraccion;

        $this->openModalPopover();
    }

    public function showInspection($id)
    {
        $inspection = Inspection::findOrFail($id);
        $this->lugar_intervencion = $inspection->place;
        $this->nombre_apellidos = $inspection->names_business_name;
        $this->dni = $inspection->document_number;
        $this->direccion_infractor = $inspection->address;
        $this->nro_licencia = $inspection->licence_number;
        $this->fecha_infraccion = $inspection->date_infraction;
        $this->hora_infraccion = $inspection->hour_infraction;
        $this->clase_categoria_licencia = '';
        $this->nro_tarjeta_vehicular = $inspection->vehicle->identification_card_number;
        $this->manifestacion_usuario = $inspection->observation;
        $this->nro_acta = $inspection->act_number;
        $this->estado_actual = $inspection->status;
        $this->sede_infraccion = $inspection->campus->campus_name;

        $this->openModalPopover();

    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
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
 
}
