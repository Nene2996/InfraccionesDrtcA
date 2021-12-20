<?php

namespace App\Http\Livewire\Paiment;

use App\Models\ControlAct;
use App\Models\ControlActResolution;
use App\Models\Paiment;
use App\Models\TypeProof;
use App\Models\Uit;
use Carbon\Carbon;
use Livewire\Component;

class PaimentControlAct extends Component
{
    // atributos de Acta de control
    public  $controlAct,
            $numero_acta,
            $ruc_dni,
            $nro_dni_conductor,
            $razon_social_nombre,
            $nro_habilitacion,
            $placa_vehiculo,
            $lugar_intervencion,
            $origen,
            $destino,
            $apellidos_nombres_conductor,
            $direccion_infractor,
            $nro_licencia,
            $fecha_infraccion,
            $hora_infraccion,
            $clase_categoria_licencia,
            $descripcion_infraccion,
            $manifestacion_usuario,
            $tipo_servicio,
            $estado_actual,
            $codigo_infraccion,
            $controlActResolution,
            $fecha_notificacion_sancion;

    //atributos de pago
    public  $fecha_pago,
            $numero_comprobante,
            $type_proofs,
            $type_proof_id = '';

    //detalles de pago
    public  $monto_pagado,
            $monto_total_pagar,
            $monto_total_infraccion,
            $monto_infraccion,
            $descuento,
            $pendiente_pagar,
            $suma_montos_pagados;

    //detalles de descuentos
    public  $descuento_cinco_dias,
            $descuento_quince_dias,
            $aplica_descuento_cinco,
            $aplica_descuento_quince;

    //dias habiles y calendarios
    public  $dias_habiles,
            $doas_calendarios,
            $dias_habiles_notificacion;


    protected $rules = [];
    protected $messages = [];

    public  $isOpenModalPaimentControlAct = false;

    public function mount(ControlAct $controlAct)
    {
        $this->controlAct = $controlAct; //Object $controlAct
        //$this->controlActId = $controlAct->numero_acta;
        $this->numero_acta = $controlAct->numero_acta;
        $this->nro_licencia = $controlAct->nro_licencia;
        $this->apellidos_nombres_conductor = $controlAct->apellidos_nombres_conductor;
        $this->nro_dni_conductor = $controlAct->nro_dni_conductor;
        $this->clase_categoria_licencia = $controlAct->clase_categoria_licencia;
        $this->razon_social_nombre = $controlAct->razon_social_nombre;
        $this->ruc_dni = $controlAct->ruc_dni;
        $this->placa_vehiculo = $controlAct->placa_vehiculo;
        $this->fecha_infraccion = $controlAct->fecha_infraccion;
        $this->hora_infraccion = $controlAct->hora_infraccion;
        $this->lugar_intervencion = $controlAct->lugar_intervencion;
        $this->origen = $controlAct->origen;
        $this->destino = $controlAct->destino;
        $this->codigo_infraccion = $controlAct->infractions->code;

        $this->type_proofs = TypeProof::all();
        $this->fecha_notificacion_sancion = '';
    }

    public function render()
    {
        if($this->controlAct->hasPaiment()){
            $paiments = $this->controlAct->paiments;
            $monto_total_pagado = 0;

            foreach($paiments as $paiment){
                $monto_total_pagar = $paiment->total_amount;
                $monto_total_pagado += $paiment->amount_paid;
            }
            $this->dias_habiles = '-';
            $this->aplica_descuento_cinco = 'Ya se realizo un pago anteriormente';
            $this->descuento_cinco_dias = 0;
            $this->monto_total_infraccion = $monto_total_pagar;
            $this->suma_montos_pagados = $monto_total_pagado;
            $this->monto_total_pagar = $monto_total_pagar - $monto_total_pagado;
            
        }else{
            $this->updatedFechaPago();
        }

        //validar las fechas
        $date_infraction = Carbon::parse($this->fecha_infraccion);
        $date_paiment = Carbon::parse($this->fecha_pago);
        $date_now = Carbon::now();

        if($date_infraction > $date_paiment || $date_paiment > $date_now){
            $this->dias_habiles = '-';
            $this->aplica_descuento_cinco = 'Existe inconsistencia con la fecha de pago';
            $this->descuento_cinco_dias = 0;
            $this->monto_total_infraccion = 0;
            $this->monto_total_pagar = 0;
            $this->suma_montos_pagados = 0;
        }

        $paiments = ControlAct::find($this->controlAct->id)->paiments;
        return view('livewire.paiment.paiment-control-act', ['paiments' => $paiments]);
    }

    public function OpenModalPaimentControlAct()
    {
        $this->isOpenModalPaimentControlAct = true;
        //$this->monto_total_pagar = $this->controlAct->infractions->pecuniary_sanction;
    }

    public function CloseOpenModalPaimentControlAct()
    {
        $this->isOpenModalPaimentControlAct = false;
        $this->resetInputs();
    }

    public function updatedFechaPago()
    {
        //obtener precios de UIT en base al fecha de pago
        if(isset($this->fecha_infraccion)){

            $date_infraction = Carbon::parse($this->fecha_infraccion);
            $date_paiment = Carbon::parse($this->fecha_pago);
            $date_now = Carbon::now();

            $year_infraction = $date_infraction->year;
            $year_paiment = $date_paiment->year;

            $year_uit_array = Uit::get('year')->toArray();
            $year_uit = array_column($year_uit_array, 'year');

            if(in_array($year_paiment ,$year_uit)){

                //$found_key = array_search($year_paiment, $year_uit);
                $getUit = Uit::where('year', $year_paiment)->first();

                //Obtenemos el monto de la UIT
                $uit_value = $getUit->amount_uit;

                //descuentos
                $descuento_cinco_dias = $this->controlAct->infractions->discount_five_days;
                $descuento_quince_dias = $this->controlAct->infractions->discount_fifteen_days;

                //obtener el porcentaje de UIT en base a la infraccion
                $uit_percentage_infraccion = $this->controlAct->infractions->uit_percentage;

                $this->dias_habiles = $this->getDiasHabiles($this->fecha_infraccion, $this->fecha_pago);

                //obtener el monto de que le corresponde a la infraccion
                $this->monto_infraccion = $uit_value * $uit_percentage_infraccion;

                if($descuento_cinco_dias > 0.1){

                    $this->aplica_descuento_cinco = 'Si.';

                    if($this->dias_habiles > 5){
                        
                        //Verificar si tiene resolucion de sancion
                        if($this->controlAct->hasResolutionSancion($this->controlAct->id)){
                            
                            $controlActResolution = ControlActResolution::where('control_act_id', $this->controlAct->id)->first();
                            $this->fecha_notificacion_sancion = $controlActResolution->date_notification_driver;

                            if($descuento_quince_dias > 0.1){
                                
                                $this->dias_habiles_notificacion = $this->getDiasHabiles($this->fecha_notificacion_sancion, $this->fecha_pago);
                                if($this->dias_habiles_notificacion > 15){
                                    $this->aplica_descuento_quince = 'Ya trancurrio mas de 15 dias hábiles.';
                                    $this->descuento_quince_dias = 0;
                                }else{
                                    $this->aplica_descuento_quince = 'Si.';
                                    $this->descuento_quince_dias = $this->monto_infraccion * $descuento_quince_dias;
                                }
                            }else{
                                $this->aplica_descuento_quince = 'La infracción no admite descuento.';
                            }
                        }else{
                            
                            $this->aplica_descuento_quince = 'La infracción no tiene Resolución de Sanción asignada.';
                            $this->dias_habiles_notificacion = 'La infracción no tiene Resolución de Sanción asignada.';
                            $this->descuento_quince_dias = 0;
                        }

                        $this->aplica_descuento_cinco = 'Ya trancurrio mas de 5 dias hábiles.';
                        $this->descuento_cinco_dias = 0;
                        $this->monto_total_infraccion = $this->monto_infraccion;
                        $this->monto_total_pagar = ($this->monto_infraccion - ($this->descuento_cinco_dias + $this->descuento_quince_dias));
                        
                    }else{
                        
                        $this->descuento_cinco_dias = $this->monto_infraccion * $descuento_cinco_dias;
                        $this->descuento_quince_dias = 0;
                        $this->monto_total_infraccion = $this->monto_infraccion;
                        $this->monto_total_pagar = ($this->monto_infraccion - ($this->descuento_cinco_dias + $this->descuento_quince_dias));

                    }
                    
                }else{
                    
                    //Verificar si tiene resolucion de sancion
                    if($this->controlAct->hasResolutionSancion($this->controlAct->id)){
                            
                        $controlActResolution = ControlActResolution::where('control_act_id', $this->controlAct->id)->first();
                        $this->fecha_notificacion_sancion = $controlActResolution->date_notification_driver;

                        if($descuento_quince_dias > 0.1){
                            
                            $this->dias_habiles_notificacion = $this->getDiasHabiles($this->fecha_notificacion_sancion, $this->fecha_pago);
                            if($this->dias_habiles_notificacion > 15){
                                $this->aplica_descuento_quince = 'Ya trancurrio mas de 15 dias hábiles.';
                                $this->descuento_quince_dias = 0;
                            }else{
                                $this->aplica_descuento_quince = 'Si.';
                                $this->descuento_quince_dias = $this->monto_infraccion * $descuento_quince_dias;
                            }
                        }else{
                            $this->aplica_descuento_quince = 'La infracción no admite descuento.';
                        }
                    }else{
                        
                        $this->aplica_descuento_quince = 'La infracción no tiene Resolución de Sanción asignada.';
                        $this->dias_habiles_notificacion = 'La infracción no tiene Resolución de Sanción asignada.';
                        $this->descuento_quince_dias = 0;
                    }

                    $this->aplica_descuento_cinco = 'La infracción no admite descuento.';
                    $this->descuento_cinco_dias = 0;
                    $this->monto_total_infraccion = $this->monto_infraccion;
                    $this->monto_total_pagar = ($this->monto_infraccion - ($this->descuento_cinco_dias + $this->descuento_quince_dias));
                }
                
            }else{
                $this->dias_habiles = '-';
                $this->descuento_cinco_dias = 0;
                $this->monto_total_infraccion = 0;
                $this->monto_total_pagar = 0;
            }
        }
    }



    public function getDiasHabiles($fechaInicio, $fechaFin)
    {
  
        //Dias Feriados y no laborables
        $feriados = array( 
            "2017-01-01", 
            "2017-04-13", 
            "2017-04-14", 
            "2017-04-16", 
            "2017-05-01", 
            "2017-06-29", 
            "2017-06-30", 
            "2017-07-27", 
            "2017-07-28", 
            "2017-07-29", 
            "2017-08-30", 
            "2017-10-08", 
            "2017-11-01", 
            "2017-12-08", 
            "2017-12-25",
            "2018-01-01", 
            "2018-01-02", 
            "2018-03-29", 
            "2018-03-30", 
            "2018-04-01", 
            "2018-05-01", 
            "2018-06-24", 
            "2018-06-29", 
            "2018-07-27", 
            "2018-07-28", 
            "2018-07-29", 
            "2018-08-30", 
            "2018-08-31", 
            "2018-10-08", 
            "2018-10-31", 
            "2018-11-01", 
            "2018-11-02", 
            "2018-12-08", 
            "2018-12-24", 
            "2018-12-25",
            "2019-01-01", 
            "2019-04-18", 
            "2019-04-19", 
            "2019-04-21", 
            "2019-05-01", 
            "2019-06-29", 
            "2019-07-28", 
            "2019-07-29", 
            "2019-07-30", 
            "2019-08-29", 
            "2019-08-30", 
            "2019-10-08", 
            "2019-10-31", 
            "2019-11-01", 
            "2019-12-08", 
            "2019-12-25",
            "2020-01-01", 
            "2020-04-09", 
            "2020-04-10", 
            "2020-05-01", 
            "2020-06-29",
            "2020-07-27", 
            "2020-07-28", 
            "2020-07-29", 
            "2020-08-30", 
            "2020-10-08", 
            "2020-10-09", 
            "2020-11-01", 
            "2020-12-08", 
            "2020-12-25", 
            "2020-12-31",
            "2021-01-01", 
            "2021-04-01", 
            "2021-04-02", 
            "2021-05-01", 
            "2021-06-29", 
            "2021-07-28",
            "2021-07-29", 
            "2021-08-30", 
            "2021-10-08", 
            "2021-11-01", 
            "2021-12-08", 
            "2021-12-25", 
             
            );

        $fechaInicio = strtotime($fechaInicio);
        $fechaFin = strtotime($fechaFin);

        //Incremento en un dia(Segundos)
        $diaIncrementado = 60*60*24;
        $diasHabiles = array();

        //recorrer desde la fecha inicio hasta la fecha fin aumentado en un dia
        for($i = ($fechaInicio + $diaIncrementado); $i <= $fechaFin; $i += $diaIncrementado){
            if(!in_array(date('N', $i), array(6, 7))){
                if(!in_array(date('Y-m-d', $i), $feriados)){
                    array_push($diasHabiles, date('Y-m-d', $i));
                }
            }            
        }

        return count($diasHabiles);

    }

    public function savePaiment()
    {
        $rules = $this->rules;
        $messages = $this->messages;

        $date = Carbon::now();
        $nowDate = $date->format('d-m-Y');

        $rules['fecha_pago'] = 'required|after_or_equal:' . $this->fecha_infraccion . '|before_or_equal:' . $nowDate;
        $rules['type_proof_id'] = 'required';
        $rules['numero_comprobante'] = 'required';
        $rules['monto_pagado'] = 'required';
        $rules['monto_pagado'] = 'lte:' . $this->monto_total_pagar . '|gt:0';

        $messages['fecha_pago.required'] = 'Es obligatorio ingresar la fecha de pago.';
        $messages['type_proof_id.required'] = 'Es obligatorio seleccionar el tipo de comprobante.';
        $messages['numero_comprobante.required'] = 'Es obligatorio ingresar el nro de comprobante.';
        $messages['monto_pagado.required'] = 'Es obligatorio ingresar el monto pagado.';
        $messages['monto_pagado.lte'] = 'El monto a pagar debe ser menor o igual a: ' . $this->monto_total_pagar . ' soles';
        $messages['monto_pagado.gt'] = 'El monto a pagar debe ser mayor a 0';
        $messages['fecha_pago.after_or_equal'] = 'La fecha de pago debe ser una fecha posterior o igual a la fecha de infracción';
        $messages['fecha_pago.before_or_equal'] = 'La fecha de pago debe ser una fecha  anterior o igual a la fecha actual';

        $this->validate($rules, $messages);

        if($this->controlAct->hasPaiment()){
            $pendiente_pagar = $this->monto_total_pagar - $this->monto_pagado;
        }else{
            $pendiente_pagar = $this->monto_total_infraccion - $this->monto_pagado;
        }
        

        $created = $this->controlAct->paiments()->create([
                                                            'date_payment' => $this->fecha_pago, 
                                                            'proof_number' => $this->numero_comprobante,
                                                            'discount' => $this->type_proof_id,
                                                            'total_amount' => $this->monto_total_infraccion,
                                                            'amount_paid' => $this->monto_pagado,
                                                            'pending_amount' => $pendiente_pagar,
                                                            'type_proof_id' => $this->type_proof_id,
                                                            'user_id' => auth()->user()->id,
                                                        ]);

        if($created){
            if($pendiente_pagar == 0){
                $this->controlAct->estado_actual = 'CANCELADO';
                $this->controlAct->save();
            }
            
            $this->CloseOpenModalPaimentControlAct();
        }

    }

    public function resetInputs()
    {
        $this->fecha_pago = '';
        $this->type_proof_id = '';
        $this->numero_comprobante = '';
        $this->monto_pagado = '';
        $this->monto_total_pagar = 0;
        $this->aplica_descuento_cinco = '';
        $this->dias_habiles = 0;
        $this->descuento_cinco_dias = 0;
        $this->descuento_quince_dias = 0;
        $this->monto_total_infraccion = 0;
        $this->suma_montos_pagados = 0;
        $this->resetValidation();
    }
}
