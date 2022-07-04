<?php

namespace App\Http\Livewire\Paiment;

use App\Models\Inspection;
use App\Models\InspectionActResolution;
use App\Models\Paiment;
use App\Models\TypeProof;
use App\Models\Uit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaimentInspectionAct extends Component
{
    use     WithFileUploads;
    public  $file_img, $paimentId;
    //Object 
    public  $inspection;

    public  $act_number,
            $names_business_name,
            $document_number,
            $licence_number,
            $date_infraction,
            $hour_infraction,
            $plate_number,
            $place,
            $status;

    //atributos de tabla de infracciones
    public  $description,
            $type,
            $qualification,
            $code,
            $infringement_agent,
            $uit_penalty,
            $uit_percentage,
            $pecuniary_sanction,
            $administrative_sanction,
            $discount_five_days,
            $discount_fifteen_days;
            

    //atributos de tabla resoluciones
    public  $fecha_notificacion_sancion;

    //atributos de tabla Tipo de Comprobantes de pago
    public  $type_proofs,
            $type_proof_id = '';

    //atributos de detalle de pago
    public  $fecha_pago,
            $numero_comprobante,
            $monto_pagado,
            $monto_total_pagar,
            $monto_total_infraccion,
            $monto_infraccion,
            $descuento,
            $pendiente_pagar,
            $suma_montos_pagados,
            $monto_pago_infraccion;

    //Atributos dias habiles y calendarios
    public  $dias_habiles,
            $dias_calendarios,
            $dias_habiles_notificacion;
    
    //atributos de descuentos
    public  $descuento_cinco_dias,
            $descuento_quince_dias,
            $aplica_descuento_cinco,
            $aplica_descuento_quince;

    public  $isOpenModalPaimentInspectionAct = false,
            $isOpenModalPaimentFile = false;

    protected $rules = [];
    protected $messages = [];

    public function mount(Inspection $inspection)
    {
        $this->inspection = $inspection;
        $this->names_business_name = $inspection->names_business_name;
        $this->act_number = $inspection->act_number;
        $this->document_number = $inspection->document_number;
        $this->licence_number = $inspection->licence_number;
        $this->date_infraction = $inspection->date_infraction;
        $this->hour_infraction = $inspection->hour_infraction;
        $this->plate_number = $inspection->vehicle->plate_number;

        $this->code = $inspection->infraction->code;
        $this->uit_percentage = $inspection->infraction->uit_percentage;

        $this->fecha_notificacion_sancion = '';
        $this->type_proofs = TypeProof::all();

        $this->uit_penalty = $inspection->infraction->uit_penalty;
        $this->monto_pago_infraccion = $inspection->infraction->pecuniary_sanction;
    }

    public function render()
    {
        if($this->inspection->hasPaiment($this->inspection->id)){
            //dd('tiene pago');
            $paiments = $this->inspection->paiments;
            $monto_total_pagado = 0;
            $descuento_aplicado = 0;

            foreach($paiments as $paiment){
                $monto_total_pagar = $paiment->total_amount;
                $monto_total_pagado += $paiment->amount_paid;
                $descuento_aplicado += $paiment->discount;
            }

            $this->dias_habiles = '-';
            $this->aplica_descuento_cinco = 'Ya se realizo un pago anteriormente';
            $this->descuento_cinco_dias = 0;
            $this->monto_total_infraccion = $monto_total_pagar;
            $this->suma_montos_pagados = $monto_total_pagado;
            $this->monto_total_pagar = $monto_total_pagar - ($monto_total_pagado + $descuento_aplicado);
            
        }else{

            //$this->updatedFechaPago();
        }
        //validar las fechas
        $date_infraction = Carbon::parse($this->date_infraction);
        $date_paiment = Carbon::parse($this->fecha_pago);
        $date_now = Carbon::now();

        if($date_infraction > $date_paiment || $date_paiment > $date_now){
            $this->dias_habiles = '-';
            $this->aplica_descuento_cinco = 'Existe inconsistencias con la fecha de pago';
            $this->descuento_cinco_dias = 0;
            $this->monto_total_infraccion = 0;
            $this->monto_total_pagar = 0;
            $this->suma_montos_pagados = 0;
        }
        $paiments = Inspection::find($this->inspection->id)->paiments;
        return view('livewire.paiment.paiment-inspection-act', ['paiments' => $paiments]);
    }

    public function updatedFechaPago()
    {
        //obtener precios de UIT en base al fecha de pago
        if(isset($this->date_infraction)){
            $date_paiment = Carbon::parse($this->fecha_pago);

            $year_paiment = $date_paiment->year;
            $year_uit_array = Uit::get('year')->toArray();
            $year_uit = array_column($year_uit_array, 'year');

            if(in_array($year_paiment ,$year_uit)){
                $getUit = Uit::where('year', $year_paiment)->first();
                $uit_value = $getUit->amount_uit; //Obtener el monto UIT
                //descuentos
                $descuento_cinco_dias = $this->inspection->infraction->discount_five_days;
                $descuento_quince_dias = $this->inspection->infraction->discount_fifteen_days;
                //obtener el porcentaje de UIT en base a la infraccion
                $uit_percentage_infraccion = $this->inspection->infraction->uit_percentage;

                $this->dias_habiles = $this->getDiasHabiles($this->date_infraction, $this->fecha_pago);
                //obtener el monto de que le corresponde a la infraccion
                $this->monto_infraccion = $uit_value * $uit_percentage_infraccion;

                //Verificar si existe resolucion de sancion asociada
                if($this->inspection->hasResolutionSancion($this->inspection->id)){

                    foreach ($this->inspection->resolutions as $resolution) {
                        if ($resolution->type == 'RESOLUCIÓN DE SANCION') {
                            $this->fecha_notificacion_sancion = $resolution->pivot->date_notification_driver;
                            $anio_informe_sancion = $resolution->document_year;
                        }
                    }
                    //validar que la fecha de pago sea mayor o igual a la fecha de notificación
                    if ($date_paiment >= Carbon::parse($this->fecha_notificacion_sancion)) {
                        //validar la sede del Acta
                        if ($this->inspection->campus->id == 1) {
                            if(in_array($anio_informe_sancion, $year_uit)){
                                $monto_uit = Uit::where('year', $anio_informe_sancion)->first();
                                $total_pagar_sindescuento = $this->inspection->infraction->uit_percentage * $monto_uit->amount_uit;
                            }
                            $this->dias_habiles_notificacion = $this->getDiasHabiles($this->fecha_notificacion_sancion, $this->fecha_pago);
                            $descuento_quince_dias = $this->inspection->infraction->discount_fifteen_days;
                            if($this->dias_habiles_notificacion >= 0 && $this->dias_habiles_notificacion <= 15){
                                if($descuento_quince_dias > 0.1){
                                    $this->aplica_descuento_cinco = 'No Aplica';
                                    $this->aplica_descuento_quince = 'Si Aplica.';
                                    $this->descuento_quince_dias = $total_pagar_sindescuento * 0.3;
                                    $this->monto_total_infraccion = $total_pagar_sindescuento;
                                    $this->monto_total_pagar = ($total_pagar_sindescuento - $this->descuento_quince_dias);
                                    //consultar a Lila
                                }else{
                                    $this->aplica_descuento_cinco = 'No Aplica';
                                    $this->aplica_descuento_quince = 'La infracción no admite descuento.';
                                    $this->descuento_quince_dias = 0;
                                    $this->monto_total_infraccion = $total_pagar_sindescuento;
                                    $this->monto_total_pagar = ($total_pagar_sindescuento - $this->descuento_quince_dias);
                                }
                            }else{
                                $this->aplica_descuento_cinco = 'No Aplica';
                                $this->aplica_descuento_quince = 'Ya trancurrio mas de 15 dias hábiles.';
                                $this->descuento_quince_dias = 0;
                                $this->monto_total_infraccion = $total_pagar_sindescuento;
                                $this->monto_total_pagar = ($total_pagar_sindescuento - $this->descuento_quince_dias);
                            }
                        } elseif ($this->inspection->campus->id == 2) {

                            $this->dias_habiles_notificacion = $this->getDiasHabiles($this->fecha_notificacion_sancion, $this->fecha_pago);
                            $descuento_quince_dias = $this->inspection->infraction->discount_fifteen_days;
                            if($this->dias_habiles_notificacion >= 0 && $this->dias_habiles_notificacion <= 15){
                                if($descuento_quince_dias > 0.1){
                                    $this->aplica_descuento_cinco = 'No Aplica';
                                    $this->aplica_descuento_quince = 'Si Aplica.';
                                    $this->descuento_quince_dias = $this->monto_infraccion * $descuento_quince_dias;
                                    $this->monto_total_infraccion = $this->monto_infraccion;
                                    $this->monto_total_pagar = ($this->monto_infraccion -  $this->descuento_quince_dias);
                                }else{
                                    $this->aplica_descuento_quince = 'La infracción no admite descuento.';
                                    $this->descuento_quince_dias = 0;
                                    $this->monto_total_infraccion = $this->monto_infraccion;
                                    $this->monto_total_pagar = ($this->monto_infraccion -  $this->descuento_quince_dias);
                                }
                            }else{
                                $this->aplica_descuento_cinco = 'No Aplica';
                                $this->aplica_descuento_cinco = 'No Aplica.';
                                $this->aplica_descuento_quince = 'Ya trancurrio mas de 15 dias hábiles.';
                                $this->descuento_quince_dias = 0;
                                $this->monto_total_infraccion = $this->monto_infraccion;
                                $this->monto_total_pagar = ($this->monto_infraccion -  $this->descuento_quince_dias);
                            }
                        }
                    }
                }else{
                    if( $this->dias_habiles >= 0 && $this->dias_habiles <= 5){
                        if($descuento_cinco_dias > 0.1){
                            $this->aplica_descuento_cinco = 'Si.';
                            $this->descuento_cinco_dias = $this->monto_infraccion * $descuento_cinco_dias;
                            $this->monto_total_infraccion = $this->monto_infraccion;
                            $this->monto_total_pagar = ($this->monto_infraccion -  $this->descuento_cinco_dias);
                        }else{
                            $this->aplica_descuento_cinco = 'La infracción no admite descuento.';
                            $this->descuento_cinco_dias = 0;
                            $this->monto_total_infraccion = $this->monto_infraccion;
                            $this->monto_total_pagar = ($this->monto_infraccion -  $this->descuento_cinco_dias);
                        }
                    }else{
                        $this->aplica_descuento_cinco = 'Ya trancurrio mas de 5 dias hábiles.';
                        $this->descuento_cinco_dias = 0;
                        $this->monto_total_infraccion = $this->monto_infraccion;
                        $this->monto_total_pagar = ($this->monto_infraccion -  $this->descuento_cinco_dias);
                    }
                }
            }else{
                $this->dias_habiles = '-';
                $this->descuento_cinco_dias = 0;
                $this->monto_total_infraccion = 0;
                $this->monto_total_pagar = 0;
            }
        }
    }

    public function savePaiment()
    {
        //dd($this->descuento_cinco_dias);

        $rules = $this->rules;
        $messages = $this->messages;

        $date = Carbon::now();
        $nowDate = $date->format('d-m-Y');

        $rules['fecha_pago'] = 'required|after_or_equal:' . $this->date_infraction . '|before_or_equal:' . $nowDate;
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

        if($this->descuento_cinco_dias > 0){
            $descuento_aplicado = $this->descuento_cinco_dias;
        }elseif($this->descuento_quince_dias > 0){
            $descuento_aplicado = $this->descuento_quince_dias;
        }elseif($this->descuento_quince_dias == 0 || $this->descuento_cinco_dias == 0){
            $descuento_aplicado = 0;
        }

        if($this->inspection->hasPaiment($this->inspection->id)){
            $pendiente_pagar = $this->monto_total_pagar - $this->monto_pagado;
        }else{
            $pendiente_pagar = $this->monto_total_infraccion - ($this->monto_pagado + $descuento_aplicado);
        }
        
        
        $created = $this->inspection->paiments()->create([
                                                            'date_payment' => $this->fecha_pago, 
                                                            'proof_number' => $this->numero_comprobante,
                                                            'discount' => $descuento_aplicado,
                                                            'total_amount' => $this->monto_total_infraccion,
                                                            'amount_paid' => $this->monto_pagado,
                                                            'pending_amount' => $pendiente_pagar,
                                                            'type_proof_id' => $this->type_proof_id,
                                                            'user_id' => auth()->user()->id,
                                                        ]);

        if($created){
            if($pendiente_pagar == 0){
                $this->inspection->update([
                    'status' => 'CANCELADO'
                ]);
            }
            
            $this->CloseOpenModalPaimentInspectionAct();
        }
    }

    public function saveFileImg()
    {
        /*
        $rules = $this->rules;
        $messages = $this->messages;

        $rules['file_img'] = 'required';
        $messages['file_img.required'] = 'Es obligatorio adjuntar el comprobante de pago.';
        $this->validate($rules, $messages);
        */
        $paiment = Paiment::find($this->paimentId);
        $user = auth()->user();
        if(!is_null($this->file_img)){
            if(isset($paiment->url_path_image_vaucher)){
                $url_path_before = $paiment->url_path_image_vaucher;
                Storage::delete($url_path_before);

                $extension = $this->file_img->extension();
                $folder_name = 'public/ActasDeFiscalizacion/ACTA-00' . $this->act_number . '-' . $this->inspection->campus->alias . '/COMPROBANTE_PAGO';
                $url_path = $this->file_img->storeAs($folder_name, $paiment->typeProof->type .' - '. $paiment->proof_number .'.'. $extension);
    
                $saved = $paiment->update([
                    'url_path_image_vaucher' => $url_path
                ]);
    
                if($saved){
                    session()->flash('message', ' El comprobante de pago se adjunto correctamente a la Infraccion con nro de Acta:'.$this->act_number);
                    return redirect('/actas-de-fiscalizacion'); 
                }
                
            }else{
                $extension = $this->file_img->extension();
                $folder_name = 'public/ActasDeFiscalizacion/ACTA-00' . $this->act_number . '-' . $this->inspection->campus->alias  . '/COMPROBANTE_PAGO';
                $url_path = $this->file_img->storeAs($folder_name, $paiment->typeProof->type .' - '. $paiment->proof_number .'.'. $extension);
    
                $saved = $paiment->update([
                    'url_path_image_vaucher' => $url_path
                ]);
    
                if($saved){
                    session()->flash('message', ' El comprobante de pago se adjunto correctamente a la Infraccion con nro de Acta:'.$this->act_number);
                    return redirect('/actas-de-fiscalizacion'); 
                }
            }
        }

    }

    public function DeletePaiment($paimentId)
    {
        $paiment =  Paiment::find($paimentId);
        if($paiment){
            $url_path_before = $paiment->url_path_image_vaucher;
            Storage::delete($url_path_before);
            $paiment->delete();
        } 
    }
    public function OpenModalPaimentInspectionAct()
    {
        $this->isOpenModalPaimentInspectionAct = true;
        //$this->monto_total_pagar = $this->inspection->infractions->pecuniary_sanction;
    }

    public function CloseOpenModalPaimentInspectionAct()
    {
        $this->isOpenModalPaimentInspectionAct = false;
        $this->resetInputs();
    }
    public function OpenModalPaimentFile($paimentId)
    {
        $this->paimentId = $paimentId;
        $this->isOpenModalPaimentFile = true;
    }

    public function CloseModalPaimentFile()
    {
        $this->isOpenModalPaimentFile = false;
        $this->resetInputs();
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
            "2021-12-24",
            "2021-12-25", 
            "2021-12-27",
            "2021-12-31",
            "2022-01-03",
             
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

    public function resetInputs()
    {
        $this->fecha_pago = null;
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
