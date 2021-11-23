<?php

namespace App\Http\Livewire\Infraction;

use App\Models\Infraction;
use Livewire\Component;
use Livewire\WithPagination;

class ShowInfraction extends Component
{
    use WithPagination;
    public $cant = 5;
    
    public function render()
    {
        $infractions = Infraction::paginate($this->cant);
        return view('livewire.infraction.show-infraction', ['infractions' => $infractions]);
    }
}
