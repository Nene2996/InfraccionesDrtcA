<?php

namespace App\Http\Livewire\Ballot;

use App\Models\Ballot;
use App\Models\Department;
use App\Models\District;
use App\Models\Province;
use App\Models\Infraction;
use App\Models\Inspector;


use Livewire\Component;

class CreateBallots extends Component
{
    public  $provinces, $districts = [], $departments;
    public $province_id = "", $district_id = "";

    public $infractions;
    public $inspectors;

    public $lugar_intervencion, $razon_social, $nombre_apellidos, $placa_vehiculo, $origen, $destino, $nombre_conductor, $direccion_infractor, $dni, $ruc, $nro_licencia, $fecha_infraccion, $hora_infraccion, $clase_categoria_licencia, $nro_tarjeta_vehicular, $manifestacion_usuario, $nro_acta, $servicio, $estado_actual, $sede_infraccion = "", $observaciones_verificacion, 
    $informacion_adicional, $calificacion, $idinspectores = "", 
    $referencia, $codigo_infraccion = "",
    $descripcion;

    public $select;
    public $selectTipoDoc;

    //Mostrar y ocultar div => Razon social/Nombre
    public $isOpendivNamesSurname = 0;
    public $isOpendivBusinessName = 0;

    //Mostrar y ocultar div => Dni/Ruc
    public $isOpendivDni = 0;
    public $isOpendivRuc = 0;

    protected $rules = [
        'nro_acta' => 'required',
        
        'direccion_infractor' => 'required',
        
        'nro_licencia' => 'required',
        'calificacion' => 'required',
        'fecha_infraccion' => 'required',
        'hora_infraccion' => 'required',
        'lugar_intervencion' => 'required',
        'province_id' => 'required',
        'district_id' => 'required',
        'placa_vehiculo' => 'required',
        'nro_tarjeta_vehicular' => 'required',
        'descripcion' => 'required',
        'idinspectores' => 'required',
        'sede_infraccion' => 'required',
        'codigo_infraccion' => 'required'
    ];

    protected $messages = [
        'nro_acta.required' => 'El número de Acta es obligatorio',
        
        'direccion_infractor.required' => 'El Domicilio es obligatorio',
        
        'nro_licencia.required' => 'El número de Licencia de Conducir es obligatorio',
        'calificacion.required' => 'La calificación(LEVE, GRAVE, MUY GRAVE) es obligatorio',
        'fecha_infraccion.required' => 'La Fecha es obligatorio',
        'hora_infraccion.required' => 'La hora es obligatorio',
        'lugar_intervencion.required' => 'El Lugar de la Infracción es obligatorio',
        'province_id.required' => 'Es necesaio seleccionar la provincia',
        'district_id.required' => 'Es necesaio seleccionar el distrito',
        'placa_vehiculo.required' => 'El Número de placa única nacional de Rodaje es obligatorio',
        'nro_tarjeta_vehicular.required' => 'Es necesario ingresar el nro de tarjeta',
        'descripcion.required' => 'Es necesario llenar la descripcion de la Infracción',
        'idinspectores.required' => 'Es necesario seleccionar un Inspector',
        'sede_infraccion.required' => 'Es necesario seleccionar la Sede de Infraccion',
        'codigo_infraccion.required' => 'Es necesario seleccionar un codigo de Infraccion',
    ];

    public function updatedProvinceId($value)
    {
        $this->districts = District::where('province_id', $value)->get();
        $this->reset('district_id');
    }

    
    public function mount()
    {
        $this->infractions = Infraction::all();
        $this->provinces = Province::all();
        $this->departments = Department::all();
        $this->inspectors = Inspector::all();
    }
    public function render()
    {
        if($this->select == 'nombre_apellidos' )
        {
            $this->openDivNamesSurname();
            $this->closeDivBusinessName();
            $this->reset('razon_social');

        }else
        {
            $this->closeDivNamesSurname();
            $this->openDivBusinessName();
            $this->reset('nombre_apellidos');
        }

        if($this->selectTipoDoc == 'dni')
        {
            $this->openDivDni();
            $this->closeDivRuc();
            $this->reset('ruc');
        }else
        {
            $this->closeDivDni();
            $this->openDivRuc();
            $this->reset('dni');
        }
        return view('livewire.ballot.create-ballots');
    }

    public function getInfractionProperty()
    {
        return Infraction::find($this->codigo_infraccion);
    }
    public function save()
    {
        $this->validate();

        /*
        if($this->nombre_apellidos)
        {
            $nombres = $this->nombre_apellidos;
            $razonSocial = '';
        }elseif($this->razon_social)
        {
            $nombres = '';
            $razonSocial = $this->razon_social;
        }

        if($this->dni)
        {
            $dni = $this->dni;
            $ruc = '';
        }elseif($this->ruc)
        {
            $dni = '';
            $ruc = $this->ruc;
        }
        */
        $ballot = new Ballot();
        $ballot->nro_acta = $this->nro_acta;

        $ballot->nombre_apellidos = $this->nombre_apellidos;
        $ballot->razon_social = $this->razon_social;

        $ballot->direccion_infractor = $this->direccion_infractor; 

        $ballot->ruc = $this->ruc;
        $ballot->dni = $this->dni;

        $ballot->nro_licencia = $this->nro_licencia;
        $ballot->codigo_infraccion = $this->codigo_infraccion;
        $ballot->calificacion = $this->calificacion;
        $ballot->fecha_infraccion = $this->fecha_infraccion;
        $ballot->hora_infraccion = $this->hora_infraccion;
        $ballot->informacion_adicional = $this->informacion_adicional;
        $ballot->lugar_intervencion = $this->lugar_intervencion;
        $ballot->id_district = $this->district_id;
        $ballot->referencia = $this->referencia;
        $ballot->observaciones_intervenido = $this->observaciones_verificacion;
        $ballot->placa_vehiculo = $this->placa_vehiculo;
        $ballot->nro_tarjeta_vehicular = $this->nro_tarjeta_vehicular;
        $ballot->descripcion = $this->descripcion;
        $ballot->idinspectores = $this->idinspectores;
        $ballot->fecha_registro_infraccion = date('Y-m-d H:i:s');
        $ballot->sede_infraccion = $this->sede_infraccion;
        
        //dd($ballot);
        $ballot->save();

        return redirect('/papeletas');
    }

    public function resetInput()
    {
        $this->razon_social = '';
        $this->nombre_apellidos = '';
        $this->dni = '';
        $this->ruc = '';
    }

    //Div para numero Razon Social
    public function openDivNamesSurname()
    {
        $this->isOpendivNamesSurname = true;
    }

    public function closeDivNamesSurname()
    {
        $this->isOpendivNamesSurname = false;
    }

    //Div para numero Nombres y Apellidos
    public function openDivBusinessName()
    {
        $this->isOpendivBusinessName = true;
    }

    public function closeDivBusinessName()
    {
        $this->isOpendivBusinessName = false;
    }

     //Div para numero Dni
     public function openDivDni()
     {
         $this->isOpendivDni = true;
     }
 
     public function closeDivDni()
     {
         $this->isOpendivDni = false;
     }

     //Div para numero Ruc
     public function openDivRuc()
     {
         $this->isOpendivRuc = true;
     }
 
     public function closeDivRuc()
     {
         $this->isOpendivRuc = false;
     }
}
