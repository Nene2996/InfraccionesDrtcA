<?php

namespace App\Http\Livewire\ControlAct;

use App\Models\ControlAct;
use Livewire\Component;
use Livewire\WithPagination;

class ShowControlAct extends Component
{
    use WithPagination;

    public $isOpendivLastName = true;
    public $radioValue, $searchName;

    public $cant = 10;

    protected $rules = [
        'searchName' => 'required|min:5'
    ];

    protected $messages = [
        'searchName.required' => 'Es obligatorio ingresar apellidos y nombres.',
        'searchName.min' => 'Es necesario ingresar al menos 5 caracteres.'
    ];

    public function updated($propertySearchName)
    {
        $this->validateOnly($propertySearchName);
    }

    public function updatingSearchName()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->radioValue = 0;
        $this->isOpendivLastName = true;

    }
    public function render()
    {
        if($this->radioValue == 0){
            if(strlen($this->searchName) > 5){
                $controlActs = ControlAct::where('nombre_apellidos', 'LIKE' , '%' . $this->searchName.'%')->paginate($this->cant);
                return view('livewire.control-act.show-control-act', ['controlActs' => $controlActs]);
            }else{
                $controlActs = ControlAct::orderBy('nro_acta', 'asc')->paginate($this->cant);
                return view('livewire.control-act.show-control-act', ['controlActs' => $controlActs]);
            }
        }
    }
}
