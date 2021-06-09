<?php

namespace App\Http\Livewire;

use App\Models\Ballot;
use Livewire\Component;

class Search extends Component
{
    public $search;

    //Primero en ejecutarse al renderizar el componente
    public function mount()
    {

    }
    public function render()
    {
        
        $ballots = Ballot::where('nro_licencia', $this->search)->get();
        return view('livewire.search', [ 'ballots' => $ballots]);
        
        
        
    }
}
