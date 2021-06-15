<?php

namespace App\Http\Controllers;

use App\Models\Ballot;
use Illuminate\Http\Request;

class BallotController extends Controller
{
    public function show()
    {
        $ballots = Ballot::paginate(10);
        return view('ballots.show', ['ballots' => $ballots]);
    }

    public function create()
    {
        return view('ballots.create');
    }
}
