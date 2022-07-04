<div>
    <x-jet-dialog-modal maxWidth="6xl">
        <x-slot name="title"> 
            <strong>{{ __('Detalles del Acta de Fiscalizacion') }}</strong>
        </x-slot>
        <x-slot name="content">
            <div>
                <div class="flex justify-center">
                    <label for="" class="text-sm font-extrabold">DATOS DEL PRESUNTO RESPONABLE ADMINISTATIVO DEL VEHÍCULO CON EL QUE SE COMETIO LA INFRACCIÓN</label>
                </div>
                <table class="flex justify-center">
                    <thead></thead>
                    <tbody class="text-xs">
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
                    </tbody>
                </table>
                <div class="flex justify-center">
                    <label for="" class="text-sm mt-3 font-extrabold">DETALLE DE LA CONDUCTA INFRACTORA DETECTADA</label>
                </div>
                <div class="flex justify-center">
                    <table>
                        <thead>
                            <tr class="bg-gray-200 text-xs">
                                <th>NRO ACTA</th>
                                <th>CODIGO DE INFRACCION</th>
                                <th>DESCRIPCION</th>
                                <th>AGENTE INFRACTOR</th>
                                <th>SANCION PECUNIARIA</th>
                                <th>SANCION ADMINISTRATIVA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border px-3 text-xs text-center">{{ $act_number }}</td>
                                <td class="border px-3 text-xs text-center">{{ $infraction_code }}</td>
                                <td class="border px-3 text-xs">{{ $infraction_description }}</td>
                                <td class="border px-3 text-xs text-center">{{ $infraction_infringement_agent }}</td>
                                <td class="border px-3 text-xs text-center">{{ $infraction_uit_penalty }}</td>
                                <td class="border px-3 text-xs text-center">{{ $infraction_administrative_sanction }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-center mt-2">
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
                                <td class="border px-3 text-xs w-28 text-center">{{ date('d/m/Y', strtotime($date_infraction)) }}</td>
                                <td class="border px-3 text-xs text-center">{{ $hour_infraction }}</td>
                                <td class="border px-3 text-xs w-20 text-center">{{ $vehicle_plate_number }}</td>
                                <td class="border px-3 text-xs text-center">{{ $vehicle_identification_card_number }}</td>
                                <td class="border px-3 text-xs text-center">{{ $status }}</td>
                            </tr>
                        </tbody>
                    </table>
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
                    <label for="" class="text-sm mt-1 font-extrabold">DETALLE DE LOS PAGOS ASOCIADOS</label>
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
                                            <div class="whitespace-nowrap py-1 text-blue-600">
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
                            @endforeach
                        </tbody>
                    </table>
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