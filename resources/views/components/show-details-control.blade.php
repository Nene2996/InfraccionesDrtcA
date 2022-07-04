<div>
    <x-jet-dialog-modal maxWidth="6xl">
        <x-slot name="title">
            <strong>{{ __('Detalles del Acta de Control') }}</strong>
        </x-slot>
        <x-slot name="content">
            <div>
                <div class="flex justify-center">
                   <table>
                       <thead></thead>
                       <tbody class="text-xs">
                           <tr>
                               <td align="center"  colspan="2" class="text-sm underline "><h3><strong>DATOS DEL CONDUCTOR</strong></h3></td>
                           </tr>
                           <tr>
                               <td  align="right"><strong>APELLIDOS Y NOMBRES:</strong></td>
                               <td class="pl-3 text-yellow-600"><strong>{{ $apellidos_nombres_conductor }}</strong></td>
                           </tr>
                           <tr>
                               <td align="right"><strong>NRO. DE DOCUMENTO DE IDENTIDAD:</strong></td>
                               <td class="pl-3 text-yellow-600"><strong>{{ $nro_dni_conductor }}</strong></td>
                           </tr>
                           <tr>
                               <td align="right"><strong>NRO. DE LICENCIA:</strong> </td>
                               <td class="pl-3 text-yellow-600"><strong>{{ $nro_licencia }}</strong></td>
                           </tr>
                           <tr>
                               <td align="right"><strong>CLASE Y CATEGORIA:</strong> </td>
                               <td class="pl-3 text-yellow-600"><strong>{{ $clase_categoria_licencia }}</strong></td>
                           </tr>
                           <tr>
                               <td></td>
                           </tr>
                           <tr>
                               <td align="center"  colspan="2" class="text-sm underline "><h3><strong>DATOS DEL TRANSPORTISTA</strong></h3></td>
                           </tr>
                           <tr>
                               <td align="right"><strong>RUC/DNI:</strong></td>
                               <td class="pl-3 text-yellow-600 font-bold">{{ $ruc_dni }}</td>
                           </tr>
                           <tr>
                               <td align="right"><strong>NOMBRE O RAZON SOCIAL:</strong></td>
                               <td class="pl-3 text-yellow-600 font-bold">{{ $razon_social_nombre }}</td>
                           </tr>
                       </tbody>
                   </table>
                </div>
                <div>
                    <div class="flex justify-center">
                        <label for="" class="text-sm mt-3 font-extrabold">DETALLE DE LA CONDUCTA INFRACTORA DETECTADA</label>
                    </div>
                    <div class="flex justify-center text-xs px-2">
                        <table>
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-3">Nro de Acta</th>
                                    <th class="px-3">Cod Infracción</th>
                                    <th class="px-3">Descripcion</th>
                                    <th class="px-3">Sancion Pecuniaria</th>
                                    <th class="px-3">Sancion Administrativa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-3 text-center">{{ $numero_acta }}</td>
                                    <td class="border px-3 text-center">{{ $infraction_code }}</td>
                                    <td class="border px-3 text-center">{{ $infraction_description }}</td>
                                    <td class="border px-3 text-center">{{ $infraction_uit_penalty }}</td>
                                    <td class="border px-3 text-center">{{ $infraction_administrative_sanction }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-center my-2">
                        <table>
                            <thead>
                                <tr class="bg-gray-200 text-xs">
                                    <th class="px-3">Lugar de Intervención</th>
                                    <th class="px-3">Fecha</th>
                                    <th class="px-3">Hora</th>
                                    <th class="px-3">Nro Placa Vehículo</th>
                                    <th class="px-3">Tipo de Servicio</th>
                                    <th class="px-3">Estado</th>
                                    @if ($estado_actual == 'CANCELADO' && $hasPaiments == false)
                                        <th class="px-3">Nro de Comprobante de Pago</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-3 text-xs text-center">{{ $lugar_intervencion }}</td>
                                    <td class="border px-3 text-xs w-24 text-center">{{ date('d/m/Y', strtotime($fecha_infraccion)) }}</td>
                                    <td class="border px-3 text-xs text-center">{{ $hora_infraccion }}</td>
                                    <td class="border px-3 text-xs w-20 text-center">{{ $placa_vehiculo }}</td>
                                    <td class="border px-3 text-xs text-center">{{ $tipo_servicio }}</td>
                                    <td class="border px-3 text-xs">{{ $estado_actual }}</td>
                                    @if ($estado_actual == 'CANCELADO' && $hasPaiments == false)
                                        <td class="border px-3 text-xs">{{ $nro_comprobante }}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if ($hasResolutions)
                <div class="flex justify-center mt-1">
                    <label for="" class="text-sm font-extrabold">DETALLE DE LAS RESOLUCIONES ASOCIADAS</label>
                </div>
                <div class="flex justify-center">
                    <table>
                        <thead>
                            <tr class="bg-gray-200 text-xs">
                                <th class="border px-3">Tipo de Resolución</th>
                                <th class="border px-3">Fecha Emisión</th>
                                <th class="border px-3">Nombre Resolución</th>
                                <th class="border px-3">Documento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resolutions as $resolution)
                                <tr class="text-center">
                                    <td class="border px-3 text-xs text-center">{{ $resolution->type }}</td>
                                    <td class="border px-3 text-xs text-center">{{ date('d/m/Y', strtotime($resolution->date_resolution)) }}</td>
                                    <td class="border px-3 text-xs">{{ $resolution->title }}</td>
                                    <td class="border px-3 text-xs text-center">
                                    @if (isset($resolution->url))
                                    <div class="px-6 py-1 whitespace-nowrap text-red-600">
                                        <a href="{{ Storage::url($resolution->url) }}" target="_blank">
                                            <span class="">
                                                <i class="far fa-file-pdf fa-lg"></i>
                                            </span>
                                        </a>
                                    </div>
                                    @else
                                        <div class="text-xs py-1">
                                            <p>No adjuntado</p>
                                        </div>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            @if ($hasPaiments)
            <div class="flex justify-center">
                <label for="" class="text-sm font-extrabold">DETALLE DE LOS PAGOS ASOCIADOS</label>
            </div>
            <div class="flex justify-center">
                <table>
                    <thead>
                        <tr class="bg-gray-200 text-xs">
                            <th class="border px-3">Fecha Pago</th>
                            <th class="border px-3">Tipo Comprobante</th>
                            <th class="border px-3">Nro Comprobante</th>
                            <th class="border px-3">Monto infracción</th>
                            <th class="border px-3">Descuento aplicado</th>
                            <th class="border px-3">Monto pagado</th>
                            <th class="border px-3">Pendiente por pagar</th>
                            <th class="border px-3">Comprobante</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paiments as $paiment)
                            <tr class="text-center">
                                <td class="border px-3 text-xs">{{ date('d/m/Y', strtotime($paiment->date_payment)) }}</td>
                                <td class="border px-3 text-xs">{{ $paiment->typeProof->type }}</td>
                                <td class="border px-3 text-xs">{{ $paiment->proof_number }}</td>
                                <td class="border px-3 text-xs">{{ 'S/ ' . number_format($paiment->total_amount, 2) }}</td>
                                <td class="border px-3 text-xs">{{ 'S/ ' . number_format($paiment->discount, 2) }}</td>
                                <td class="border px-3 text-xs">{{ 'S/ ' . number_format($paiment->amount_paid, 2) }}</td>
                                <td class="border px-3 text-xs">{{ 'S/ ' . number_format($paiment->pending_amount, 2) }}</td>
                                <td class="border px-3 text-xs">
                                   @if (isset($paiment->url_path_image_vaucher))
                                   <div class="whitespace-nowrap text-blue-600 py-1">
                                       <a href="{{ Storage::url($paiment->url_path_image_vaucher) }}" target="_blank">
                                           <span class="">
                                               <i class="far fa-file-image fa-lg"></i>
                                           </span>
                                       </a>
                                   </div>
                                   @else
                                       <div class="text-xs py-1">
                                           <p>No adjuntado</p>
                                       </div>
                                   @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-button class=" bg-blue-500 ml-2" wire:click="closeModalPopover()">
                {{ __('Aceptar') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>