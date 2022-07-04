<?php

namespace App\Exports;

use App\Models\ControlAct;
use App\Models\Inspection;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ControlActExport implements FromCollection
{
    private int $campusId; 
    private int $selectTypeAct;
    private $beginDate;
    private $endDate;

    public function __construct(int $campusId, int $selectTypeAct, $beginDate, $endDate)
    {
        $this->campusId = $campusId;
        $this->selectTypeAct = $selectTypeAct;
        $this->beginDate = $beginDate;
        $this->endDate = $endDate;  
    }

    public function collection()
    {
        if($this->campusId == 1){ // Actas de Chachapoyas
            if ($this->selectTypeAct == 1) { 
                return ControlAct::whereBetween('fecha_infraccion', [$this->beginDate, $this->endDate])->where('campus_id', 1)->get();
            } else { 
                return Inspection::whereBetween('date_infraction', [$this->beginDate, $this->endDate])->where('campus_id', 1)->get();
            }
        }else{ // Actas de Bagua
            if ($this->selectTypeAct == 1) {
                return ControlAct::whereBetween('fecha_infraccion', [$this->beginDate, $this->endDate])->where('campus_id', 2)->get();
            } else {
                return Inspection::whereBetween('date_infraction', [$this->beginDate, $this->endDate])->where('campus_id', 2)->get();
            }
        }
    }
    
}
