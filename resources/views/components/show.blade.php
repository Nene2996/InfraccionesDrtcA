<div>
    <x-jet-dialog-modal wire:model="">
        <x-slot name="title">
            {{ __('Detalles de la papeleta') }}
        </x-slot>

        <x-slot name="content">
            <table>
                <thead></thead>
                <tbody>
                    <tr>
                        <td class="font-bold bg-gray-200 pl-3">ADMINISTRADO</td>
                        <td class="text-sm bg-gray-200 pl-3">{{ $nombre_conductor }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold pl-3">LUGAR INTERVENCION</td>
                        <td class="text-sm pl-3">{{ $lugar_intervencion }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-200 pl-3">ORIGEN</td>
                        <td class="text-sm bg-gray-200 pl-3">{{ $origen }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold pl-3">DESTINO</td>
                        <td class="text-sm pl-3">{{ $destino }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-200 pl-3">APELLIDOS Y NOMBRES / RAZÓN SOCIAL</td>
                        <td class="text-sm bg-gray-200 pl-3">{{ $nombre_razon_social }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold pl-3">DIRECCIÓN INFRACTOR</td>
                        <td class="text-sm pl-3">{{ $direccion_infractor }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-200 pl-3">NÚMERO LICENCIA</td>
                        <td class="text-sm bg-gray-200 pl-3">{{ $nro_licencia }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold pl-3">CLASE Y CAT</td>
                        <td class="text-sm pl-3">{{ $clase_categoria_licencia }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-200 pl-3">FECHA INFRACCIÓN</td>
                        <td class="text-sm bg-gray-200 pl-3">{{ date('d-m-Y', strtotime($fecha_infraccion)) }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold pl-3">HORA INFRACCIÓN</td>
                        <td class="text-sm pl-3">{{ $hora_infraccion }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-200 pl-3">NÚMERO DE TARJETA VEHICULAR</td>
                        <td class="text-sm bg-gray-200 pl-3">{{ $nro_tarjeta_vehicular }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold pl-3">MANIFESTACION DE USUARIO</td>
                        <td class="text-sm pl-3">{{ $manifestacion_usuario }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-200 pl-3">NÚMERO DE ACTA</td>
                        <td class="text-sm bg-gray-200 pl-3">{{ $nro_acta }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold pl-3">SERVICIO</td>
                        <td class="text-sm pl-3">{{ $servicio }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-200 pl-3">ESTADO ACTUAL</td>
                        <td class="text-sm bg-gray-200 pl-3">{{ $estado_actual }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold pl-3">SEDE INFRACCIÓN</td>
                        <td class="text-sm pl-3">{{ $sede_infraccion }}</td>
                    </tr>
                </tbody>
            </table>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button class="ml-2" wire:click="closeModalPopover()">
                {{ __('Aceptar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>