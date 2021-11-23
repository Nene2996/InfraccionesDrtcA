<div class="@if (!$isCreateModalOpen) hidden @endif flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-600 bg-opacity-75">
    <div class="bg-white rounded-lg w-1/2">
        <form wire:submit.prevent="saveCreateResolution" class="w-full">
            <div class="flex flex-col items-start p-4">
                <div class="flex items-center w-full border-b pb-4">
                    <div class="text-gray-900 font-medium text-lg font-semibold">Agregar Resolución</div>
                    <svg wire:click="closeCreateModal"
                            class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                    </svg>
                </div>

                @if ($errors->get('exists_resolution'))
                    <div class="max-w-lg mx-auto mt-2">
                    <ul>
                        @foreach ($errors->get('exists_resolution') as $error)
                        <li>
                            <div class="flex bg-red-100 rounded-lg p-4 text-sm text-red-700" role="alert">
                                <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                <div>
                                    <span class="font-medium">{{ $error }}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    </div>
                @endif
                
                <div class="grid grid-cols-1 text-sm mt-2 w-full">
                    <label for=""><strong>Nombre de Resolución:</strong> </label>
                    <select name="" id="" wire:model="resolution_id" class="h-10 pl-3 pr-6 border rounded-lg text-xs">
                        <option value="" disabled selected>Selecciona</option>
                        
                        @forelse ($resolutions as $resolution)
                            <option value="{{ $resolution->id }}">{{ $resolution->title }}</option>
                        @empty
                            <option value="">No existen registros</option>
                        @endforelse
                    </select>
                    @error('resolution_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-1 my-2 text-sm">
                    
                    @if ($resolution_id)
                        <label for=""><strong>Tipo de resolucion:</strong></label>
                        <span>{{ $this->resolution->type }}</span>
                    @endif
                </div>
                <div class="grid grid-cols-1 my-2 text-sm">
                    
                    @if ($resolution_id)
                        <label for=""><strong>Fecha de resolucion:</strong></label>
                        <span>{{ date('d-m-Y', strtotime($this->resolution->date_resolution)) }}</span>
                    @endif
                </div>
                <div class="grid grid-cols-1">
                    @if ($resolution_id)
                        @if ($this->resolution->type == 'RESOLUCIÓN DE SANCION')
                            <div class="grid grid-cols-1 gap-3 my-2 text-sm">
                                <div class="grid grid-cols-1">
                                    <label for=""><strong>Fecha de Notificacion al Infractor:</strong></label>
                                    <input type="date" class="rounded-md" wire:model="date_notification_driver">
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <div>
                    @error('date_notification_driver') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                
                <div class="ml-auto">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">Guardar
                    </button>
                    <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded"
                            wire:click="closeCreateModal"
                            type="button"
                            data-dismiss="modal">Cerrar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>