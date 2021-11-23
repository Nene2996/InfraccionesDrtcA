<?php

namespace App\Http\Livewire\InspectionAct;

use App\Models\Inspection;
use Livewire\Component;
use Livewire\WithPagination;

class ShowInspections extends Component
{
    use WithPagination;

    public  $names_business_name,
            $document_number,
            $licence_number,
            $address,
            $infraction_code,
            $infraction_description,
            $infraction_infringement_agent,
            $infraction_uit_penalty,
            $infraction_pecuniary_sanction,
            $infraction_administrative_sanction,
            $infraction_discount_five_days,
            $infraction_discount_fifteen_days,
            $operator_surnames_and_names,
            $place,
            $district,
            $province,
            $department,
            $status,
            $date_infraction,
            $hour_infraction,
            $vehicle_plate_number,
            $vehicle_identification_card_number,
            $inspector_surnames_and_names,
            $inspection_created_at,
            $inspection_campus,
            $proof_number;
            

    public  $campus,
            $act_number;
    public  $typeNames_id,
            $typeDocument_id;

    public  $isModalWarnigOpen = false;
    public  $isModalShowOpen = false;

    public  $isOpendivNumberLicence = false;
    public  $isOpendivLastName = false;
    public  $isOpendivNumberAct = false;

    //Variables de busqueda
    public $radioValue, $radio_names_business_name, $radio_dni_number, $radio_act_number;

    protected $rules = [
        'radio_names_business_name' => 'required|min:5',
        'radio_dni_number' => 'required',
        'radio_act_number' => 'required'
    ];

    protected $messages = [
        'radio_names_business_name.required' => 'Es obligatorio ingresar apellidos y nombres.',
        'radio_names_business_name.min' => 'Es necesario ingresar al menos 5 caracteres.',
        'radio_dni_number.required' => 'Es obligatorio ingresar el número de Dni.',
        'radio_act_number.required' => 'Es obligatorio ingresar el número de Acta de Fiscalización.'
    ];

    public function mount(){
        $this->radioValue = 0;

        $this->openDivLastName();
        $this->closeDivNumberLicence();
        $this->closeDivNumberAct();
        
    }

    public function updatingRadioNamesBusinessName()
    {
        $this->resetPage(); 
    }

    public function updatingRadioDniNumber()
    {
        $this->resetPage(); 
    }

    public function updatingRadioActNumber()
    {
        $this->resetPage(); 
    }

    public function updated($propertyRadio_names_business_name)
    {
        $this->validateOnly($propertyRadio_names_business_name);
    }

    public function render()
    {
       
            if(($this->radioValue == 0) ){

                $this->openDivLastName();
                $this->closeDivNumberLicence();
                $this->closeDivNumberAct();
                
                if(strlen($this->radio_names_business_name) > 5)
                {
                    $inspections = Inspection::where('names_business_name', 'LIKE' , '%' . $this->radio_names_business_name. '%')->paginate(20);
                    return view('livewire.inspection-act.show-inspections', ['inspections' => $inspections]);
                }else
                {
                    $inspections = Inspection::orderBy('act_number', 'asc')->paginate(20);
                    return view('livewire.inspection-act.show-inspections', ['inspections' => $inspections]);
                }

            }elseif($this->radioValue == 1 ){
               
                $this->closeDivLastName();
                $this->openDivNumberLicence();
                $this->closeDivNumberAct();

                $inspections = Inspection::where('document_number', $this->radio_dni_number)->paginate(20);
                return view('livewire.inspection-act.show-inspections', ['inspections' => $inspections]);

            }else{

                $this->closeDivLastName();
                $this->closeDivNumberLicence();
                $this->openDivNumberAct();

                $inspections = Inspection::where('act_number', $this->radio_act_number)->paginate(20);
                return view('livewire.inspection-act.show-inspections', ['inspections' => $inspections]);
            }
    }

    public function submit()
    {
        $this->validate();
        //$this->render();
    }
    public function resetInput()
    {
        $this->radio_names_business_name = '';
        $this->radio_licence_number = '';
        $this->radio_act_number = '';
    }

    public function loadModelWarning($id)
    {
        $inspection = Inspection::findOrFail($id);
        $this->campus = $inspection->campus->campus_name;
        $this->act_number = $inspection->act_number;
        $this->openModalWarnig();
    }
    public function openModalWarnig()
    {
        $this->isModalWarnigOpen = true;
    }

    public function closeModalWarnig()
    {
        $this->isModalWarnigOpen = false;
    }

    public function loadModelId($id)
    {
        $inspection = Inspection::findOrFail($id);
        $this->typeNames_id = $inspection->typeNames_id;
        $this->names_business_name = $inspection->names_business_name;
        $this->typeDocument_id = $inspection->typeDocument_id;
        $this->document_number = $inspection->document_number;
        $this->licence_number = $inspection->licence_number;
        $this->address = $inspection->address;
        $this->infraction_code = $inspection->infraction->code;
        $this->infraction_description = $inspection->infraction->description;
        $this->infraction_infringement_agent = $inspection->infraction->infringement_agent;
        $this->infraction_uit_penalty = $inspection->infraction->uit_penalty;
        $this->infraction_pecuniary_sanction = $inspection->infraction->pecuniary_sanction;
        $this->infraction_administrative_sanction = $inspection->infraction->administrative_sanction;
        $this->infraction_discount_five_days = $inspection->infraction->discount_five_days;
        $this->infraction_discount_fifteen_days = $inspection->infraction->discount_fifteen_days;
        $this->infraction_discount_fifteen_days = $inspection->infraction->discount_fifteen_days;
        $this->place = $inspection->place;
        $this->district = $inspection->district->name_district;
        $this->province = $inspection->district->province->name_province;
        $this->department = $inspection->district->province->department->name_department;
        $this->date_infraction = $inspection->date_infraction;
        $this->hour_infraction = $inspection->hour_infraction;
        $this->vehicle_plate_number = $inspection->vehicle->plate_number;
        $this->vehicle_identification_card_number = $inspection->vehicle->identification_card_number;
        $this->status = $inspection->status;
        $this->inspector_surnames_and_names = $inspection->inspector->surnames_and_names;
        $this->operator_surnames_and_names = $inspection->user->name;
        $this->inspection_created_at = $inspection->created_at;
        $this->inspection_campus = $inspection->campus->campus_name;

        if($inspection->paiments){
            $this->proof_number = $inspection->paiments->proof_number;
        }else{
            $this->proof_number = null;
        }
        
        $this->openModalShow();
    }

    public function openModalShow()
    {
        $this->isModalShowOpen = true;
    }

    public function closeModalShow()
    {
        $this->isModalShowOpen = false;
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
