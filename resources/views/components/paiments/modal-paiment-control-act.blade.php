<div class="@if (!$isOpenModalPaimentControlAct) hidden @endif flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-600 bg-opacity-75">
    <div class="bg-white rounded-lg w-9/12">
        <form wire:submit.prevent="savePaiment" class="">
            <div class="flex flex-col p-4">
                <div class="flex items-center w-full border-b pb-4">
                    <div class="text-gray-900 font-medium text-lg font-semibold">Realizar Pago</div>
                    <svg wire:click="CloseOpenModalPaimentControlAct"
                            class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                    </svg>
                </div>
                @if ($errors->any() )
                    <div class="w-auto mx-auto mt-2 flex bg-red-100 rounded-lg p-4 text-sm text-red-700 ">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    <div role="alert">
                                        <div>
                                            <span class="font-medium">{{ '* ' . $error }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <fieldset class="border-2 border-gray-400 rounded-md p-2 mt-3 mb-3">
                    <legend class="ml-5 px-3 font-semibold">Detalles del pago:</legend>
                    <div class="grid grid-cols-4 my-2 gap-2">
                        <div class="h-auto grid grid-cols-1">
                            <label for="">Codigo Infracción:</label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $codigo_infraccion }}</h3>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for="">Fecha Infraccion:</label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ date('d/m/Y', strtotime($fecha_infraccion)) }}</h3>
                        </div>
                        <div class="h-auto grid grid-cols-1">
                            <label for="">Porcentaje UIT:</label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $uit_penalty }}</h3>
                        </div>
                        
                    </div>

                    <div class="grid grid-cols-4 my-2 gap-2">
                        <div class="grid grid-cols-1">
                            <label for="">Fecha de Pago:</label>
                            <input type="date" class="rounded-md" wire:model="fecha_pago">
                        </div>
                        <div class="h-auto grid grid-cols-1">
                            <label for="">Comprobante Pago:</label>
                             <select name="" id="" class="rounded-md" wire:model="type_proof_id">
                                <option value="" disabled>Selecciona</option>
                                  @foreach ($type_proofs as $type_proof)
                                        <option value="{{ $type_proof->id }}">{{ $type_proof->type }}</option>
                                  @endforeach
                             </select>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for="">Número de comprobante Pago:</label>
                            <input type="text" class="rounded-md" wire:model="numero_comprobante">
                        </div>
                        <div class="grid grid-cols-1">
                            <label for="">Monto a pagar:</label>
                            <input type="text" class="rounded-md" wire:model="monto_pagado">
                        </div>
                    </div>

                    <div class="flex justify-center text-sm underline">
                        <h3><strong>DETALLES DE LOS DESCUENTOS A APLICAR EN CASO CORRESPONDA:</strong></h3>
                    </div>
                    <div class="flex justify-center">
                        
                        <table class="">
                            <thead></thead>
                            <tbody class="text-xs">
                                @if (isset($fecha_pago))
                                    <tr class="">
                                        <td align="right"><strong>Dias hábiles a partir de la fecha de infraccion:</strong></td>
                                        <td align="left" class="pl-3 text-yellow-600"><strong>{{ $dias_habiles }}</strong></td>
                                    </tr>
                                    <tr class="">
                                        <td align="right"><strong>Aplica descuento de 5 dias hábiles:</strong></td>
                                        <td align="left" class="pl-3 text-yellow-600"><strong>{{ $aplica_descuento_cinco }}</strong></td>
                                    </tr>
                                @else
                                    <tr class="">
                                        <td align="right"><strong class="text-red-600">* Ingresar fecha de pago de la infracción</strong></td>
                                    </tr>
                                @endif
                                
                                @if ($dias_habiles > 5)
                                    @if ($controlAct->hasResolutionSancion($controlAct->id))
                                        @if ($fecha_pago >= $fecha_notificacion_sancion)
                                            <tr class="">
                                                <td align="right"><strong>Fecha de Notificacion de Resolución de Sanción:</strong></td>
                                                <td align="left" class="pl-3 text-yellow-600"><strong>{{ date('d/m/Y', strtotime($fecha_notificacion_sancion)) }}</strong></td>
                                            </tr>
                                            <tr class="">
                                                <td align="right"><strong>Dias hábiles a partir de la fecha de notificacion:</strong></td>
                                                <td align="left" class="pl-3 text-yellow-600"><strong>{{ $dias_habiles_notificacion }}</strong></td>
                                            </tr>
                                            <tr class="">
                                                <td align="right"><strong>Aplica descuento de Resolución de Sanción(15 dias):</strong></td>
                                                <td align="left" class="pl-3 text-yellow-600"><strong>{{ $aplica_descuento_quince }}</strong></td>
                                            </tr>
                                        @endif
                                    @endif
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="border-t-2 mt-5 mb-5">
                        <div class="flex justify-end font-semibold pt-3 text-sm uppercase mr-5">
                            <span class="text-xs">Monto de Infracción : S/ </span>
                            <span class="font-bold text-xs">{{ number_format($monto_total_infraccion, 2) }}</span>
                        </div>
                        @if ($controlAct->hasPaiment($controlAct->id))
                            <div class="flex justify-end font-semibold pt-4 text-sm uppercase mr-5">
                                <span class="text-xs">Monto pagado : S/ </span>
                                <span class="font-bold text-xs">{{ number_format($suma_montos_pagados, 2) }}</span>
                            </div>
                        @else
                            <div class="flex justify-end font-semibold pt-4 text-sm uppercase mr-5">
                                <span class="text-xs">Descuento 5 dias : S/ </span>
                                <span class="font-bold text-xs">{{ number_format($descuento_cinco_dias, 2) }}</span>
                            </div>
                            <div class="flex justify-end font-semibold pt-4 text-sm uppercase mr-5">
                                <span class="text-xs">Descuento 15 dias : S/ </span>
                                <span class="font-bold text-xs">{{ number_format($descuento_quince_dias, 2) }}</span>
                            </div>
                        @endif
                        
                        <div class="flex justify-end font-bold pt-3 text-sm uppercase mr-5 ">
                            <span>@if ($controlAct->hasPaiment($controlAct->id)) Pendiente por pagar : S/ @else Total a pagar : S/  @endif </span>
                            <span class="">{{ number_format($monto_total_pagar, 2) }}</span>
                        </div>
                    </div>
                </fieldset>
                <div class="ml-auto">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">Procesar
                    </button>
                    <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded"
                            wire:click="CloseOpenModalPaimentControlAct"
                            type="button"
                            data-dismiss="modal">Cancelar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>