<main>
    @auth

    @else
    <div class="">
        <div class="flex flex-col text-center bg-195% md:bg-175% pt-10 px-4">
            <div>
                <h1 class="text-4xl mb-10 font-bold max-w-4xl mx-auto leading-none">CONSULTAR INFRACCIONES AL REGLAMENTO NACIONAL DE TRANSPORTE: </h1>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <h3 class="text-gray-600 text-lg font-semibold">Tipo de busqueda:</h3>
                        <ul>
                            <li>
                                <label class="mr-10 text-gray-700">
                                    <input wire:model='typeSearch' wire:click="resetInput()" type="radio" name="value01" class="mr-2" value="0">Por Apellidos y nombres
                                </label>
                                <label class="mr-10">
                                    <input wire:model='typeSearch' wire:click="resetInput()" type="radio" name="value01" class="mr-2" value="1">Por Nro. Licencia
                                </label>
                                <label wire:model='typeSearch' class="mr-10">
                                    <input type="radio" name="value01" wire:click="resetInput()" class="mr-2" value="2">Por Nro. Acta
                                </label>
                            </li>
                        </ul>
                        <div class="flex relative mt-4">
                            <x-jet-input wire:model="search" type="text" class="" placeholder="Escribe el dato a buscar"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                        <div class="">
                            <table class="">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="border px-3">NRO. ACTA</th>
                                        <th class="border px-3">NOMBRE</th>
                                        <th class="border px-3">NRO DE LICENCIA</th>
                                        <th class="border px-3">ESTADO PAPELETA</th>
                                        <th class="border px-3">FECHA PAPELETA</th>
                                        <th class="border px-3">NRO. BOLETA/VAUCHER</th>
                                        <th class="border px-3">SEDE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @forelse ($ballots as $ballot)
                                    <div>
                                        <tr>
                                            <td class="border px-3">{{ $ballot->nro_acta }}</p></td>
                                            <td class="border px-3">{{ $ballot->nombre_conductor }}</td>
                                            <td class="border px-3">{{ $ballot->nro_licencia }}</td>
                                            <td class="border px-3">{{ $ballot->estado_actual }}</td>
                                            <td class="border px-3">{{ date('d-m-Y', strtotime($ballot->fecha_infraccion)) }}</td>
                                            <td class="border px-3">{{ $ballot->nro_boleta_pago }}</td>
                                            <td class="border px-3">{{ $ballot->sede_infraccion }}</td>
                                        </tr>
                                    </div>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="4" class="py-3 italic">No hay información</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth

</main>
