<x-jet-dialog-modal maxWidth="6xl">
    <x-slot name="title">
        <h3><strong>Detalles del Acta de Control:</strong></h3>
     </x-slot>
     <x-slot name="content">
         <div>
             <div class="grid justify-items-center">
                <table>
                    <thead></thead>
                    <tbody class="text-xs">
                        <tr>
                            <td align="center" colspan="2" class="text-sm underline "><h3><strong>DATOS DEL CONDUCTOR</strong></h3></td>
                        </tr>
                        <tr>
                            <td  align="right"><strong>APELLIDOS Y NOMBRES:</strong></td>
                            <td class="pl-3 text-yellow-600"><strong>{{ $this->nombres_conductor }}</strong></td>
                        </tr>
                        <tr>
                            <td align="right"><strong>NRO. DE DOCUMENTO DE IDENTIDAD:</strong></td>
                            <td class="pl-3 text-yellow-600"><strong>{{ $this->dni_conductor }}</strong></td>
                        </tr>
                        <tr>
                            <td align="right"><strong>NRO. DE LICENCIA:</strong> </td>
                            <td class="pl-3 text-yellow-600"><strong>{{ $this->nrolicencia_conductor }}</strong></td>
                        </tr>
                        <tr>
                            <td align="right"><strong>CLASE Y CATEGORIA:</strong> </td>
                            <td class="pl-3 text-yellow-600"><strong>{{ $this->clase_categoria_licencia }}</strong></td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <thead></thead>
                    <tbody class="text-xs">
                        <tr>
                            <td align="center" colspan="2" class="text-sm underline "><h3><strong>DATOS DEL TRANSPORTISTA</strong></h3></td>
                        </tr>
                        <tr>
                            <td align="right"><strong>RUC/DNI:</strong></td>
                            <td class="pl-3 text-yellow-600 font-bold">{{ $this->ruc_dni }}</td>
                        </tr>
                        <tr>
                            <td align="right"><strong>NOMBRE O RAZON SOCIAL:</strong></td>
                            <td class="pl-3 text-yellow-600 font-bold">{{ $this->razonsocial_nombre }}</td>
                        </tr>
                    </tbody>
                </table>
             </div>
         </div>
         <div class="flex justify-center mt-2">
            <table class="text-xs">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-3">NRO DE ACTA</th>
                        <th class="px-3">COD. INFRACCION</th>
                        <th class="px-3">DESCRIPCION</th>
                        <th class="px-3">SANCION PECUANIARIA</th>
                        <th class="px-3">SANCION ADMINISTRATIVA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-3 text-center">{{ $nro_acta }}</td>
                        <td class="border px-3 text-center">{{ $cod_infraccion }}</td>
                        <td class="border px-3 text-center">{{ $descripcion }}</td>
                        <td class="border px-3 text-center">{{ $sancion_pecuaniaria }}</td>
                        <td class="border px-3 text-center">{{ $sancion_administrativa }}</td>
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
                        @if ($estado == 'CANCELADO' && $hasPaiments == false)
                            <th class="px-3">NRO COMPROBANTE PAGO</th>
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
                        <td class="border px-3 text-xs">{{ $estado }}</td>
                        @if ($estado == 'CANCELADO' && $hasPaiments == false)
                            <td class="border px-3 text-xs">{{ $nro_boleta_pago }}</td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
         <!-----------------------------------------MOSTRAR DETALLES DE RESOLUCIONES ASOCIADAS----------------------------->
         @if ($hasResolutions)
            <div class="flex justify-center mt-2">
                <label for="" class="mb-1 font-bold text-xs">DETALLE DE LAS RESOLUCIONES ASOCIADAS</label>
            </div>
            <div class="flex justify-center">
                <table>
                    <thead>
                        <tr class="bg-gray-200 text-xs">
                            <th class="border px-3">Tipo de Resolucion</th>
                            <th class="border px-3">Fecha Emision</th>
                            <th class="border px-3">Nombre Resolucion</th>
                            <th class="border px-3">Documento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($resolutions as $resolution)
                            <tr class="text-center">
                                <td class="border px-3 text-xs">{{ $resolution->type }}</td>
                                <td class="border px-3 text-xs">{{ date('d/m/Y', strtotime($resolution->date_resolution)) }}</td>
                                <td class="border px-3 text-xs">{{ $resolution->title }}</td>
                                <td class="border px-3 text-xs">
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
                        @empty
                        <tr class="hover:bg-gray-100 text-center">
                            <td colspan="4" class="border px-3 text-sm">
                                .: no existe resoluciones asociadas :.
                            </td>
                        </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
         @else

         @endif
         <!-----------------------------------------MOSTRAR DETALLES DE LOS PAGOS ASOCIADOS----------------------------->
         @if ($hasPaiments)
         <div class="flex justify-center mt-3">
             <label for="" class="mb-1 text-xs font-bold">DETALLE DE LOS PAGOS ASOCIADOS</label>
         </div>
         <div class="flex justify-center">
             <table>
                 <thead>
                     <tr class="bg-gray-200 text-xs">
                         <th class="border px-3">Fecha Pago</th>
                         <th class="border px-3">Tipo Comprobante</th>
                         <th class="border px-3">Nro Comprobante</th>
                         <th class="border px-3">Monto infraccion</th>
                         <th class="border px-3">Descuento aplicado</th>
                         <th class="border px-3">Monto pagado</th>
                         <th class="border px-3">Pendiente por pagar</th>
                         <th class="border px-3">Comprobante</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse ($paiments as $paiment)
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
                     @empty
                     <tr class="hover:bg-gray-100 text-center">
                         <td colspan="4" class="border px-3 text-sm">
                             .: no existe pagos asociados :.
                         </td>
                     </tr>
                     @endforelse
                     
                 </tbody>
             </table>
         </div>
         @else

         @endif
    </x-slot>

    <x-slot name="footer">
        <x-jet-button wire:click="closeModalShow()">
            Aceptar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>