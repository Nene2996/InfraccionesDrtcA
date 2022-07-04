<x-jet-dialog-modal maxWidth="6xl">
    <x-slot name="title">
        <strong>Detalles del Acta de Fiscalización:</strong> 
    </x-slot>
    <x-slot name="content">
    <div>
        <table>
            <thead>
            </thead>
            <tbody>
                <div>
                    <tr>
                        @if ($typeNames_id == 1)
                            <td class="text-xs"><strong>Conductor</strong></td>
                        @else
                            <td class="text-xs"><strong>Razón Social</strong></td>
                        @endif
                        <td class="text-xs text-yellow-600 font-bold">:{{ $names_business_name }}</td>
                        <td class=" text-xs pl-36"><strong>Inspector</strong></td>
                        <td class="text-xs text-yellow-600 font-bold">:{{ $inspector_surnames_and_names }}</td>
                    </tr>
                    <tr>
                        @if ($typeDocument_id == 1)
                            <td class=" text-xs"><strong>Dni</strong></td>
                        @else
                            <td class="text-xs"><strong>Ruc</strong></td>
                        @endif
                        <td class="text-xs text-yellow-600 font-bold">:{{ $document_number }}</td>
                        <td class="text-xs pl-36"><strong>Registrado por</strong></td>
                        <td class="text-xs text-yellow-600 font-bold">:{{ $operator_surnames_and_names }}</td> 
                    </tr>
                    <tr>
                        <td class="text-xs"><strong>Nº de Licencia</strong></td>
                        <td class="text-xs text-yellow-600 font-bold">:{{ $licence_number }}</td>
                        <td class="text-xs pl-36"><strong>Fecha de Registro</strong></td>
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
        <div class="flex justify-center mt-1">
            <table>
                <thead>
                    <tr class="bg-gray-200 text-xs">
                        <th>NRO ACTA</th>
                        <th>COD DE INFRACCION</th>
                        <th>DESCRIPCION</th>
                        <th>SANCION PECUNIARIA</th>
                        <th>SANCION ADMINISTRATIVA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-3 text-xs text-center">{{ $act_number }}</td>
                        <td class="border px-3 text-xs text-center">{{ $infraction_code }}</td>
                        <td class="border px-3 text-xs">{{ $infraction_description }}</td>
                        <td class="border px-3 text-xs text-center">{{ $infraction_uit_penalty }}</td>
                        <td class="border px-3 text-xs text-center">{{ $infraction_administrative_sanction }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-center my-2">
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
                        <td class="border px-3 text-xs text-center">{{ $place }}</td>
                        <td class="border px-3 text-xs text-center">{{ $district }}</td>
                        <td class="border px-3 text-xs text-center">{{ $province }}</td>
                        <td class="border px-3 text-xs text-center">{{ $department }}</td>
                        <td class="border px-3 text-xs w-24 text-center">{{ date('d-m-Y', strtotime($date_infraction)) }}</td>
                        <td class="border px-3 text-xs text-center">{{ $hour_infraction }}</td>
                        <td class="border px-3 text-xs w-20 text-center">{{ $vehicle_plate_number }}</td>
                        <td class="border px-3 text-xs text-center">{{ $vehicle_identification_card_number }}</td>
                        <td class="border px-3 text-xs">{{ $status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-------------------RESOLUCIONES ASOCIADAS----------------------------------------------->
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
                    @forelse ($resolutions as $resolution)
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
        <!-------------------PAGOS ASOCIADOS----------------------------------------------->
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
                                    <div class="whitespace-nowrap text-blue-600 my-1">
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

        @endif
    </div>
    </x-slot>
    <x-slot name="footer">
        <x-jet-button wire:click="closeModalShow()">
            Aceptar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>