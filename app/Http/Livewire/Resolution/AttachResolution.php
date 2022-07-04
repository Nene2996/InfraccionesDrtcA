<?php

namespace App\Http\Livewire\Resolution;

use Illuminate\Support\Collection;
use App\Models\Campus;
use App\Models\ControlAct;
use App\Models\Inspection;
use App\Models\Resolution;
use Livewire\Component;

class AttachResolution extends Component
{
    public  $campus,
            $selectValueCampus = '',
            $selectValueTypeAct = '',
            $act_number,
            $controlActs,
            $inspectionActs;

    public  bool $isDisabledSelectCampus;

    public  bool $isDisabledSelectTypeAct;

    public  bool $isDisabledActNumber;

    public  bool $showButtonSearch = true;

    public  bool $showButtonNewSearch;

    public  bool $showTable = false;

    public  bool $associateDisabled = true;

    public bool $isOpenModalAssociateAct = false;

    public Collection $selectedActs;

    public Collection $resolutions;
    public  $resolution_id,
            $paises;


    protected $rules = [
        'selectValueCampus' => 'required',
        'selectValueTypeAct' => 'required',
        'act_number' => 'required',
    ];

    protected $messages = [
        'selectValueCampus.required' => 'Selecciona primero la sede.',
        'selectValueTypeAct.required' => 'Selecciona el tipo de Acta.',
        'act_number.required' => 'Ingresa el nro de Acta.',
    ];
    public function mount()
    {
        $this->resolutions = Resolution::get();
        $this->campus = Campus::all();
    }
    public function render()
    {
        //$this->associateDisabled = $this->selectedActs->filter(fn($p) => $p)->count() < 2;
        return view('livewire.resolution.attach-resolution');
    }

    public function search()
    {
        $this->validate();
        if($this->selectValueCampus == 1){
            if($this->selectValueTypeAct == 1){
                if(!empty($this->act_number)){
                    $this->controlActs = ControlAct::where('numero_acta', $this->act_number)->get();
                    $this->selectedActs =  $this->controlActs
                        ->map(fn($act) => $act->id)
                        ->flip()
                        ->map(fn($act) => false);
                        
                }else{
                    $this->controlActs = collect();
                } 
            }elseif($this->selectValueTypeAct == 2){
                if(!empty($this->act_number)){
                    $this->inspectionActs = Inspection::where('act_number', $this->act_number)->get();
                }else{
                    $this->inspectionActs = collect();
                }
            }
        }elseif($this->selectValueCampus == 2){
            if($this->selectValueTypeAct == 1){

            }elseif($this->selectValueTypeAct == 2){

            }
        }
        $this->disabling();
    }

    public function resetInput()
    {
        //$this->selectValueCampus = '';
        $this->act_number = '';
        //$this->selectValueTypeAct = '';
        //$this->inspectionActs = collect();
    }

    public function disabling()
    {
        $this->isDisabledSelectCampus = true;
        $this->isDisabledSelectTypeAct = true;
        $this->isDisabledActNumber = true;
        $this->showButtonNewSearch = true;
        $this->showButtonSearch = false;
        $this->showTable = true;
    }

    public function newSearch()
    {
        $this->isDisabledSelectCampus = false;
        $this->isDisabledSelectTypeAct = false;
        $this->isDisabledActNumber = false;
        $this->showButtonNewSearch = false;
        $this->showButtonSearch = true;
        $this->showTable = false;

        $this->selectValueCampus = '';
        $this->selectValueTypeAct = '';
        $this->act_number = '';
        
        $this->reset('controlActs');
        $this->reset('inspectionActs');

    }

    private function getSelectedActs()
    {
        return $this->selectedActs->filter(fn($p) => $p)->keys();
    }

    public function OpenModalAssociateAct()
    {
        
        
        $idResolution = Resolution::select('id', 'title')->get()
                        ->map(fn($resolution) => $resolution->id);

        $titleResolution = Resolution::select('id', 'title')->get()
                           ->map(fn($resolution) => $resolution->title);

        $this->resolutions = $idResolution->combine($titleResolution);

        $this->paises = ['au' => 'Australia',
                         'be' => 'Belgium', 
                         'cn' => 'China', 
                         'fr' => 'France', 
                         'de' => 'Germany', 
                         'it' => 'Italy', 
                         'mx' => 'Mexico', 
                         'es' => 'Spain', 
                         'tr' => 'Turkey', 
                         'gb' => 'United Kingdom', 
                         'us' => 'United States'];

        //dd($resolutions);
        $this->isOpenModalAssociateAct = true;
        return json_encode($this->resolutions);
        //return response()->json($paises); json_encode($paises);
    }

    public function CloseModalAssociateAct()
    {
        $this->isOpenModalAssociateAct = false;
        $this->reset('resolution_id');
        $this->resetValidation('resolution_id');
    }

    public function AssociateResolution()
    {
        $rules = $this->rules;
        $messages = $this->messages;

        $rules['resolution_id'] = 'required';
        $messages['resolution_id.required'] = 'Es obligatorio seleccionar una resolución.';

        $this->validate($rules, $messages);

        $resolution = Resolution::find($this->resolution_id);
        dd($resolution);

    }
}
