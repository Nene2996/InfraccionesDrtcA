<main>
    @auth

    @else
    <div>
        <div class="flex flex-col text-center bg-195% md:bg-175% pt-10 px-4">
            <div>
                <h1 class="text-4xl mb-10 font-bold max-w-4xl mx-auto leading-none">CONSULTAR INFRACCIONES AL REGLAMENTO NACIONAL DE TRANSPORTE: </h1>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div>
                            <h3 class="text-gray-600 font-semibold">Tipo de busqueda:</h3>
                            <ul>
                                <li>
                                    <label class="mr-10 text-gray-700">
                                        <input wire:model='typeSearch' wire:click="resetInput()" type="radio" name="myRadios" class="mr-2 checked:bg-blue-600" value="0" checked>Por Apellidos y nombres
                                    </label>
                                    <label class="mr-10">
                                        <input wire:model='typeSearch' wire:click="resetInput()" onClick="muestra_oculta('divLastName')" type="radio" name="myRadios" class="mr-2" value="1">Por Nro. Licencia
                                    </label>
                                    <label wire:model='typeSearch' class="mr-10">
                                        <input type="radio" name="myRadios" wire:click="resetInput()" class="mr-2" value="2">Por Nro. Acta de Fiscalización
                                    </label>
                                </li>
                            </ul>
                        </div>
                        @if($isOpendivLastName)
                            <div id="divLastName" class="md:w-1/2 px-3 mb-6 md:mb-0 mt-3">
                                <input wire:model="lastName" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="lastName" type="text" placeholder="Escribe el apellido y nombre">
                                
                                <div>
                                    @error('lastName') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                                </div>
                                
                            </div>
                        @endif
                        @if ($isOpendivNumberLicence)
                            <div id="divNumberLicence" class="md:w-1/4 px-3 mb-6 md:mb-0 mt-3">
                                <input wire:model="numberLicence" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="numberLicence" type="text" placeholder="Escribe el nro de Licencia">
                                
                            </div>
                            @error('numberLicence') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        @endif
                        
                        @if ($isOpendivNumberAct)
                            <div id="divNumberAct" class="md:w-1/4 px-3 mb-6 md:mb-0 mt-3">
                                <input wire:model="numberActa" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="numberActa" type="text" placeholder="Escribe el numero de acta">
                                <div>
                                    @error('numberActa') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        @if ($isModalOpen)
                        @include('components.show')
                        @endif
                        <div class="">
                            <table class="">
                                <thead>
                                    <tr class="bg-gray-200 text-sm">
                                        <th class="border px-3">NRO. ACTA</th>
                                        <th class="border px-3">NOMBRE</th>
                                        <th class="border px-3">NRO DE LICENCIA</th>
                                        <th class="border px-3">ESTADO PAPELETA</th>
                                        <th class="border px-3">FECHA PAPELETA</th>
                                        <th class="border px-3">NRO. BOLETA/VAUCHER</th>
                                        <th class="border px-3">SEDE</th>
                                        <th class="border px-3">OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @forelse ($ballots as $ballot)
                                    <div>
                                        <tr>
                                            <td class="border px-3 text-xs">{{ $ballot->nro_acta }}</p></td>
                                            <td class="border px-3 text-xs">{{ $ballot->nombre_conductor }}</td>
                                            <td class="border px-3 text-xs">{{ $ballot->nro_licencia }}</td>
                                            <td class="border px-3 text-xs">{{ $ballot->estado_actual }}</td>
                                            <td class="border px-3 text-xs">{{ date('d-m-Y', strtotime($ballot->fecha_infraccion)) }}</td>
                                            <td class="border px-3 text-xs">{{ $ballot->nro_boleta_pago }}</td>
                                            <td class="border px-3 text-xs">{{ $ballot->sede_infraccion }}</td>
                                            <td class="border px-3 text-xs"><button wire:click="show({{ $ballot->id }})" class="bg-blue-500  text-white font-bold py-1 px-4 rounded">VER +</button></td>
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

