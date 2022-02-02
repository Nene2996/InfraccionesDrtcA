@if ($radioValue == 1 || $radioValue == 2)
<div class="h-screen">
@endif

    <div class="">
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @if (session()->has('message'))
                        <div class="mx-16 mt-8 p-2">
                            <div x-data="{ show: true }" x-show="show"
                            class="flex justify-between items-center bg-green-200 relative text-green-700 py-3 px-3 rounded-lg border border-green-400">
                                <div>
                                    <span class="font-semibold text-gray-800">Bien echo !!!</span>
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
                        <p class="capitalize font-bold">registros de actas de fiscalizacion</p>
                    </div>
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200 text-sm">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <div>
                                    <h3 class="text-gray-600 font-semibold">Tipo de busqueda:</h3>
                                    <ul class="flex">
                                        <li>
                                            <label class="mr-10 text-gray-700">
                                                <input wire:model='radioValue' wire:click="resetInput()" type="radio" name="myRadios" class="mr-2 checked:bg-blue-600" value="0" >Por Apellidos y nombres
                                            </label>
                                        </li>
                                        <li>
                                            <label class="mr-10 text-gray-700">
                                                <input wire:model='radioValue' wire:click="resetInput()" type="radio" name="myRadios" class="mr-2 checked:bg-blue-600" value="1" >Por Num. Dni
                                            </label>
                                        </li>
                                        <li>
                                            <label class="mr-10 text-gray-700">
                                                <input wire:model='radioValue' wire:click="resetInput()" type="radio" name="myRadios" class="mr-2 checked:bg-blue-600" value="2" >Por Num. Acta
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="flex">
                                    @if ($isOpendivLastName)
                                        <div class="mt-5 flex-col w-2/6">
                                            <div>
                                                <input wire:model='radio_names_business_name' type="text" class="rounded-md w-full text-sm" placeholder="Ingresa el nombre y apellidos">
                                            </div>
                                        </div>
                                    @endif
            
                                    @if ($isOpendivNumberLicence)
                                        <div class="mt-5 flex-col w-2/6">
                                            <div>
                                                <input wire:model='radio_dni_number' type="text" class="rounded-md w-full text-sm" placeholder="Ingresa el Numero de Licencia">
                                            </div>
                                        </div>
                                    @endif
            
                                    @if ($isOpendivNumberAct)
                                        <div class="mt-5 flex-col w-2/6">
                                            <div>
                                                <input wire:model='radio_act_number' type="text" class="rounded-md w-full text-sm" placeholder="Ingresa el Numero de Acta">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <div class="px-5 flex justify-end">
                                    <div class=" mt-5 p-2">
                                        <a href="{{ route('actasDeFiscalizacion.create') }}" class="flex items-center p-4 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            <div>
                                                <p class="text-sm font-medium ml-2"> 
                                                Registrar Acta de Fiscalizacion
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-2 px-5 bg-white justify-center">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-200 text-xs">
                                    <th class="border px-3">Nro. Acta</th>
                                    <th class="border px-3">Nombre y Apellidos / Razón Social</th>
                                    <th class="border px-3">Dni / Ruc</th>
                                    <th class="border px-3">Nro de Licencia</th>
                                    <th class="border px-3">Infracción</th>
                                    <th class="border px-3">Calificación</th>
                                    <th class="border w-24 text-center">Fecha</th>
                                    <th class="border px-3">Hora</th>
                                    <th class="border px-3">Lugar</th>
                                    <th class="border px-3">Estado</th>
                                    <th class="border px-3">Sede</th>
                                    <th class="border px-3">Archivo Digital</th>
                                    <th class="border px-3">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($inspections as $inspection)
                                <tr class="hover:bg-gray-100">
                                    <td class="border px-3 text-xs">{{ $inspection->act_number }}</p></td>
                                    <td class="border px-3 text-xs">{{ $inspection->names_business_name }}</td>
                                    <td class="border px-3 text-xs">{{ $inspection->document_number }}</td>
                                    <td class="border px-3 text-xs">{{ $inspection->licence_number }}</td>
                                    <td class="border px-3 text-xs">{{ $inspection->infraction->code }}</td>
                                    <td class="border px-3 text-xs">{{ $inspection->infraction->qualification }}</td>
                                    <td class="border px-3 text-xs">{{ date('d/m/Y', strtotime($inspection->date_infraction)) }}</td>
                                    <td class="border px-3 text-xs">{{ $inspection->hour_infraction }}</td>
                                    <td class="border px-3 text-xs">{{ $inspection->place }}</td>
                                    <td class="border px-3 text-xs">{{ $inspection->status }}</td>
                                    <td class="border px-3 text-xs">{{ $inspection->campus->alias }}</td>
                                    <td class="border px-3 px-6 py-4 text-center">
                                        @if ($inspection->file)
                                            <div class="whitespace-nowrap text-red-600">
                                                <a href="{{ Storage::url($inspection->file->url_path) }}" target="_blank">
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
                                        <div class="flex item-center space-x-1 my-2">
                                            @if (auth()->user()->campus->campus_name == $inspection->campus->campus_name)
                                                @if(auth()->user()->role == 'Asistente Administrativo')
                                                    <a type="button" title="MODIFICAR ACTA" class="md:w-auto border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actasDeFiscalizacion.edit', $inspection) }}">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a type="button" title="ADJUNTAR MEDIO PROBATORIO" class="md:w-auto py-2 border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actasDeFiscalizacion.evidence', $inspection) }} ">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm3 2h6v4H7V5zm8 8v2h1v-2h-1zm-2-2H7v4h6v-4zm2 0h1V9h-1v2zm1-4V5h-1v2h1zM5 5v2H4V5h1zm0 4H4v2h1V9zm-1 4h1v2H4v-2z" clip-rule="evenodd" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                @endif
                                                
                                                @if (auth()->user()->role == 'Asistente de Caja')
                                                    @if ($inspection->hasPaiment($inspection->id))
                                                    <a type="button" title="MODIFICAR PAGO" class="md:w-auto py-2 border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actaFiscalizacion.pagar', $inspection) }} ">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    @else
                                                        <a type="button" title="REALIZAR PAGO" class="md:w-auto py-2 border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actaFiscalizacion.pagar', $inspection) }} ">
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    @endif
                                                @endif
                                            @endif
                                            <button title="VER DETALLES" wire:click="loadModelId({{ $inspection->id }})" class="md:w-auto border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                            </button>

                                            <!---------------------------------------------------------------------------------->
                                            @if (auth()->user()->role == 'Administrador')
                                                <a type="button" title="MODIFICAR ACTA" class="md:w-auto border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actasDeFiscalizacion.edit', $inspection) }}">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </span>
                                                </a>
                                                <a type="button" class="border-2 border-red-600 rounded-lg px-2 py-1 text-red-600 cursor-pointer hover:bg-red-600 hover:text-red-200 focus:outline-none" href="{{ route('actaFiscalizacion.pagar', $inspection) }} ">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </span>
                                                </a>

                                                @if ($inspection->hasPaiment($inspection->id))
                                                    <a type="button" title="MODIFICAR PAGO" class="md:w-auto py-2 border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actaFiscalizacion.pagar', $inspection) }} ">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                @else
                                                    <a type="button" title="REALIZAR PAGO" class="md:w-auto py-2 border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actaFiscalizacion.pagar', $inspection) }} ">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                @endif

                                                @if ($inspection->hasResolution($inspection->id))
                                                    <a type="button" title="MODIFICAR RESOLUCIÓN" class="md:w-auto border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actasDeFiscalizacion.EditarResolucion', $inspection) }}">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                @else 
                                                <a type="button" title="REGISTRAR RESOLUCIÓN" class="md:w-auto border-2 border-gray-600 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-600 hover:text-gray-200" href="{{ route('actasDeFiscalizacion.EditarResolucion', $inspection) }}">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </span>
                                                </a> 
                                                @endif
                                                
                                            @endif
                    
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
                        @if ($inspections->hasPages())
                            <div class="my-3">
                                {{ $inspections->links() }}
                            </div>
                        @endif
                        
                        @if ($isModalWarnigOpen == true)
                        <x-jet-confirmation-modal>
                            <x-slot name="title">
                                Informacion:
                            </x-slot>
                        
                            <x-slot name="content">
                                No puede realizar la cambios en la Acta de Fiscalización número: <strong>{{ $act_number }}</strong> porque corresponde a: <strong>{{ $campus }}</strong>. 
                            </x-slot>
                        
                            <x-slot name="footer">
                                <x-jet-button wire:click="closeModalWarnig()">
                                    Aceptar
                                </x-jet-button>
                            </x-slot>
                        </x-jet-confirmation-modal>
                        @endif
                        
                        @if ($isModalShowOpen == true)
                        <x-jet-dialog-modal maxWidth="6xl">
                            <x-slot name="title">
                            <strong>Detalles de la Infracción:</strong> 
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
                                                        <td class="text-xs"><strong>Nombres</strong></td>
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
                                    <div class="flex justify-center mt-2">
                                        <table>
                                            <thead>
                                                <tr class="bg-gray-200 text-xs">
                                                    <th>CODIGO DE INFRACCION</th>
                                                    <th>DESCRIPCION</th>
                                                    <th>AGENTE INFRACTOR</th>
                                                    <th>UIT</th>
                                                    <th>SANCION ADMINISTRATIVA</th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border px-3 text-xs">{{ $infraction_code }}</td>
                                                    <td class="border px-3 text-xs">{{ $infraction_description }}</td>
                                                    <td class="border px-3 text-xs">{{ $infraction_infringement_agent }}</td>
                                                    <td class="border px-3 text-xs">{{ $infraction_uit_penalty }}</td>
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
                                                    <td class="border px-3 text-xs w-24 text-center">{{ date('d-m-Y', strtotime($date_infraction)) }}</td>
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
                                        <label for="" class="text-sm font-extrabold">DETALLES DEL PAGO REALIZADO</label>
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

                                    @endif
                                    <!-------------------resoluciones asocidas----------------------------------------------->
                                    @if ($hasResolutions)
                                    <div class="flex justify-center mt-2">
                                        <label for="" class="text-sm font-extrabold">DETALLE DE RESOLUCIONES ASOCIADAS</label>
                                    </div>
                                    <div class="flex justify-center">
                                        <table>
                                            <thead>
                                                <tr class="bg-gray-200 text-xs">
                                                    <th class="border px-3">Tipo de Resolucion</th>
                                                    <th class="border px-3">Fecha Emisión</th>
                                                    <th class="border px-3">Nombre Resolución</th>
                                                    <th class="border px-3">Documento</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($resolutions as $resolution)
                                                    <tr class="text-center">
                                                        <td class="border px-3 text-xs">{{ $resolution->type }}</td>
                                                        <td class="border px-3 text-xs">{{ date('d/m/Y', strtotime($resolution->date_resolution)) }}</td>
                                                        <td class="border px-3 text-xs">{{ $resolution->title }}</td>
                                                        <td class="border px-3 text-xs">
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
                                </div>
                            </x-slot>
                        
                            <x-slot name="footer">
                                <x-jet-button wire:click="closeModalShow()">
                                    Aceptar
                                </x-jet-button>
                            </x-slot>
                        </x-jet-dialog-modal>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@if ($radioValue == 1 || $radioValue == 2)
</div>
@endif

