<div class="py-12 content-center">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-2">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div>
                @if ($showDeleteModal)
                <x-jet-confirmation-modal>
                    <x-slot name="title">
                        Advertencia:
                    </x-slot>
                
                    <x-slot name="content">
                        Estas a punto de eliminar la Resolución: <strong>{{ $resolution_title}}</strong> 
                    </x-slot>
                
                    <x-slot name="footer">
                        <x-jet-secondary-button 
                            wire:click="delete" 
                            wire:loading.attr="disabled">
                            {{ __('Eliminar') }}
                        </x-jet-secondary-button>
        
                        <x-jet-button class="ml-2"
                                    wire:click="toReturn"
                                    wire:loading.attr="disabled">
                            {{ __('Cancelar') }}
                        </x-jet-button>
                    </x-slot>
                </x-jet-confirmation-modal>
                @endif
            </div>
            <div>
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
            </div>
            
            <div>
                <div class="px-5 flex justify-end">
                    <div class=" mt-5 p-2">
                        <a href="{{ route('SubirResolucion') }}" class="flex items-center p-4 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            <div>
                                <p class="text-sm font-medium ml-2"> 
                                Registrar Resolución
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-center">
                    <table class="divide-y divide-gray-200 w-full">
                        <thead class="bg-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider"> Titulo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tipo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha de emision</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tamaño MB</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Archivo PDF</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($resolutions as $resolution)
                            <tr class="px-6 py-4">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $resolution->title }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $resolution->type }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ date('d/m/Y', strtotime($resolution->date_resolution)) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ number_format($resolution->size/ 1048576, 2) . ' Mb' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-red-600">
                                        <a href="{{ Storage::url($resolution->url) }}" target="_blank">
                                            <span>
                                                <i class="far fa-file-pdf fa-lg"></i>
                                            </span>
                                        </a>
                                    </td>
                                    <td class="px-6 py-6 flex justify-center ">
                                        <a href="{{ route('EditarResolucion', $resolution) }}" class="text-indigo-700 hover:text-indigo-400">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </span>
                                        </a>
                                        <button
                                            wire:loading.attr="disabled"
                                            wire:target="delete"
                                            wire:click="showModal({{ $resolution }})"
                                            class="text-red-700 hover:text-red-400">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </span>
                                        </button>
                                        
                                    </td>
                                
                            </tr>
                            @empty 
                                <tr class="text-center">
                                    <td colspan="12" class="py-3">.:No hay registro de Resoluciones:.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>