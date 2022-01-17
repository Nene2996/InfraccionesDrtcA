<?php

namespace App\Http\Livewire\ControlAct;

use App\Models\Campus;
use App\Models\ControlAct;
use App\Models\Infraction;
use App\Models\Inspector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditControlAct extends Component
{
    //Archivos con livewire
    use WithFileUploads;
    public  $file_pdf,
            $iteration;
    
    public  $controlAct,
            $ruc_dni,
            $tipo_servicio,
            $apellidos_conductor,
            $nombres_conductor,
            $nro_licencia_conductor,
            $clase_cat_licencia,
            $nro_habilitacion,
            $campus,
            $campus_id;

    public  $select_dni_ruc;

    public  $label_razon_social_nombre,
            $value_razon_social_nombre;
    
    public  $isDisabled_input_select;

    public  $posee_licencia;

    public  $infractions,
            $infraction_type,
            $infraction_id;

    public  $inspectors,
            $inspector_id;

    protected $rules = [
        'controlAct.numero_acta' => 'required|regex:/^[0-9]+$/',
        'tipo_servicio' => 'required',
        'controlAct.placa_vehiculo' => 'required|regex:/^[A-Z,0-9]{3}[-][A-Z,0-9]{3}+$/',
        'controlAct.lugar_intervencion' => 'required',
        'controlAct.origen' => 'required',
        'controlAct.destino' => 'required',
        'controlAct.nro_dni_conductor' => 'required|regex:/^[0-9]{8}$/',
        'apellidos_conductor' => 'required',
        'nombres_conductor' => 'required',
        'controlAct.fecha_infraccion' => 'required|date',
        'controlAct.hora_infraccion' => 'required',
        'infraction_type' => 'required',
        'controlAct.descripcion_infraccion' => 'required',
        'controlAct.manifestacion_usuario' => 'nullable',
        'inspector_id' => 'required', 
    ];

    protected $messages = [
        'controlAct.numero_acta.required' => 'El nro de Acta de Control es obligatorio.',
        'controlAct.numero_acta.regex' => 'El nro de Acta de Control no es válido',
        'tipo_servicio.required' => 'Selecciona el tipo de servicio',
        'controlAct.placa_vehiculo.required' => 'El nro de placa vehicular es obligatorio',
        'controlAct.placa_vehiculo.regex' => 'El nro de placa ingresado no es válido',
        'controlAct.lugar_intervencion.required' => 'El lugar de intervención es obligatorio',
        'controlAct.origen.required' => 'El origen es obligatorio',
        'controlAct.destino.required' => 'El destino es obligatorio',
        'controlAct.nro_dni_conductor.required' => 'El número de DNI es obligatorio',
        'controlAct.nro_dni_conductor.regex' => 'El número de DNI debe ser de 8 digitos numéricos',
        'apellidos_conductor.required' => 'Los apellidos del conductor es obligatorio',
        'nombres_conductor.required' => 'Los nombres del conductor es obligatorio',
        'infraction_type.required' => 'Selecciona el tipo de infracción',
        'controlAct.descripcion_infraccion.required' => 'LLenar la descripcion de la infracción',
        'inspector_id.required' => 'Selecciona el nombre del inspector',
    ];

    public function mount(ControlAct $controlAct)
    {
        $this->controlAct = $controlAct;
        $this->ruc_dni = $controlAct->ruc_dni;
        $this->nro_habilitacion = $controlAct->nro_habilitacion;
        $this->value_razon_social_nombre = $controlAct->razon_social_nombre;
        $this->validateisDniRuc($this->ruc_dni);
        $this->validateGetTipoServicio();

        $apellidos_nombres_conductor = $controlAct->apellidos_nombres_conductor;
        
        if( isset($apellidos_nombres_conductor) && !empty($apellidos_nombres_conductor) ){
            $array_sin_coma = str_replace(',', '', $apellidos_nombres_conductor);
            $particion = explode(" ", $array_sin_coma);
            switch(count($particion)){
                case 1: 
                    $this->apellidos_conductor = $particion[0];
                    break;

                case 2: 
                    $this->apellidos_conductor = $particion[0].' '.$particion[1];
                    break;
                
                case 3: 
                    $this->apellidos_conductor = $particion[0].' '.$particion[1];
                    $this->nombres_conductor = $particion[2];
                    break;

                case 4: 
                    $this->apellidos_conductor = $particion[0].' '.$particion[1];
                    $this->nombres_conductor = $particion[2].' '.$particion[3];
                    break;
                
            } 
        }else{
            $this->apellidos_conductor = 'NO ESPECIFICADO';
            $this->nombres_conductor = 'NO ESPECIFICADO';
        }

        if(!empty($controlAct->nro_licencia))
        {
            if($controlAct->nro_licencia == 'NO CUENTA CON LICENCIA DE CONDUCIR')
            {
                $this->posee_licencia = 1;
            }else{
                $this->posee_licencia = 0;
                $this->nro_licencia_conductor = $controlAct->nro_licencia;
            }
            
        }else{
            $this->posee_licencia = 1;
        }

        $this->getClaseCatLicenciaConductor($controlAct->clase_categoria_licencia);

        $this->infraction_type = $controlAct->infractions->type;
        $this->infraction_id = $controlAct->infractions->id;
        
        $this->campus = $controlAct->campus->campus_name;
        $this->campus_id = $controlAct->campus->id;
        
        $this->inspectors = Campus::find(auth()->user()->campus->id)->inspectors;
        $this->inspector_id = $controlAct->inspector->id;
        

    }

    public function render()
    {

        $this->label_razon_social_nombre = ($this->select_dni_ruc == 0) 
            ? $this->label_razon_social_nombre = 'Apellidos y Nombres' 
            : $this->label_razon_social_nombre = 'Razón Social';
        
        if($this->posee_licencia == '0')
        {
            $this->isDisabled_input_select = FALSE;
            
        }else
        {
            $this->isDisabled_input_select = true;
            $this->nro_licencia_conductor = 'NO CUENTA CON LICENCIA DE CONDUCIR';
            $this->clase_cat_licencia = 'NO CUENTA CON LICENCIA DE CONDUCIR';
        }

        $this->infractions = Infraction::where('type', $this->infraction_type)->get();
        return view('livewire.control-act.edit-control-act');
    }

    public function validateisDniRuc($value_dni_ruc)
    {
        switch(strlen($value_dni_ruc)){
            case 8: 
                $this->select_dni_ruc = "0";
                $this->label_razon_social_nombre = "Apellidos y Nombres";
                break;

            case 11: 
                $this->select_dni_ruc = "1";
                $this->label_razon_social_nombre = "Razón Social";
                break;
            
            default: 
                $this->select_dni_ruc = "0";
                $this->label_razon_social_nombre = "Apellidos y Nombres";
                break;
        }

    }

    public function validateGetTipoServicio()
    {
        $tipo_servicio = $this->controlAct->tipo_servicio;

        switch($tipo_servicio){
            case 'PASAJEROS': 
                $this->tipo_servicio = "PASAJEROS";
                break;

            case 'MERCANCIAS': 
                $this->tipo_servicio = "MERCANCIAS";
                break;

            default: 
                $this->tipo_servicio = "NO ESPECIFICADO";
                break;

        }
    }

    public function getClaseCatLicenciaConductor($clase_cat_licencia)
    {
        switch($clase_cat_licencia){
            case ('AI'): 
                $this->clase_cat_licencia = 'A-I';
                break;
            case ('A-I'): 
                $this->clase_cat_licencia = 'A-I';
                break;
            case ('A1'): 
                $this->clase_cat_licencia = 'A-I';
                break;
            
            case ( "AIIA"): 
                $this->clase_cat_licencia = 'A-II-A';
                break;
            case ("A-II-A" ): 
                $this->clase_cat_licencia = 'A-II-A';
                break;
            case ( "AIIa"): 
                $this->clase_cat_licencia = 'A-II-A';
                break;

            case ('AIIB'): 
                $this->clase_cat_licencia = 'A-II-B';
                break;
            case ('A-II-B'): 
                $this->clase_cat_licencia = 'A-II-B';
                break;
            case ('AII B'): 
                $this->clase_cat_licencia = 'A-II-B';
                break;
            case ('A-IIB'): 
                $this->clase_cat_licencia = 'A-II-B';
                break;
            

            case ('AIIIA'): 
                $this->clase_cat_licencia = 'A-III-A';
                break;
            case ('A-III-A'): 
                $this->clase_cat_licencia = 'A-III-A';
                break;
            case ('AIII-A' ): 
                $this->clase_cat_licencia = 'A-III-A';
                break;
            case ('A-IIIa'): 
                $this->clase_cat_licencia = 'A-III-A';
                break;

            case ('AIIIB'): 
                $this->clase_cat_licencia = 'A-III-B';
                break;
            case ('A-III-B'): 
                $this->clase_cat_licencia = 'A-III-B';
                break;
            case ('AIII-B'): 
                $this->clase_cat_licencia = 'A-III-B';
                break;
            case ('A-IIIb'): 
                $this->clase_cat_licencia = 'A-III-B';
                break;

            case ('AIIIC'): 
                $this->clase_cat_licencia = 'A-III-C';
                break;
            case ('A-III-C'): 
                $this->clase_cat_licencia = 'A-III-C';
                break;
            case ('A-IIIC'): 
                $this->clase_cat_licencia = 'A-III-C';
                break;
            case ('A-3-C'): 
                $this->clase_cat_licencia = 'A-III-C';
                break;

            case ('AIV'): 
                $this->clase_cat_licencia = 'A-IV';
                break;
            case ('A-IV'): 
                $this->clase_cat_licencia = 'A-IV';
                break;

            case 'INTERNACIONAL': 
                $this->clase_cat_licencia = 'INTERNACIONAL';
                break;
            
            case 'NO CUENTA CON LICENCIA DE CONDUCIR':
                $this->clase_cat_licencia = 'NO CUENTA CON LICENCIA DE CONDUCIR';
                break;

            case 'No cuenta con licencia de conducir';
                $this->clase_cat_licencia = 'NO CUENTA CON LICENCIA DE CONDUCIR';
                break;
            
            default: 
                $this->clase_cat_licencia = 'NO ESPECIFICADO';
                break;
        }
    }

    public function save()
    {
        
        $rules = $this->rules;
        $messages = $this->messages;

        $rules['controlAct.numero_acta'] = Rule::unique('control_act', 'numero_acta')->ignore($this->controlAct->id)->where('campus_id', auth()->user()->campus->id);
                        
        $messages['controlAct.numero_acta.unique'] = 'El nro de Acta de Control ya fue registrado anteriormente';

        $data = [];
        if($this->select_dni_ruc == 0) {
            $rules['ruc_dni'] = 'required|regex:/^[0-9]{8}$/';
            $rules['value_razon_social_nombre'] = 'required';

            $messages['ruc_dni.required'] = 'El número de DNI es obligatorio';
            $messages['ruc_dni.regex'] = 'El número de DNI debe tener 8 digitos';
            $messages['value_razon_social_nombre.required'] = 'Es obligatorio ingresar los Nombres y Apellidos';
        }else{

            $rules['ruc_dni'] = 'required|regex:/^[0-9]{11}$/';
            $rules['value_razon_social_nombre'] = 'required';

            $messages['ruc_dni.required'] = 'El número de RUC es obligatorio';
            $messages['ruc_dni.regex'] = 'El número de RUC debe tener 11 digitos';
            $messages['value_razon_social_nombre.required'] = 'Es obligatorio ingresar la Razón Social';
        }

        if($this->posee_licencia == '0')
        {
            $rules['nro_licencia_conductor'] = 'required|regex:/^[A-Z]{1}[0-9]{8}$/';
            $rules['clase_cat_licencia'] = 'required';

            $messages['nro_licencia_conductor.required'] = 'El número de Licencia de Conducir es obligatorio';
            $messages['nro_licencia_conductor.regex'] = 'El número ingresado de Licencia de Conducir no es válido';
            $messages['clase_cat_licencia.required'] = 'Es obligatorio seleccionar la Cat. de Licencia de Conducir';

            $data['nro_licencia'] = $this->nro_licencia_conductor;
            $data['clase_categoria_licencia'] = $this->clase_cat_licencia;
        }else{
            $data['nro_licencia'] = 'NO CUENTA CON LICENCIA DE CONDUCIR';
            $data['clase_categoria_licencia'] = 'NO CUENTA CON LICENCIA DE CONDUCIR';
        }

        $this->validate($rules, $messages);
        
        //$pecuniary_sanction = $this->controlAct->infractions->pecuniary_sanction;

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

        $data['ruc_dni'] = $this->ruc_dni;
        $data['razon_social_nombre'] = $this->value_razon_social_nombre;
        $data['tipo_servicio'] = $this->tipo_servicio;
        $data['nro_habilitacion'] = $this->nro_habilitacion;
        $data['apellidos_nombres_conductor'] = $this->apellidos_conductor.', '.$this->nombres_conductor;
        $data['estado_actual'] = $estado_actual_infraction;
        $data['nro_boleta_pago'] = $nro_boleta_pago;
        $data['infraction_id'] = $this->infraction_id;
        $data['inspector_id'] = $this->inspector_id;
        $data['campus_id'] = $this->campus_id;
        //dd($data);
        $this->controlAct->fill($data);
        $saved = $this->controlAct->save();

        $campus = Campus::find($this->campus_id);

        if(!is_null($this->file_pdf)){
            if(isset($this->controlAct->file->url_path)){ // modificas/eliminas porque ya existe archivo asociado
                $url_path_before = $this->controlAct->file->url_path;
                Storage::delete($url_path_before);
    
                $extension = $this->file_pdf->extension();
                $folder_name = 'public/ActasDeControl/ACTA-00' .  $this->controlAct->numero_acta. '-' . $campus->alias;
                $url_path = $this->file_pdf->storeAs($folder_name, $this->controlAct->numero_acta .' - '. $this->apellidos_conductor.' '.$this->nombres_conductor.'.'.$extension);
                $this->controlAct->file()->update(['url_path' => $url_path, 'size' => $this->file_pdf->getSize()]);
    
            }else{// crea/almacena el archivo pdf
    
                $extension = $this->file_pdf->extension();
                $folder_name = 'public/ActasDeControl/ACTA-00' .  $this->controlAct->numero_acta. '-' . $campus->alias;
                $url_path = $this->file_pdf->storeAs($folder_name, $this->controlAct->numero_acta .' - '. $this->apellidos_conductor.' '.$this->nombres_conductor.'.'.$extension);
                $this->controlAct->file()->create(['url_path' => $url_path, 'size' => $this->file_pdf->getSize()]);
            }
        }


        if($saved )
            
            session()->flash('message', 'Se ha realizado correctamente el proceso de actualización de la Acta de Control nro: '.$this->controlAct->numero_acta);

        return redirect('/actas-de-control');

    }
}
