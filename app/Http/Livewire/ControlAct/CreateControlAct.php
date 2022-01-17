<?php

namespace App\Http\Livewire\ControlAct;

use App\Models\Campus;
use App\Models\ControlAct;
use App\Models\Infraction;
use App\Models\Inspector;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateControlAct extends Component
{
    //Archivos con livewire
    use WithFileUploads;
    public  $file_pdf;

    //Inspectores
    public  $inspector_id = '', 
            $inspectors;

    public  $campus;

    //select para selecionar DNI o RUC
    public  $select_dni_ruc,
            $nombre_razonsocial;

    //Tabla de infracciones
    public  $infraction_id = '',
            $infraction_type = '',
            $infractions;

    //validar si posee licencia de conducir
    public  $posee_licencia,
            $isDisabled;

/*
    public  $numero_acta,
            $value_dni_ruc,
            $value_nombre_razonsocial,
            $tipo_servicio = '',
            $placa_vehiculo,
            $lugar_intervencion,
            $origen,
            $destino,
            $nro_dni_conductor,
            $apellidos_conductor,
            $nombres_conductor,
            $nro_licencia,
            $clase_cat_licencia = '',
            $fecha_infraccion,
            $hora_infraccion,
            $descripcion_infraccion,
            $manifestacion_usuario;
*/

    //Acta de control atributos
    public  $numero_acta,
            $value_dni_ruc,
            $nro_dni_conductor,
            $value_nombre_razonsocial,
            $nro_habilitacion,
            $placa_vehiculo,
            $lugar_intervencion,
            $origen,
            $destino,
            $apellidos_conductor,
            $nombres_conductor,
            $nro_licencia,
            $fecha_infraccion,
            $hora_infraccion,
            $clase_categoria_licencia = '',
            $descripcion_infraccion,
            $manifestacion_usuario,
            $tipo_servicio,
            $estado_actual,
            $fecha_registro_infraccion,
            $campus_id;

    protected $rules = [
        'numero_acta' => 'required|regex:/^[0-9]+$/',
        'tipo_servicio' => 'required',
        'placa_vehiculo' => 'required|regex:/^[A-Z,0-9]{3}[-][A-Z,0-9]{3}+$/',
        'lugar_intervencion' => 'required',
        'origen' => 'required',
        'destino' => 'required',
        'nro_dni_conductor' => 'required|regex:/^[0-9]{8}$/',
        'apellidos_conductor' => 'required',
        'nombres_conductor' => 'required',
        'fecha_infraccion' => 'required|date',
        'hora_infraccion' => 'required',
        'infraction_type' => 'required',
        'descripcion_infraccion' => 'required',
        'inspector_id' => 'required',
        'file_pdf' => 'required|mimes:pdf|max:1024'
        
    ];

    protected $messages = [
        'numero_acta.required' => 'El nro de Acta de Control es obligatorio.',
        'numero_acta.regex' => 'El nro de Acta de Control no es válido',
        'numero_acta.unique' => 'El nro de Acta de Control ya existe',
        'value_nombre_razonsocial.required' => 'Los Apellidos y Nombres del transportista es obligatorio',
        'tipo_servicio.required' => 'Selecciona el tipo de servicio',
        'placa_vehiculo.required' => 'El nro de placa vehicular es obligatorio',
        'placa_vehiculo.regex' => 'El nro de placa ingresado no es válido',
        'lugar_intervencion.required' => 'El lugar de intervención es obligatorio',
        'origen.required' => 'El origen es obligatorio',
        'destino.required' => 'El destino es obligatorio',
        'nro_dni_conductor.required' => 'El número de DNI es obligatorio',
        'nro_dni_conductor.regex' => 'El número de DNI debe ser de 8 digitos numéricos',
        'apellidos_conductor.required' => 'Los apellidos del conductor es obligatorio',
        'nombres_conductor.required' => 'Los nombres del conductor es obligatorio',
        'infraction_type.required' => 'Selecciona el tipo de infracción',
        'descripcion_infraccion.required' => 'LLenar la descripcion de la infracción',
        'inspector_id.required' => 'Selecciona el nombre del inspector',
        'file_pdf.required' => 'Es necesario adjuntar un archivo pdf',
        'file_pdf.mimes' => 'El archivo seleccionado debe ser de tipo: pdf.',
        'file_pdf.max' => 'El archivo pdf no debe pesar más de 1MB'
    ];
    public function mount()
    {
        $this->campus = auth()->user()->campus->campus_name;
        $this->campus_id = auth()->user()->campus->id;
        $this->select_ruc_dni = 0;
        $this->posee_licencia = 0;
        
        $this->inspectors = Campus::find(auth()->user()->campus->id)->inspectors;

    }

    public function render()
    {
        if($this->select_dni_ruc == 0)
        {
            $this->nombre_razonsocial = 'Apellidos y Nombres';
        }else
        {
            $this->nombre_razonsocial = 'Razón Social';
        }

        if($this->posee_licencia == '0')
        {
            $this->isDisabled = false; 
        }else
        {
            $this->isDisabled = true;
            $this->nro_licencia = 'NO CUENTA CON LICENCIA DE CONDUCIR';
            $this->clase_categoria_licencia = 'NO CUENTA CON LICENCIA DE CONDUCIR';
        }

        $this->infractions = Infraction::where('type', $this->infraction_type)->get();
        
        return view('livewire.control-act.create-control-act');
    }

    public function save()
    {
        $rules = $this->rules;
        $messages = $this->messages;

        
        

        if($this->select_dni_ruc == 0) {
            $rules['value_dni_ruc'] = 'required|regex:/^[0-9]{8}$/';
            $rules['value_nombre_razonsocial'] = 'required';

            $messages['value_dni_ruc.required'] = 'El número de DNI es obligatorio';
            $messages['value_dni_ruc.regex'] = 'El número de DNI debe tener 8 digitos';
            $messages['value_nombre_razonsocial.required'] = 'Los Apellidos y Nombres del transportista es obligatorio';
        }else{  

            $rules['value_dni_ruc'] = 'required|regex:/^[0-9]{11}$/';
            $rules['value_nombre_razonsocial'] = 'required';

            $messages['value_dni_ruc.required'] = 'El número de RUC es obligatorio';
            $messages['value_dni_ruc.regex'] = 'El número de RUC debe tener 11 digitos';
            $messages['value_nombre_razonsocial.required'] = 'La Razón Social del transportista es obligatorio';
        }

        if($this->posee_licencia == '0')
        {
            $rules['nro_licencia'] = 'required|regex:/^[A-Z]{1}[0-9]{8}$/';
            $rules['clase_categoria_licencia'] = 'required';

            $messages['nro_licencia.required'] = 'El número de Licencia de Conducir es obligatorio';
            $messages['nro_licencia.regex'] = 'El número ingresado de Licencia de Conducir no es válido';
            $messages['clase_categoria_licencia.required'] = 'Es obligatorio seleccionar la Cat. de Licencia de Conducir';
        }else
        {
            $this->nro_licencia = 'NO CUENTA CON LICENCIA DE CONDUCIR';
            $this->clase_cat_licencia = 'NO CUENTA CON LICENCIA DE CONDUCIR';
        }

        $today = Carbon::today()->toDateString();
        $tomorrow = Carbon::tomorrow('America/Lima');
        $end = $tomorrow->subYear()->format('d-m-Y');

        $rules['fecha_infraccion'] = 'before:tomorrow';
        $messages['fecha_infraccion.before'] = 'La fecha de infracción debe ser una fecha anterior a '.$end;

        $rules['numero_acta.unique'] = Rule::unique('control_act')->where('campus_id', auth()->user()->campus->id);
        $messages['numero_acta.unique'] = 'El nro de Acta de Control ya existe.';

        $this->validate($rules, $messages);
        
        $infraction = Infraction::find($this->infraction_id);
        if($infraction){
            if($infraction->pecuniary_sanction == 0){
                $estado_actual_infraction = 'PENDIENTE DE RESOLUCION DE SANCIÓN';
                $nro_boleta_pago = 'NO APLICA';
            }else{
                $estado_actual_infraction = 'FALTA CANCELAR';
                $nro_boleta_pago = NULL;
            }
        }

        $controlAct = ControlAct::create([
            'numero_acta' => $this->numero_acta,
            'ruc_dni' => $this->value_dni_ruc,
            'razon_social_nombre' => $this->value_nombre_razonsocial,
            'nro_habilitacion' => $this->nro_habilitacion,
            'tipo_servicio' => $this->tipo_servicio,
            'placa_vehiculo' => $this->placa_vehiculo,
            'lugar_intervencion' => $this->lugar_intervencion,
            'origen' => $this->origen,
            'destino' => $this->destino,
            'nro_dni_conductor' => $this->nro_dni_conductor,
            'apellidos_nombres_conductor' => $this->apellidos_conductor.', '.$this->nombres_conductor,
            'nro_licencia' => $this->nro_licencia,
            'clase_categoria_licencia' => $this->clase_categoria_licencia,
            'fecha_infraccion' => $this->fecha_infraccion,
            'hora_infraccion' => $this->hora_infraccion,
            'descripcion_infraccion' => $this->descripcion_infraccion,
            'manifestacion_usuario' => $this->manifestacion_usuario,
            'estado_actual' => $estado_actual_infraction,
            'nro_boleta_pago' => $nro_boleta_pago,
            'fecha_registro_infraccion' => $today,
            'infraction_id' => $this->infraction_id,
            'inspector_id' => $this->inspector_id,
            'campus_id' => $this->campus_id,
            
        ]);

        $campus = Campus::find($this->campus_id);

        $extension = $this->file_pdf->extension();
        $folder_name = 'public/ActasDeControl/ACTA-00' .  $this->numero_acta . '-' . $campus->alias;
        $url_path = $this->file_pdf->storeAs($folder_name, $this->numero_acta .' - '. $this->apellidos_conductor.' '.$this->nombres_conductor.'.'.$extension);
        $created = $controlAct->file()->create(['url_path' => $url_path, 'size' => $this->file_pdf->getSize()]);

        if($created)
            session()->flash('message', 'Infracción con acta número '.$this->numero_acta.' registrada correctamente.');
            return redirect('/actas-de-control'); 
    }

}
