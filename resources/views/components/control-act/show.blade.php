<x-jet-dialog-modal maxWidth="6xl">
    <x-slot name="title">
        
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
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="center"  colspan="2" class="text-sm underline "><h3><strong>DATOS DEL TRANSPORTISTA</strong></h3></td>
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
         <x-jet-section-border />
         <div class="flex justify-center">
            <table class="text-xs">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-3">NRO DE ACTA</th>
                        <th class="px-3">LUGAR DE INTERVENCION</th>
                        <th class="px-3">ORIGEN</th>
                        <th class="px-3">DESTINO</th>
                        <th class="px-3">PLACA VEHICULO</th>
                        <th class="px-3">COD. INFRACCION</th>
                        <th class="px-3">FECHA</th>
                        <th class="px-3">HORA</th>
                        <th class="px-3">TIPO SERVICIO</th>
                        <th class="px-3">SEDE</th>
                        <th class="px-3">ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-3 text-center">{{ $this->nro_acta }}</td>
                        <td class="border px-3 text-center">{{ $this->lugar_intervencion }}</td>
                        <td class="border px-3 text-center">{{ $this->origen }}</td>
                        <td class="border px-3 text-center">{{ $this->destino }}</td>
                        <td class="border px-3 text-center">{{ $this->placa_vehiculo }}</td>
                        <td class="border px-3 text-center">{{ $this->cod_infraccion }}</td>
                        <td class="border px-3 text-center">{{ date('d/m/Y', strtotime($this->fecha_infraccion)) }}</td>
                        <td class="border px-3 text-center">{{ $this->hora_infraccion }}</td>
                        <td class="border px-3 text-center">{{ $this->tipo_servicio }}</td>
                        <td class="border px-3 text-center">{{ $this->sede_infraccion }}</td>
                        <td class="border px-3 text-center">{{ $this->estado }}</td>
                    </tr>
                </tbody>
            </table>
         </div>
         <x-jet-section-border />
         @if ($hasPaiments)
         <div class="flex justify-center">
             <label for="" class="mb-3">DETALLE DEL PAGO DE INFRACCIÓN</label>
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
             <div class="flex justify-center">
                 <label for="" class="mb-3">NO EXISTEN DETALLES DEL PAGO ASOCIADOS</label>
             </div>
         @endif
         
         <x-jet-section-border />
    </x-slot>

    <x-slot name="footer">
        <x-jet-button wire:click="closeModalShow()">
            Aceptar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>