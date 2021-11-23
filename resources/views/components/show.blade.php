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
                        <td class="font-bold bg-gray-200 pl-3">APELLIDOS Y NOMBRES</td>
                        <td class="text-sm bg-gray-200 pl-3">{{ $nombre_apellidos }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold  pl-3">DNI</td>
                        <td class="text-sm pl-3">{{ $dni }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-200 pl-3">DIRECCIÓN / DOMICILIO</td>
                        <td class="text-sm bg-gray-200 pl-3">{{ $direccion_infractor }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold  pl-3">NÚMERO LICENCIA</td>
                        <td class="text-sm  pl-3">{{ $nro_licencia }}</td>
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
                        <td class="font-bold bg-gray-200 pl-3">NÚMERO DE ACTA DE FISCALIZACIÓN</td>
                        <td class="text-sm bg-gray-200 pl-3">{{ $nro_acta }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold  pl-3">ESTADO ACTUAL</td>
                        <td class="text-sm  pl-3">{{ $estado_actual }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-200 pl-3">SEDE INFRACCIÓN</td>
                        <td class="text-sm bg-gray-200 pl-3">{{ $sede_infraccion }}</td>
                    </tr>
                </tbody>
            </table>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button class=" bg-blue-500 ml-2" wire:click="closeModalPopover()">
                {{ __('Aceptar') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>