<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div>
                    <div>
                        <div class="grid grid-cols-4 gap-3 mt-3">
                            <div class="grid grid-col-1" >
                                <label for=""><strong>Nro. Acta:</strong> </label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $nro_acta }}</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Nombres Apellidos Conductor:</strong></label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $nombre_apellidos_conductor }}</h3>
                        </div>
                        <div class="grid grid-cols-4 gap-3 mt-3">
                            <div class="grid grid-col-1" >
                                <label for=""><strong>Nro. Dni:</strong> </label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $dni_conductor }}</h3>
                            </div>
                            <div class="grid grid-col-1" >
                                <label for=""><strong>Nro. Licencia:</strong> </label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $nro_licencia }}</h3>
                            </div>
                            <div class="grid grid-col-1" >
                                <label for=""><strong>Clase-Categoria:</strong> </label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $clase_categoria_licencia }}</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-4 gap-3 mt-3">
                            <div class="grid grid-col-1" >
                                <label for=""><strong>Codigo Infraccion:</strong> </label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $codigo_infraccion }}</h3>
                            </div>
                            <div class="grid grid-col-1" >
                                <label for=""><strong>Fecha Infraccion:</strong> </label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ date('d/m/Y', strtotime($fecha_infraccion)) }}</h3>
                            </div>
                            <div class="grid grid-col-1" >
                                <label for=""><strong>Hora Infraccion:</strong> </label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $hora_infraccion }}</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div class="grid grid-col-1" >
                                <label for=""><strong>Sancion Administrativa:</strong> </label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $sancion_administrativa }}</h3>
                            </div>
                            <div class="grid grid-col-1" >
                                <label for=""><strong>Sancion Pecuniaria:</strong> </label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $sancion_pecuniaria }}</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Descripcion:</strong></label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $descripcion }}</h3>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Estado:</strong></label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $estado_actual }}</h3>
                        </div>

                        <x-jet-section-border />

                        <form wire:submit.prevent="uploadToServer">
                            <div class="grid grid-cols-1">
                                <label for=""><strong>Selecciona la Resolución:</strong></label>
                                <select name="" id="" class="rounded-md" wire:model="resolution_id" required>
                                    <option value="" disabled>Selecciona...</option>
                                    @foreach ($resolutions as $resolution)
                                        <option value="{{ $resolution->id }}">{{ $resolution->title }}</option>
                                    @endforeach
                                </select>
                                
                            </div>

                            @error('resolution_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                            <div class="grid grid-cols-4 gap-3 my-2">
                                <div class="grid grid-cols-1">
                                    
                                    @if ($resolution_id)
                                        <label for=""><strong>Tipo de resolucion:</strong></label>
                                        <span>{{ $this->resolution->type }}</span>
                                    @endif
                                </div>
                                <div class="grid grid-cols-1">
                                    
                                    @if ($resolution_id)
                                        <label for=""><strong>Fecha de resolucion:</strong></label>
                                        <span>{{ date('d-m-Y', strtotime($this->resolution->date_resolution)) }}</span>
                                    @endif
                                </div>
                                <div class="grid grid-cols-1">
                                    @if ($resolution_id)
                                    <div class="flex justify-start">
                                        <a class="cursor-pointer hover:text-gray-500" href="{{ Storage::url($this->resolution->url) }}" target="_blank"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"     stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>[Ver Pdf]
                                        </a>
                                    </div>
                                    @endif
                                    
                                </div>
                            </div>
                            @if ($resolution_id)
                                @if ($this->resolution->type == 'RESOLUCIÓN DE SANCION')
                                    <div class="grid grid-cols-4 gap-3 my-2">
                                        <div class="grid grid-cols-1">
                                            <label for=""><strong>Fecha de Notificacion al Infractor:</strong></label>
                                            <input type="date" class="rounded-md" wire:model="date_notification_driver">
                                        </div>
                                    </div>
                                    <div>
                                        @error('date_notification_driver') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                                    </div> 
                                @endif
                            @endif
                            <div class="my-3">
                                <x-jet-button>
                                    SUBIR RESOLUCION
                                </x-jet-button>
                                <a type="button" href="{{ route('actasDeControl.show') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Regresar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>