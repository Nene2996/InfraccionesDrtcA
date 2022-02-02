
@if ($radioValue == 3)
<div class="h-screen">
@endif
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if ($isModalShowOpen)
                    @include('components.control-act.show')
                @endif
                @if (session()->has('message'))
                    <div class="mx-16 mt-8 p-2">
                        <div x-data="{ show: true }" x-show="show"
                        class="flex justify-between items-center bg-green-200 relative text-green-700 py-3 px-3 rounded-lg border border-green-400">
                            <div>
                                <span class="font-semibold text-gray-800">Bien echo.!</span>
                                {{ session('message') }}
                            </div>
                            <div>
                                <button type="button" @click="show = false" class=" text-green-700">
                                    <span class="text-2xl">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="flex justify-center mt-4">
                    <p class="capitalize font-bold">registros de actas de control</p>
                </div>
                <div class="flex">
                    <div class="flex-col w-4/6 px-8 pt-3 text-sm">
                        <div>
                            <h3 class="text-gray-600 font-semibold">Tipo de busqueda:</h3>
                            <ul class="flex">
                                <li>
                                    <label class="mr-10 text-gray-700">
                                        <input wire:model='radioValue' wire:click="resetInput()" type="radio" name="myRadios" class="mr-2 checked:bg-blue-600" value="0" checked>Apellidos y Nombres
                                    </label>
                                    @error('radioValue')
                                        <div class="text-red-500">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </li>
                                <li>
                                    <label class="mr-10 text-gray-700">
                                        <input wire:model='radioValue' wire:click="resetInput()" type="radio" name="myRadios" class="mr-2 checked:bg-blue-600" value="1" checked>Nro. Licencia
                                    </label> 
                                </li>
                                <li>
                                    <label class="mr-10 text-gray-700">
                                        <input wire:model='radioValue' wire:click="resetInput()" type="radio" name="myRadios" class="mr-2 checked:bg-blue-600" value="2" checked>Nro. Dni
                                    </label> 
                                </li>
                                <li>
                                    <label class="mr-10 text-gray-700">
                                        <input wire:model='radioValue' wire:click="resetInput()" type="radio" name="myRadios" class="mr-2 checked:bg-blue-600" value="3" checked>Nro. Acta
                                    </label> 
                                </li>
                            </ul>
                        </div>
                        <div class="flex">
                            @if ($isOpendivLastName)
                                <div class="mt-5 flex-col w-2/6">
                                    <div>
                                        <input wire:model='searchvalue' type="text" class="rounded-md w-full text-sm" placeholder="{{ $placeholder_search }}">
                                    </div>
                                    <div>
                                        @error('searchName')
                                            <span class="text-red-500 text-sm italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="mt-20 ml-48 p-2">
                            <a href="{{ route('actasDeControl.create') }}" class="flex items-center p-4 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                <div>
                                    <p class="text-sm font-medium ml-2"> 
                                    Registrar Acta de Control
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center mx-8 text-sm">
                    <span>Mostrar</span>
                    <select wire:model="cant" name="" id="" class="mx-2 rounded-md text-sm">
                        <option value="10">10</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>registros</span>
                </div>
                
                <div class="py-2 px-5 bg-white flex justify-center">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-200 text-xs">
                                <th class="border px-3">Num. Acta</th>
                                <th class="border px-3">Conductor</th>
                                <th class="border px-3">Num. Dni</th>
                                <th class="border px-3">Num. de Licencia</th>
                                <th class="border px-3">Placa Vehiculo</th>
                                <th class="border px-3">Fecha. Infracción</th>
                                <th class="border px-3">Cod. Infracción</th>
                                <th class="border px-3">Tipo de Infracción</th>
                                <th class="border px-3">Sancion Pecuniaria</th>
                                <th class="border px-3">Sancion Administrativa</th>
                                <th class="border px-3">Estado Actual</th>
                                <th class="border px-3">Sede Infracción</th>
                                <th class="border px-3">Archivo digital</th>
                                <th class="border px-3">Operaciones</th>  
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($controlActs as $controlAct)
                                
                                <tr class="hover:bg-gray-100">
                                    <td class="border px-3 text-xs text-center">{{ $controlAct->numero_acta }}</td>
                                    <td class="border px-3 text-xs">{{ $controlAct->apellidos_nombres_conductor }}</td>
                                    <td class="border px-3 text-xs">{{ $controlAct->nro_dni_conductor }}</td>
                                    <td class="border px-3 text-xs">{{ $controlAct->nro_licencia }}</td>
                                    <td class="border text-center text-xs text-center">{{ $controlAct->placa_vehiculo }}</td>
                                    <td class="border text-center text-xs">{{ date('d/m/Y', strtotime($controlAct->fecha_infraccion)) }}</td>
                                    <td class="border px-3 text-xs text-center">{{ $controlAct->infractions->code }}</td>
                                    <td class="border px-3 text-xs text-center">{{ $controlAct->infractions->type }}</td>
                                    <td class="border px-3 text-xs">{{ $controlAct->infractions->uit_penalty }}</td>
                                    <td class="border px-3 text-xs text-center">{{ $controlAct->infractions->administrative_sanction }}</td>
                                    <td class="border px-3 text-xs text-center">{{ $controlAct->estado_actual }}</td>
                                    <td class="border px-3 text-xs text-center">{{ $controlAct->campus->alias }}</td>
                                    <td class="border px-3 px-6 py-4 text-center">
                                        @if ($controlAct->file)
                                        <div class="whitespace-nowrap text-red-600">
                                            <a href="{{ Storage::url($controlAct->file->url_path) }}" target="_blank">
                                                <span>
                                                    <i class="far fa-file-pdf fa-lg"></i>
                                                </span>
                                            </a>
                                        </div>
                                        @else
                                        <div class="text-xs">
                                            <p>No subido</p>
                                        </div>
                                        @endif
                                    </td>
                                    <td class="border px-3 text-xs">
                                        <div class="flex item-center space-x-1">
                                            <!-------------------------------------------------------------------------------->
                                            @if (auth()->user()->role == 'Asistente Administrativo')
                                                @if (auth()->user()->campus->alias == $controlAct->campus->alias)
                                                    <a type="button" title="MODIFICAR ACTA" class="md:w-auto border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actasDeControl.edit', $controlAct) }}">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                @endif
                                            @endif
                                            @if (auth()->user()->role == 'Administrador')
                                                
                                                    <a type="button" title="MODIFICAR ACTA" class="md:w-auto border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actasDeControl.edit', $controlAct) }}">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a type="button" title="REALIZAR PAGO" class="md:w-auto py-2 border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actaControl.pagar', $controlAct) }}">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                                              </svg>
                                                        </span>
                                                
                                                    </a>

                                                    @if ($controlAct->hasResolution($controlAct->id))
                                                    <a type="button" title="MODIFICAR RESOLUCIÓN" class="md:w-auto border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actasDeControl.EditarResolucion', $controlAct) }}">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    @else 
                                                    <a type="button" title="ADJUNTAR RESOLUCIÓN" class="md:w-auto border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actasDeControl.EditarResolucion', $controlAct) }}">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                                            </svg>
                                                        </span>
                                                    </a> 
                                                    @endif

                                                

                                            @endif
                                            <!------------------------------------------------------------------------------>
                                            @if (auth()->user()->role == 'Asistente de Caja')
                                                
                                                <a type="button" title="REALIZAR PAGO" class="md:w-auto py-2 border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actaControl.pagar', $controlAct) }}">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                                          </svg>
                                                    </span>
                                                </a>
                                                
                                            @endif
                                            <!-------------------------------------------------------------------------------->
                                            <button title="VER DETALLES" wire:click="loadControlActId({{ $controlAct->id }})" class="md:w-auto border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                      </svg>
                                                </span>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            @empty

                            <tr class="text-center">
                                <td colspan="12" class="py-3 italic">No hay registro de Infracciones.</td>
                            </tr>
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($controlActs->hasPages())
                    <div class="pb-6 px-5 bg-white my-6">
                        {{ $controlActs->links() }} 
                    </div> 
                @endif
            </div>
        </div>
    </div>
@if ($radioValue == 3)
</div>
@endif
