<div>
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
                                        @error('radioValue')
                                            <div class="text-red-500">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </li>
                                    <li>
                                        <label class="mr-10 text-gray-700">
                                            <input wire:model='radioValue' wire:click="resetInput()" type="radio" name="myRadios" class="mr-2 checked:bg-blue-600" value="1" >Por Num. Dni
                                        </label>
                                        @error('radioValue')
                                            <div class="text-red-500">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </li>
                                    <li>
                                        <label class="mr-10 text-gray-700">
                                            <input wire:model='radioValue' wire:click="resetInput()" type="radio" name="myRadios" class="mr-2 checked:bg-blue-600" value="2" >Por Num. Acta de Fiscalización
                                        </label>
                                        @error('radioValue')
                                            <div class="text-red-500">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </li>
                                </ul>
                            </div>
                            <div class="flex">
                                @if ($isOpendivLastName)
                                    <div class="mt-5 flex-col w-2/6">
                                        <div>
                                            <input wire:model='radio_names_business_name' type="text" class="rounded-md w-full text-sm" placeholder="Ingresa el nombre y apellidos">
                                        </div>
                                        <div>
                                            @error('radio_names_business_name')
                                                <span class="text-red-500 text-sm italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
        
                                @if ($isOpendivNumberLicence)
                                    <div class="mt-5 flex-col w-2/6">
                                        <div>
                                            <input wire:model='radio_dni_number' type="text" class="rounded-md w-full text-sm" placeholder="Ingresa el Numero de Licencia">
                                        </div>
                                        <div>
                                            @error('radio_dni_number')
                                                <span class="text-red-500 text-sm italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
        
                                @if ($isOpendivNumberAct)
                                    <div class="mt-5 flex-col w-2/6">
                                        <div>
                                            <input wire:model='radio_act_number' type="text" class="rounded-md w-full text-sm" placeholder="Ingresa el Numero de Acta">
                                        </div>
                                        <div>
                                            @error('radio_act_number')
                                                <span class="text-red-500 text-sm italic">{{ $message }}</span>
                                            @enderror
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
                                            <p class="text-xs font-medium ml-2"> 
                                            Registrar Acta de Fiscalizacion
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-6 px-5 bg-white border-b border-gray-200">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-200 text-xs">
                                <th class="border px-3">NRO. ACTA</th>
                                <th class="border px-3">NOMBRE Y APELLIDOS / RAZÓN SOCIAL</th>
                                <th class="border px-3">DNI / RUC</th>
                                <th class="border px-3">NRO DE LICENCIA</th>
                                <th class="border px-3">INFRACCIÓN</th>
                                <th class="border px-3">CALIFICACIÓN</th>
                                <th class="border w-24 text-center">FECHA</th>
                                <th class="border px-3">HORA</th>
                                <th class="border px-3">LUGAR</th>
                                <th class="border px-3">ESTADO</th>
                                <th class="border px-3">SEDE</th>
                                <th class="border px-3">OPCIONES</th>
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
                                <td class="border px-3 text-xs">{{ $inspection->qualification }}</td>
                                <td class="border px-3 text-xs">{{ date('d-m-Y', strtotime($inspection->date_infraction)) }}</td>
                                <td class="border px-3 text-xs">{{ $inspection->hour_infraction }}</td>
                                <td class="border px-3 text-xs">{{ $inspection->place }}</td>
                                <td class="border px-3 text-xs">{{ $inspection->status }}</td>
                                <td class="border px-3 text-xs">{{ $inspection->campus->alias }}</td>
                                <td class="border px-3 text-xs">
                                    <div class="flex item-center space-x-1">
                                        
                                        @if (auth()->user()->campus->campus_name == $inspection->campus->campus_name)
                                        
                                            <a type="button" class="md:w-auto border-2 border-blue-600 rounded-lg px-3 py-1 text-blue-600 cursor-pointer hover:bg-blue-600 hover:text-blue-200" href="{{ route('actasDeFiscalizacion.edit', $inspection) }}">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </span>
                                            </a>
                                            
                                        @else
                                            <div>
                                                <button  class="md:w-auto border-2 border-red-600 rounded-lg px-3 py-1 text-red-600 cursor-pointer hover:bg-red-600 hover:text-red-200" wire:click="loadModelWarning({{ $inspection->id }})">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                    </svg>
                                                </span>
                                                </button>
                                            </div>
                                        @endif
                                        
                                        <button wire:click="loadModelId({{ $inspection->id }})" class="md:w-auto border-2 border-gray-800 rounded-lg px-3 py-1 text-gray-600 cursor-pointer hover:bg-gray-800 hover:text-gray-200 focus:outline-none">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </span>
                                        </button>

                                        <!---------------------------------------------------------------------------------->
                                        @if (auth()->user()->role == 'Asistente de Caja')
                                            @if ($inspection->status == 'PENDIENTE DE PAGO')
                                                <a type="button" class="border-2 border-green-600 rounded-lg px-2 py-1 text-green-600 cursor-pointer hover:bg-green-600 hover:text-green-200 focus:outline-none" href="{{ route('actasDeFiscalizacion.paiment', $inspection) }} ">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                      </svg>
                                                </span>
                                                </a>
                                            @endif
                                        @endif


                                        <!---------------------------------------------------------------------------------->
                                        @if (auth()->user()->role == 'Administrador')
                                            <a type="button" class="border-2 border-red-600 rounded-lg px-2 py-1 text-red-600 cursor-pointer hover:bg-red-600 hover:text-red-200 focus:outline-none" href="{{ route('actasDeFiscalizacion.paiment', $inspection) }} ">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                      </svg>
                                                </span>
                                            </a>

                                            @if ($inspection->status == 'PENDIENTE DE PAGO')
                                                <a type="button" class="border-2 border-green-600 rounded-lg px-2 py-1 text-green-600 cursor-pointer hover:bg-green-600 hover:text-green-200 focus:outline-none" href="{{ route('actasDeFiscalizacion.paiment', $inspection) }} ">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                          </svg>
                                                    </span>
                                                </a>
                                                @if ($inspection->hasResolution($inspection->id))
                                                    <a type="button" title="MODIFICAR RESOLUCIÓN" class="border-2 border-yellow-600 rounded-lg px-2 py-1 text-yellow-600 cursor-pointer hover:bg-yellow-600 hover:text-yellow-200 focus:outline-none" href="{{ route('actasDeFiscalizacion.EditarResolucion', $inspection) }}">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                @else 
                                                <a type="button" title="REGISTRAR RESOLUCIÓN" class="border-2 border-yellow-600 rounded-lg px-2 py-1 text-yellow-600 cursor-pointer hover:bg-yellow-600 hover:text-yellow-200 focus:outline-none" href="{{ route('actasDeFiscalizacion.EditarResolucion', $inspection) }}">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </span>
                                                </a> 
                                                @endif
                                                
                    
                                            @else
                                                @if ($inspection->hasResolution($inspection->id))
                                                <a type="button" title="MODIFICAR RESOLUCIÓN" class="border-2 border-yellow-600 rounded-lg px-2 py-1 text-yellow-600 cursor-pointer hover:bg-yellow-600 hover:text-yellow-200 focus:outline-none" href="{{ route('actasDeFiscalizacion.EditarResolucion', $inspection) }} ">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </span>
                                                </a>
                                                @endif

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
                                                    <td class="text-xs"><strong>Apellidos y Nombres</strong></td>
                                                @else
                                                    <td class="text-xs"><strong>Razón Social</strong></td>
                                                @endif
                                                <td class="text-xs">:{{ $names_business_name }}</td>
                                                <td class=" text-xs pl-36"><strong>Inspector</strong></td>
                                                <td class="text-xs">:{{ $inspector_surnames_and_names }}</td>
                                            </tr>
                                            <tr>
                                                @if ($typeDocument_id == 1)
                                                    <td class=" text-xs"><strong>Dni</strong></td>
                                                @else
                                                    <td class="text-xs"><strong>Ruc</strong></td>
                                                @endif
                                                <td class="text-xs">:{{ $document_number }}</td>
                                                <td class="text-xs pl-36"><strong>Registrado por</strong></td>
                                                <td class="text-xs">:{{ $operator_surnames_and_names }}</td> 
                                            </tr>
                                            <tr>
                                                <td class="text-xs"><strong>Nº de Licencia</strong></td>
                                                <td class="text-xs">:{{ $licence_number }}</td>
                                                <td class="text-xs pl-36"><strong>Fecha de Registro</strong></td>
                                                <td class="text-xs">:{{ $inspection_created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-xs"><strong>Domicilio</strong></td>
                                                <td class="text-xs">:{{ $address }}</td>
                                                <td class="text-xs pl-36"><strong>Lugar de Registro</strong></td>
                                                <td class="text-xs">:{{ $inspection_campus }}</td>
                                            </tr>
                                        </div>
                                    </tbody>
                                </table> 
                                <x-jet-section-border />
                                <div class="flex justify-center">
                                    <label for="" class="mb-3">DETALLE DE LA INFRACCION IMPUESTA</label>
                                </div>
                                
                                <table>
                                    <thead>
                                        <tr class="bg-gray-200 text-xs">
                                            <th>CODIGO DE INFRACCION</th>
                                            <th>DESCRIPCION</th>
                                            <th>AGENTE INFRACTOR</th>
                                            <th>UIT</th>
                                            <th>MONTO</th>
                                            <th>SANCION ADMINISTRATIVA</th>
                                            <th>DESCUENTO 5 DIAS</th>
                                            <th>DESC. 15 DIAS NOTIFICADO MEDIANTE RESOLUCION DE SANCIÓN</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border px-3 text-xs">{{ $infraction_code }}</td>
                                            <td class="border px-3 text-xs">{{ $infraction_description }}</td>
                                            <td class="border px-3 text-xs">{{ $infraction_infringement_agent }}</td>
                                            <td class="border px-3 text-xs">{{ $infraction_uit_penalty }}</td>
                                            <td class="border px-3 text-xs">S/.{{ $infraction_pecuniary_sanction }}</td>
                                            <td class="border px-3 text-xs">{{ $infraction_administrative_sanction }}</td>
                                            <td class="border px-3 text-xs">S/.{{ $infraction_discount_five_days }}</td>
                                            <td class="border px-3 text-xs">S/.{{ $infraction_discount_fifteen_days }}</td>
                                        </tr>
        
                                    </tbody>
                                </table>
                                <div class="flex justify-center my-8">
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
                                                @if (isset($proof_number))
                                                <th>Num. Comprobante de Pago</th>
                                                @endif
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
                                                @if (isset($proof_number))
                                                    <td class="border px-3 text-xs">{{ $proof_number }}</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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

