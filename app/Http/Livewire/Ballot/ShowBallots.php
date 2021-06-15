<?php

namespace App\Http\Livewire\Ballot;

use App\Models\Ballot;

use Livewire\Component;

class ShowBallots extends Component
{
    public function render()
    {
        $ballots = Ballot::paginate(10);
        return view('livewire.ballot.show-ballots', ['ballots' => $ballots]);
    }
}
