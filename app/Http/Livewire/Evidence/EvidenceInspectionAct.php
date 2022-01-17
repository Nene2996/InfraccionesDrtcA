<?php

namespace App\Http\Livewire\Evidence;

use App\Models\Evidence;
use App\Models\Evidenceable;
use App\Models\Inspection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class EvidenceInspectionAct extends Component
{
    // atributos de Acta de fiscalizacion
    public  $inspection,
            $inspection_id,
            $act_number,
            $names_business_name,
            $document_number,
            $licence_number,
            $date_infraction,
            $hour_infraction,
            $place,
            $description;

    public  $campus;
    //atributos de medio probatorio
    public  $evidence_id,
            $evidencesFiles;

    public function mount(Inspection $inspection)
    {
        $this->inspection = $inspection;
        $this->inspection_id = $inspection->id;
        $this->act_number = $inspection->act_number;
        $this->names_business_name = $inspection->names_business_name;
        $this->document_number = $inspection->document_number;
        $this->licence_number = $inspection->licence_number;
        $this->date_infraction = $inspection->date_infraction;
        $this->hour_infraction = $inspection->hour_infraction;
        $this->description = $inspection->description;

        
    }

    public function render()
    {
        $this->evidencesFiles = Evidenceable::where('evidenceable_id', $this->inspection_id)->get();
        return view('livewire.evidence.evidence-inspection-act');
    }

    public function deleteEvidences($evidenciableId)
    {
        if($evidenciableId){
            $evidenciable = Evidenceable::find($evidenciableId);

            $fileEvidence = $evidenciable->FileEvidence;
            $fileEvidence->delete();

            $url_path_before = $evidenciable->FileEvidence->url_path;
            Storage::delete($url_path_before);

            $evidenciable->delete();
        }
    }
}
