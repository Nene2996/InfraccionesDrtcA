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
         
        @if ($this->estado == 'CANCELADO')
            <div class="flex justify-center mt-5">
                <table class="text-xs">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-3">MONTO PAGADO</th>
                            <th class="px-3">TIPO DE COMPROBANTE</th>
                            <th class="px-4">NRO. COMPROBANTE</th>
                            <th class="px-3">FECHA PAGO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paiments as $paiment)
                            <tr>
                                <td class="border px-3 text-center">{{ 'S/. ' . number_format($paiment->amount_paid, 2) }}</td>
                                <td class="border px-3 text-center">{{ $paiment->typeProof->type }}</td>
                                <td class="border px-3 text-center">{{ $paiment->proof_number }}</td>
                                <td class="border px-3 text-center">{{ date('d/m/Y', strtotime($paiment->date_payment)) }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        @elseif($this->estado == 'FALTA CANCELAR')
            <div class="flex justify-center text-sm mt-5">
                <h3>No existe detalles de pago</h3>
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