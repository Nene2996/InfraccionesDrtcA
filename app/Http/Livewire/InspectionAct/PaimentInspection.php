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
    public $inspection_act_id, $act_number, $names_business_name, $document_number, $licence_number, $code, $description, $infringement_agent, $uit_penalty, $pecuniary_sanction, $administrative_sanction, $discount_five_days, $discount_fifteen_days, $date_payment, $type_proofs, $total_amount, $type_proof_id = '', $proof_number, $status;

    protected $rules = [
        'date_payment' => 'date|required',
        'total_amount' => 'required',
        'type_proof_id' => 'required',
        'proof_number' => 'required',
        'inspection_act_id' => 'required'
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
    }
    public function render()
    {
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
        ]);

        $this->inspection->status = 'Cancelado';
        $this->inspection->save();
        

        session()->flash('message', 'Se ha procesado el pago de infraccion correctamente'.$this->act_number);
        return redirect('/papeletas');
    }
}
