<?php

namespace App\Http\Livewire;

use App\Models\Ballot;
use Livewire\Component;

class Welcome extends Component
{
    public $search = '';
    public $typeSearch;

    public function mount()
    {
  
    }
    public function render()
    {
        
        if(($this->typeSearch == 0) && (strlen($this->search) > 5))
        {
            
            $ballots = Ballot::where('nombre_conductor', 'LIKE' , '%' . $this->search. '%')->get();
            return view('livewire.welcome', [ 'ballots' => $ballots]);
            
             
        }elseif($this->typeSearch == 1)
        {
            $ballots = Ballot::where('nro_licencia', $this->search)->get();
            return view('livewire.welcome', [ 'ballots' => $ballots]);
        }else
        {
            $ballots = Ballot::where('nro_acta', $this->search)->get();
            return view('livewire.welcome', [ 'ballots' => $ballots]);
        }
    }

    public function resetInput()
    {
        $this->search = '';
    }
 
}
