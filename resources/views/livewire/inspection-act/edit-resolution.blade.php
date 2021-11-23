
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div>
                    <div>
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Nombres Apellidos / Razon Social:</strong></label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $names_business_name }}</h3>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-3 mt-3">
                        <div class="grid grid-col-1" >
                            <label for=""><strong>Acta de Fiscalización:</strong> </label>
                            @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                            <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $act_number }}</h3>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Dni/Ruc:</strong> </label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $document_number }}</h3>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Licencia de Conducir:</strong> </label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $licence_number }}</h3>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-3 my-2">
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Codigo de Infraccion:</strong> </label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $code }}</h3>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Uit:</strong> </label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $uit_penalty }}</h3>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Monto Uit:</strong> </label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $pecuniary_sanction }}</h3>
                        </div>
                    </div>
                    <div>
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Sancion Administrativa:</strong> </label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $administrative_sanction }}</h3>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-3 my-2">
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Fecha de la Infracción:</strong> </label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ date('d-m-Y', strtotime($date_infraction)) }}</h3>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-3 my-2">
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Estado de Infraccion:</strong> </label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $status }}</h3>
                        </div>
                    </div>
                    <x-jet-section-border />
                    <div>
                        <div>
                            @if ($isCreateModalOpen)
                                @include('components.inspection-act.createresolutionmodal')
                            @endif
                            @if ($isUpdateModalOpen)
                                @include('components.inspection-act.updateresolutionmodal')
                            @endif
                        </div>
                        <div>
                            <h1 class="font-bold">RESOLUCIONES ASOCIADAS:</h1>
                        </div>
                        <div>
                            <div class="flex justify-end">
                                <div class="m-3">
                                    <button wire:click="createResolution" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">Agregar</button>
                                </div>
                            </div>
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-200 text-xs">
                                        <th class="border px-3">Nombre Resolución</th>
                                        <th class="border px-3">Tipo</th>
                                        <th class="border px-3">Archivo</th>
                                        <th class="border px-3">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($associated_resolutions as $associated_resolution)
                                    <tr class="hover:bg-gray-100">
                                        <td class="border px-3 text-xs">{{ $associated_resolution->title }}</td>
                                        <td class="border px-3 text-xs">{{ $associated_resolution->type }}</td>
                                        <td class="border px-6 py-4 whitespace-nowrap text-red-600">
                                            <a href="{{ Storage::url($associated_resolution->url) }}" target="_blank">
                                                <span>
                                                    <i class="far fa-file-pdf fa-lg"></i>
                                                </span>
                                            </a>
                                        </td>
                                        <td class="border px-3 text-xs">
                                            <div class="flex justify-center">
                                                <button
                                                    wire:loading.attr="disabled"
                                                    wire:target="delete"
                                                    wire:click="editResolution({{ $associated_resolution->id }})"
                                                    class="text-indigo-700 hover:text-indigo-400">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </span>
                                                </button>
                                                <button
                                                    wire:loading.attr="disabled"
                                                    wire:target="delete"
                                                    wire:click.prevent="deleteResolution({{ $associated_resolution->id }})"
                                                    class="text-red-700 hover:text-red-400"
                                                    onclick="confirm('Estas seguro?') || event.stopImmediatePropagation()">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>
                                        </td>
                                        @empty
                                        <td colspan="4" class="border p-3 text-xs">No existen resoluciones asociadas</td>
                                        @endforelse
                                    </tr>
                                </tbody>
                            </table>
                        </div>                   
                        <div class="my-3">
                            
                            <a type="button" href="{{ route('actasDeFiscalizacion.show') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Regresar</a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
