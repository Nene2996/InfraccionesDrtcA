<?php

namespace App\Http\Livewire\ControlAct;

use App\Models\ControlAct;
use Livewire\Component;

class ShowControlAct extends Component
{
    public $isOpendivLastName = true;
    public $radioValue, $radio_names_business_name;

    protected $rules = [
        'radio_names_business_name' => 'required|min:5'
    ];

    protected $messages = [
        'radio_names_business_name.required' => 'Es obligatorio ingresar apellidos y nombres.',
        'radio_names_business_name.min' => 'Es necesario ingresar al menos 5 caracteres.'
    ];

    public function updated($propertyRadio_names_business_name)
    {
        $this->validateOnly($propertyRadio_names_business_name);
    }

    public function mount()
    {
        $this->radioValue = 0;
        $this->isOpendivLastName = true;

    }
    public function render()
    {
        if($this->radioValue == 0){
            if(strlen($this->radio_names_business_name) > 5){
                $controlActs = ControlAct::where('nombre_apellidos', 'LIKE' , '%' . $this->radio_names_business_name. '%')->paginate(10);
                return view('livewire.control-act.show-control-act', ['controlActs' => $controlActs]);
            }else{
                $controlActs = ControlAct::orderBy('nro_acta', 'asc')->paginate(10);
                return view('livewire.control-act.show-control-act', ['controlActs' => $controlActs]);
            }
        }
    }
}
