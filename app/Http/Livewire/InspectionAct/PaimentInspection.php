<?php

namespace App\Http\Livewire\InspectionAct;

use App\Models\Inspection;
use App\Models\Paiment;
use App\Models\TypeProof;
use Carbon\Carbon;
use Livewire\Component;

class PaimentInspection extends Component
{
    public $inspection;
    public $inspection_act_id, $act_number, $names_business_name, $document_number, $licence_number, $date_infraction, $code, $description, $infringement_agent, $uit_penalty, $pecuniary_sanction, $administrative_sanction, $discount_five_days, $discount_fifteen_days, $date_payment, $type_proofs,  $type_proof_id = '', $proof_number, $status, $cashier, $businessDays = 0, $calendarDays = 0, $total_amount_pay = 0, $total_amount = 0, $pending_payment = 0, $nowDate;

    public $select;
    public $isOpenDivResolution = false;

    protected $rules = [
        'date_payment' => 'date|required',
        'total_amount' => 'required',
        'type_proof_id' => 'required',
        'proof_number' => 'required',
        'inspection_act_id' => 'required'
    ];

    protected $messages = [
        'date_payment.date' => 'Es necesario ingresar la fecha'
    ];

    public function mount(Inspection $inspection)
    {
        $this->inspection = $inspection;
        //dd($inspection);

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
        $this->type_proofs = TypeProof::all(); 

        $this->cashier = auth()->user()->name;
        
        $this->select = 0;

        $date = Carbon::now();

        $this->nowDate = $date->format('d-m-Y');

    }

    public function getDiasCalendarios($fechaInicio, $fechaFin)
    {
        $daysDiff = $fechaInicio->diffInDays($fechaFin);
        return $daysDiff;
    }

    public function getDiasHabiles($fechaInicio, $fechaFin)
    {
  
        //Dias Feriados
        $feriados = array( "2021-01-01", "2021-04-01", "2021-04-02", "2021-05-01", "2021-06-29", "2021-07-28","2021-07-29", "2021-08-30", "2021-10-08", "2021-11-01", "2021-12-08", "2021-12-25", "2020-01-01", "2020-04-09", "2020-04-10", "2020-05-01", "2020-06-29","2020-07-27", "2020-07-28", "2020-07-29", "2020-08-30", "2020-10-08", "2020-10-09", "2020-11-01", "2020-12-08", "2020-12-25", "2020-12-31", "2019-01-01", "2019-04-18", "2019-04-19", "2019-04-21", "2019-05-01", "2019-06-29", "2019-07-28", "2019-07-29", "2019-07-30", "2019-08-29", "2019-08-30", "2019-10-08", "2019-10-31", "2019-11-01", "2019-12-08", "2019-12-25", "2018-01-01", "2018-01-02", "2018-03-29", "2018-03-30", "2018-04-01", "2018-05-01", "2018-06-24", "2018-06-29", "2018-07-27", "2018-07-28", "2018-07-29", "2018-08-30", "2018-08-31", "2018-10-08", "2018-10-31", "2018-11-01", "2018-11-02", "2018-12-08", "2018-12-24", "2018-12-25", "2017-01-01", "2017-04-13", "2017-04-14", "2017-04-16", "2017-05-01", "2017-06-29", "2017-06-30", "2017-07-27", "2017-07-28", "2017-07-29", "2017-08-30", "2017-10-08", "2017-11-01", "2017-12-08", "2017-12-25");

        $fechaInicio = strtotime($fechaInicio);
        $fechaFin = strtotime($fechaFin);

        //Incremento en un dia(Segundos)
        $diaIncrementado = 60*60*24;
        $diasHabiles = array();

        //recorrer desde la fecha inicio hasta la fecha fin aumentado en un dia
        for($i = ($fechaInicio + $diaIncrementado); $i <= $fechaFin; $i += $diaIncrementado){
            if(!in_array(date('N', $i), array(6, 7))){
                if(!in_array(date('Y-m-d', $i), $feriados)){
                    array_push($diasHabiles, date('Y-m-d', $i));
                }
            }            
        }

        return count($diasHabiles);

    }

    public function updatedDatePayment($value)
    {
        $carbon1 = new Carbon($this->date_infraction);
        $carbon2 = new Carbon($value);
        $this->businessDays = $this->getDiasHabiles($carbon1, $carbon2);
        $this->calendarDays = $this->getDiasCalendarios($carbon1, $carbon2);

        if(($this->businessDays) > 5){
            $this->total_amount_pay = $this->pecuniary_sanction; 
            $this->pending_payment = ($this->total_amount_pay) - ($this->total_amount);
        }else{
            $this->total_amount_pay = ($this->pecuniary_sanction) - ($this->discount_five_days);
            $this->pending_payment = ($this->total_amount_pay) - ($this->total_amount);
        }
    }

    public function updatedTotalAmount($value)
    {
        $this->validate();
        if($value > 0){
            $this->pending_payment = (($this->total_amount_pay) - $value);
        }else{
            $this->pending_payment = $this->pecuniary_sanction;
        }
        
    }

    public function render()
    {
        
        if($this->select == 0){
            $this->CloseDivResolution();
        }else{
            $this->OpenDivResolution();
        }

        return view('livewire.inspection-act.paiment-inspection');
    }

    public function savePaiment(){

        $this->validate();

        //dd($this->status);
        Paiment::create([
            'date_payment' => $this->date_payment,
            'type_proof_id' => $this->type_proof_id,
            'proof_number' => $this->proof_number,
            'total_amount' => $this->total_amount,  
            'inspection_act_id' => $this->inspection_act_id,
            'user_id' => auth()->user()->id
        ]);

        $this->inspection->status = 'CANCELADO';
        $this->inspection->save();
        

        session()->flash('message', 'Se ha procesado correctamente el pago del acta de fiscalización número: '.$this->act_number.' correspondiente a: '.$this->inspection->names_business_name);
        return redirect('/actas-de-fiscalizacion');
    }

    public function OpenDivResolution()
    {
        $this->isOpenDivResolution = true;
    }

    public function CloseDivResolution()
    {
        $this->isOpenDivResolution = false;
    }
}


