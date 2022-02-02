<div>
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
                                <td align="center"  colspan="2" class="text-sm underline font-extrabold"><h3><strong>DATOS DEL PRESUNTO RESPONABLE ADMINISTATIVO DEL VEHÍCULO CON EL QUE SE COMETIÓ LA INFRACCIÓN</strong></h3></td>
                            </tr>
                            <tr>
                                @if ($typeNames_id == 1)
                                    <td align="right"><strong>APELLIDOS Y NOMBRES:</strong></td>
                                @else
                                    <td align="right" class="text-xs font-extrabold"><strong>RAZÓN SOCIAL </strong></td>
                                @endif
                                <td class="pl-3 text-yellow-600 font-extrabold">{{ $names_business_name }}</td>
                            </tr>
                            <tr>
                                @if ($typeDocument_id == 1)
                                    <td align="right"><strong>DNI:</strong></td>
                                @else
                                    <td align="right"><strong>RUC:</strong></td>
                                @endif
                                <td class="pl-3 text-yellow-600 font-extrabold">{{ $document_number }}</td>
                            </tr>
                            <tr>
                                <td align="right"><strong>NRO. DE LICENCIA:</strong> </td>
                                <td class="pl-3 text-yellow-600 font-extrabold">{{ $licence_number }}</td>
                            </tr>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                 </div>
<!--
                <table>
                    <thead>
                    </thead>
                    <tbody>

                        <div>
                            <tr>
                                @if ($typeNames_id == 1)
                                    <td class="text-xs font-extrabold"><strong>Nombres</strong></td>
                                @else
                                    <td class="text-xs font-extrabold"><strong>Razón Social</strong></td>
                                @endif
                                <td class="text-xs text-yellow-600 font-bold">:{{ $names_business_name }}</td>
                                <td class=" text-xs pl-36"><strong>Inspector</strong></td>
                                <td class="text-xs text-yellow-600 font-bold">:{{ $inspector_surnames_and_names }}</td>
                            </tr>
                            <tr>
                                @if ($typeDocument_id == 1)
                                    <td class=" text-xs font-extrabold"><strong>Dni</strong></td>
                                @else
                                    <td class="text-xs font-extrabold"><strong>Ruc</strong></td>
                                @endif
                                <td class="text-xs text-yellow-600 font-bold">:{{ $document_number }}</td>
                                <td class="text-xs pl-36"><strong>Registrado por</strong></td>
                                <td class="text-xs text-yellow-600 font-bold">:{{ $operator_surnames_and_names }}</td> 
                            </tr>
                            <tr>
                                <td class="text-xs font-extrabold"><strong>Nº de Licencia</strong></td>
                                <td class="text-xs text-yellow-600 font-bold">:{{ $licence_number }}</td>
                                <td class="text-xs pl-36 font-extrabold"><strong>Fecha de Registro</strong></td>
                                <td class="text-xs text-yellow-600 font-bold">:{{ date('d/m/Y H:i:s', strtotime($inspection_created_at)) }}</td>
                            </tr>
                            <tr>
                                <td class="text-xs"><strong>Domicilio</strong></td>
                                <td class="text-xs text-yellow-600 font-bold">:{{ $address }}</td>
                                <td class="text-xs pl-36"><strong>Lugar de Registro</strong></td>
                                <td class="text-xs text-yellow-600 font-bold">:{{ $inspection_campus }}</td>
                            </tr>
                        </div>
                    </tbody>
                </table> 
-->
                <x-jet-section-border />
                <div class="flex justify-center">
                    <label for="" class="mb-3 font-extrabold">DETALLE DE LA CONDUCTA INFRACTORA DETECTADA</label>
                </div>
                <div class="flex justify-center">
                    <table>
                        <thead>
                            <tr class="bg-gray-200 text-xs">
                                <th>CODIGO DE INFRACCION</th>
                                <th>DESCRIPCION</th>
                                <th>AGENTE INFRACTOR</th>
                                <th>MULTA UIT</th>
                                <th>DESC. 5 DIAS</th>
                                <th>DESC. 15 DIAS(Resolucion)</th>
                                <th>SANCION ADMINISTRATIVA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border px-3 text-xs">{{ $infraction_code }}</td>
                                <td class="border px-3 text-xs">{{ $infraction_description }}</td>
                                <td class="border px-3 text-xs">{{ $infraction_infringement_agent }}</td>
                                <td class="border px-3 text-xs">{{ $infraction_uit_penalty }}</td>
                                <td class="border px-3 text-xs">
                                    {{ 'S/.'. number_format($this->inspection->infraction->discount_five_days * 4600, 2) }}</td>
                                <td class="border px-3 text-xs">{{ 'S/.'. number_format($this->inspection->infraction->discount_fifteen_days * 4600, 2) }}</td>
                                <td class="border px-3 text-xs">{{ $infraction_administrative_sanction }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-center my-5">
                    <table>
                        <thead>
                            <tr class="bg-gray-200 text-xs">
                                <th>Lugar</th>
                                <th>Distrito</th>
                                <th>Provincia</th>
                                <th>Departamento</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Nº de Placa</th>
                                <th>Nº de Tarjeta de Identificación vehicular</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border px-3 text-xs">{{ $place }}</td>
                                <td class="border px-3 text-xs">{{ $district }}</td>
                                <td class="border px-3 text-xs">{{ $province }}</td>
                                <td class="border px-3 text-xs">{{ $department }}</td>
                                <td class="border px-3 text-xs w-24 text-center">{{ date('d/m/Y', strtotime($date_infraction)) }}</td>
                                <td class="border px-3 text-xs">{{ $hour_infraction }}</td>
                                <td class="border px-3 text-xs w-20 text-center">{{ $vehicle_plate_number }}</td>
                                <td class="border px-3 text-xs">{{ $vehicle_identification_card_number }}</td>
                                <td class="border px-3 text-xs">{{ $status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                @if ($hasPaiments)
                <div class="flex justify-center">
                    <label for="" class="mb-3 font-extrabold">DETALLE DEL PAGO REALIZADO</label>
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
                                <th class="border px-3">Archivo digitalizado</th>
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
                                            <div class="whitespace-nowrap text-blue-600">
                                                <a href="{{ Storage::url($paiment->url_path_image_vaucher) }}" target="_blank">
                                                    <span class="">
                                                        <i class="far fa-file-image fa-lg"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        @else
                                            <div class="text-xs">
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
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:click="closeModalInspection">
                Aceptar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>