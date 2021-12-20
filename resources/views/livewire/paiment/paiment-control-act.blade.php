<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="grid grid-cols-8 gap-3 mt-3">
                    <div class="grid grid-col-1 pb-2" >
                        <label for="">Acta de Control:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $numero_acta  }}</h3>
                    </div>
                </div>
                <fieldset class="border-2 border-gray-400 rounded-md p-3 mb-3">
                    <legend class="ml-5 px-3">Datos del transportista</legend>
                    <div class="grid grid-cols-1 gap-3">
                        <div class="grid grid-col-2">
                            <label for="">Apellidos y Nombres / Denominación o Razón Social:</label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $razon_social_nombre }}</h3>
                        </div>
                        <div class="grid grid-col-2">
                            <label for="">Nro DNI / RUC:</label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $ruc_dni }}</h3>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="border-2 border-gray-400 rounded-md px-3 pb-3">
                    <legend class="ml-5 px-3">Datos del conductor</legend>
                        <div class="grid grid-cols-1 gap-3 mt-3">
                            <div class="grid grid-col-2" >
                                <label for="">Apellidos y Nombres:</label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $apellidos_nombres_conductor }}</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div class="grid grid-col-1" >
                                <label for="">Num. de Licencia:</label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $nro_licencia }}</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div class="grid grid-col-1" >
                                <label for="">Categoria de Licencia:</label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $clase_categoria_licencia }}</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-4 gap-3 mt-3">
                            <div class="grid grid-col-1" >
                                <label for="">Num. Dni:</label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $nro_dni_conductor }}</h3>
                            </div>
                        </div>
                </fieldset>
                <div class="grid grid-cols-4 gap-3 mt-3">
                    <div class="grid grid-col-1 pb-2" >
                        <label for="">Placa de vehículo:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $placa_vehiculo }}</h3>
                    </div>
                    <div class="grid grid-col-1 pb-2" >
                        <label for="">Fecha Infracción:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ date('d/m/Y', strtotime($fecha_infraccion)) }}</h3>
                    </div>
                    <div class="grid grid-col-1 pb-2" >
                        <label for="">Hora Infracción:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $hora_infraccion }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-3">
                    <div class="grid grid-col-1 pb-2" >
                        <label for="">Lugar de Intervención:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $lugar_intervencion }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="grid grid-col-1 pb-2" >
                        <label for="">Origen:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $origen }}</h3>
                    </div>
                    <div class="grid grid-col-1 pb-2" >
                        <label for="">Destino:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $destino }}</h3>
                    </div>
                </div>
                <fieldset class="border-2 border-gray-400 rounded-md px-3 pb-3">
                    <legend class="ml-5 px-3">Detalles de pago</legend>
                    @if ($controlAct->hasPaiment())
                        @if ($monto_total_pagar > 0)
                        <button wire:click.prevent="OpenModalPaimentControlAct"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">
                            Agregar pago
                        </button>
                        @endif
                    @endif
                    
                    <div>
                        @if ($isOpenModalPaimentControlAct)
                            @include('components.paiments.modal-paiment-control-act')
                        @endif
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-200 text-xs">
                                    <th class="border px-3">Fecha Pago</th>
                                    <th class="border px-3">Tipo Comprobante</th>
                                    <th class="border px-3">Nro Comprobante</th>
                                    <th class="border px-3">Monto infracción</th>
                                    <th class="border px-3">Monto pagado</th>
                                    <th class="border px-3">Pendiente por pagar</th>
                                    <th class="border px-3">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paiments as $paiment)
                                    <tr class="hover:bg-gray-100 text-center">
                                        <td class="border px-3 text-xs">{{ date('d/m/Y', strtotime($paiment->date_payment)) }}</td>
                                        <td class="border px-3 text-xs">{{ $paiment->typeProof->type }}</td>
                                        <td class="border px-3 text-xs">{{ $paiment->proof_number }}</td>
                                        <td class="border px-3 text-xs">{{ 'S/ ' . number_format($paiment->total_amount, 2) }}</td>
                                        <td class="border px-3 text-xs">{{ 'S/ ' . number_format($paiment->amount_paid, 2) }}</td>
                                        <td class="border px-3 text-xs">{{ 'S/ ' . number_format($paiment->pending_amount, 2) }}</td>
                                        <td class="border px-3 text-xs">
                                            <div>
                                                <a href="" class="underline text-blue-600 hover:text-blue-800 visited:text-purple-600 px-2">Editar</a>
                                                <a href="" class="underline text-red-400 hover:text-red-500 visited:text-red-600">Eliminar</a>
                                            </div>
                                        </td>                                  
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </fieldset>
                <div class="my-3">
                    <a type="button" href="{{ route('actasDeControl.show') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Ir al listado de Actas</a>
                </div>
            </div>
        </div>
    </div>
</div>
