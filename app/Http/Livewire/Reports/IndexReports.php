<?php

namespace App\Http\Livewire\Reports;

use App\Models\Campus;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ControlActExport;

class IndexReports extends Component
{
    public Collection $allCampus;
    public string $selectCampus = "";
    public string $selectTypeAct = "";
    public $selectYear = "";
    public array $years = [];
    public $beginDate = "";
    public $endDate = "";
    private $startDay;
    private $endDay;

    public function mount()
    {
        $this->allCampus = Campus::get();
        $campusId = auth()->user()->campus->id;
        $campusId == 1 ? $this->selectCampus = 1 : $this->selectCampus = 2;
    }

    public function render()
    {
        if($this->selectTypeAct == 1){
            $this->years = ['2015', '2016', '2017', '2018', '2019', '2020'];
        }elseif($this->selectTypeAct == 2){
            $this->years = ['2020', '2021', '2022'];
        }else{
            $this->years = [];
        }
        return view('livewire.reports.index-reports');
    }

    public function reportExcel()
    {
        //return Excel::download(new ControlActExport(), 'transactions.xlsx');
        $this->validate();
        return Excel::download(new ControlActExport($this->selectCampus, $this->selectTypeAct, $this->beginDate, $this->endDate), 'transactions.xlsx');
    }


    protected function rules(): array
    {
        $this->startDay = new Carbon('first day of January ' . $this->selectYear);
        $this->endDay = new Carbon('last day of December' . $this->selectYear);

        return [
            'selectCampus' => [
                'required'
            ],
            'selectTypeAct' => [
                'required'
            ],
            'selectYear' => [
                'required'
            ],
            'beginDate' => [
                'required',
                'date',
                'after_or_equal:'.$this->startDay,
                'before_or_equal:'.$this->endDay,
                'before:'.Carbon::parse($this->endDate)->toDateString(),
            ],
            'endDate' => [
                'required',
                'date',
                'before_or_equal:'.$this->endDay,
                'after_or_equal:'.$this->startDay
            ],
        ];
    }

    protected function messages(): array
    {
        return [
            'selectCampus.required' => 'Es obligatorio seleccionar la Sede.',
            'selectTypeAct.required' => 'Es obligatorio seleccionar el tipo de Acta.',
            'selectYear.required' => 'Es obligatorio seleccionar el Año.',
            'beginDate.required' => 'Es obligatorio ingresar la fecha de Inicio.',
            'endDate.required' => 'Es obligatorio ingresar la fecha de Fin.',
            'beginDate.after_or_equal' => 'El campo fecha_inicio debe ser una fecha posterior o igual a: '.$this->startDay->format('d/m/Y'),
            'endDate.after_or_equal' => 'El campo fecha_fin debe ser una fecha posterior o igual a: '.$this->startDay->format('d/m/Y'),
            'beginDate.before_or_equal' => 'El campo fecha_inicio debe ser una fecha anterior o igual a: '.$this->endDay->format('d/m/Y'),
            'endDate.before_or_equal' => 'El campo fecha_fin debe ser una fecha anterior o igual a: '.$this->endDay->format('d/m/Y'),
        ];
    }
}
