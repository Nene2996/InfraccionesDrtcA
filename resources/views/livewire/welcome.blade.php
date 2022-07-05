<main>
    @auth

    @else
    <div>
        <div class="flex flex-col text-center bg-195% md:bg-175% pt-10 px-4">
            <div>
                <h1 class="text-4xl mb-10 font-bold max-w-4xl mx-auto leading-none">CONSULTA DE INFRACCIONES AL REGLAMENTO NACIONAL DE TRANSPORTE </h1>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        @if ($errors->any() )
                            <div class="w-auto mx-auto mt-2 flex bg-red-100 rounded-lg p-4 text-sm text-red-700 ">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            <div role="alert">
                                                <div>
                                                    <span class="font-medium">{{ '* ' . $error }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="flex flex-col mb-3 md:w-1/2">
                            <span class="text-gray-600 font-extrabold">Selecciona el tipo de Acta:</span>
                            <select wire:model="selectValue" name="" id="" class="rounded-md">
                                <option value="" selected disabled>-----selecciona-----</option>
                                <option value="1">Acta de Control</option>
                                <option value="2">Acta de Fiscalizacion</option>
                            </select>
                        </div>
                        <div>
                            <h3 class="text-gray-600 font-extrabold">Tipo de busqueda:</h3>
                            <ul>
                                <li>
                                    <label class="mr-10 text-gray-700">
                                        <input wire:model='typeSearch' wire:click="resetInput()" type="radio" name="myRadios" class="mr-2 checked:bg-blue-600" value="0" checked>Por Apellidos y nombres
                                    </label>
                                    <label class="mr-10">
                                        <input wire:model='typeSearch' wire:click="resetInput()" onClick="muestra_oculta('divLastName')" type="radio" name="myRadios" class="mr-2" value="1">Por Nro. Licencia
                                    </label>
                                    <label wire:model='typeSearch' class="mr-10">
                                        <input type="radio" name="myRadios" wire:click="resetInput()" class="mr-2" value="2">Por Nro. de Acta
                                    </label>
                                    <label wire:model='typeSearch' class="mr-10">
                                        <input type="radio" name="myRadios" wire:click="resetInput()" class="mr-2" value="3">Por Nro. de Placa
                                    </label>
                                </li>
                            </ul>
                        </div>
                        @if($isOpendivLastName)
                            <div id="divLastName" class="md:w-1/2 px-3 mb-6 md:mb-0 mt-3">
                                <input wire:model="lastName" class="w-full rounded-lg border-2 border-gray-300 p-2" id="lastName" type="text" placeholder="Escribe los Apellidos y Nombres">                             
                            </div>
                        @endif
                        @if ($isOpendivNumberLicence)
                            <div id="divNumberLicence" class="md:w-1/4 px-3 mb-6 md:mb-0 mt-3">
                                <input wire:model="numberLicence" class="w-full rounded-lg border-2 border-gray-300 p-2" id="numberLicence" type="text" placeholder="Escribe el nro de Licencia">
                            </div>
                        @endif
                        @if ($isOpendivNumberAct)
                            <div id="divNumberAct" class="md:w-1/6 px-3 mb-6 md:mb-0 mt-3">
                                <input wire:model="numberActa" class="w-full rounded-lg border-2 border-gray-300 p-2" id="numberActa" type="text" placeholder="Nro de acta">
                            </div>
                        @endif
                        @if ($isOpendivPlateNumber)
                            <div id="divPlateNumber" class="md:w-1/6 px-3 mb-6 md:mb-0 mt-3">
                                <input wire:model="plateNumber" class="w-full rounded-lg border-2 border-gray-300 p-2" id="plateNumber" type="text" placeholder="Nro de placa">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="mx-auto sm:px-6 lg:px-8 mb-5 w-auto">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="py-10 sm:px-2 bg-white border-b border-gray-200">
                        @if ($isModalControlActOpen)
                            @include('components.show-details-control')
                        @endif
                        @if ($isModalInspectionActOpen)
                            @include('components.show-details-inspection')
                        @endif
                        <div class="flex justify-center">
                            <table>
                                <thead>
                                    <tr class="bg-gray-200 text-xs">
                                        <th class="border px-3">NRO. ACTA</th>
                                        <th class="border px-3">CONDUCTOR</th>
                                        <th class="border px-3">NRO DE LICENCIA</th>
                                        <th class="border px-3">COD. INFRACCION</th>
                                        <th class="border px-3">SANCION. PECUNIARIA</th>
                                        <th class="border px-3">SANCION. ADMINISTRATIVA</th>
                                        <th class="border px-3">PLACA VEHICULO</th>
                                        <th class="border px-3">ESTADO DE ACTA</th>
                                        <th class="border px-3">FECHA</th>
                                        <th class="border px-3">SEDE</th>
                                        <th class="border px-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($selectValue == 1)
                                        @forelse ($ballots as $ballot)
                                            <div>
                                                <tr class="text-xs">
                                                    <td class="border px-3 text-center">{{ $ballot->numero_acta }}</p></td>
                                                    <td class="border px-3">{{ $ballot->apellidos_nombres_conductor }}</td>
                                                    <td class="border px-3 text-center">{{ $ballot->nro_licencia }}</td>
                                                    <td class="border px-3 text-center">{{ $ballot->infractions->code }}</td>
                                                    <td class="border px-3 text-center">{{ $ballot->infractions->uit_penalty }}</td>
                                                    <td class="border px-3 text-center">{{ $ballot->infractions->administrative_sanction }}</td>
                                                    <td class="border px-3 text-center">{{ $ballot->placa_vehiculo }}</td>
                                                    <td class="border px-3 text-center">{{ $ballot->estado_actual }}</td>
                                                    <td class="border px-3 text-center">{{ date('d/m/Y', strtotime($ballot->fecha_infraccion)) }}</td>
                                                    <td class="border px-3 text-center">{{ $ballot->campus->alias }}</td>
                                                    <td class="border px-3">
                                                        <button wire:click="showControlAct({{ $ballot->id }})" class="inline-flex items-center bg-blue-500 text-white font-bold py-1 px-4 hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:bg-blue-900 disabled:opacity-25 transition rounded text-xs my-1 py-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                            <span class="mx-1">Ver</span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </div>
                                        @empty
                                        <tr class="text-center">
                                            <td colspan="11" class="py-3 bg-gray-100 border font-mono text-xs">.:No existe información de Actas de Control:.</td>
                                        </tr>
                                        @endforelse
                                    @elseif($selectValue == 2)
                                        @forelse ($ballots as $ballot)
                                        <div>
                                            <tr>
                                                <td class="border px-3 text-xs text-center">{{ $ballot->act_number }}</p></td>
                                                <td class="border px-3 text-xs">{{ $ballot->names_business_name }}</td>
                                                <td class="border px-3 text-xs text-center">{{ $ballot->licence_number }}</td>
                                                <td class="border px-3 text-xs text-center">{{ $ballot->infraction->code }}</td>
                                                <td class="border px-3 text-xs text-center">{{ $ballot->infraction->uit_penalty }}</td>
                                                <td class="border px-3 text-xs text-center">{{ $ballot->infraction->administrative_sanction }}</td>
                                                <td class="border px-3 text-xs text-center">{{ $ballot->vehicle->plate_number }}</td>
                                                <td class="border px-3 text-xs text-center">{{ $ballot->status }}</td>
                                                <td class="border px-3 text-xs text-center">{{ date('d/m/Y', strtotime($ballot->date_infraction)) }}</td>
                                                <td class="border px-3 text-xs text-center">{{ $ballot->campus->alias }}</td>
                                                <td class="border px-3">
                                                    <button wire:click="showInspectionAct({{ $ballot->id }})" class="inline-flex items-center bg-blue-500 text-white font-bold py-1 px-4 hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:bg-blue-900 disabled:opacity-25 transition rounded text-xs my-1 py-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        <span class="mx-1">Ver</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        </div>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="11" class="py-3 bg-gray-100 border font-mono text-xs">.:No existe información de Actas de Fiscalizacion:.</td>
                                            </tr>
                                        @endforelse
                                    @endif
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