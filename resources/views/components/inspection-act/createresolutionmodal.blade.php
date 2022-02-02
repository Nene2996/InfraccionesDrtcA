<div class="@if (!$isCreateModalOpen) hidden @endif flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-600 bg-opacity-75">
    <div class="bg-white rounded-lg w-1/2">
        <form wire:submit.prevent="saveCreateResolution" class="w-full">
            <div class="flex flex-col items-start p-4">
                <div class="flex items-center w-full border-b pb-4">
                    <div class="text-gray-900 font-medium text-lg font-semibold">{{ $resolution_id_value ? 'Editar Resolución' : 'Agregar Resolución' }}</div>
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

                <body class="p-20">
                    <div class="max-w-xs">
                        <div

                            x-data="select({ data: { au: 'Australia', be: 'Belgium', cn: 'China', fr: 'France', de: 'Germany', it: 'Italy', mx: 'Mexico', es: 'Spain', tr: 'Turkey', gb: 'United Kingdom', 'us': 'United States' }, emptyOptionsMessage: 'Ningúna resolucion coincide con su búsqueda.', name: 'country', placeholder: 'Selecciona una resolucion' })"
                            x-init="init()"
                            @click.away="closeListbox()"
                            @keydown.escape="closeListbox()"
                            class="relative"
                        >
                                <span class="inline-block w-full rounded-md shadow-sm">
                                      <button
                                              x-ref="button"
                                              @click="toggleListboxVisibility()"
                                              :aria-expanded="open"
                                              aria-haspopup="listbox"
                                              class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5"
                                      >
                                            <span
                                                    x-show="! open"
                                                    x-text="value in options ? options[value] : placeholder"
                                                    :class="{ 'text-gray-500': ! (value in options) }"
                                                    class="block truncate"
                                            ></span>
                
                                            <input
                                                    x-ref="search"
                                                    x-show="open"
                                                    x-model="search"
                                                    @keydown.enter.stop.prevent="selectOption()"
                                                    @keydown.arrow-up.prevent="focusPreviousOption()"
                                                    @keydown.arrow-down.prevent="focusNextOption()"
                                                    type="search"
                                                    class="w-full h-full form-control focus:outline-none"
                                            />
                
                                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                                                    <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                                                          stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                      </button>
                                </span>
                
                            <div
                                    x-show="open"
                                    x-transition:leave="transition ease-in duration-100"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    x-cloak
                                    class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg"
                            >
                                <ul
                                        x-ref="listbox"
                                        @keydown.enter.stop.prevent="selectOption()"
                                        @keydown.arrow-up.prevent="focusPreviousOption()"
                                        @keydown.arrow-down.prevent="focusNextOption()"
                                        role="listbox"
                                        :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
                                        tabindex="-1"
                                        class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5"
                                >
                                    <template x-for="(key, index) in Object.keys(options)" :key="index">
                                        <li
                                                :id="name + 'Option' + focusedOptionIndex"
                                                @click="selectOption()"
                                                @mouseenter="focusedOptionIndex = index"
                                                @mouseleave="focusedOptionIndex = null"
                                                role="option"
                                                :aria-selected="focusedOptionIndex === index"
                                                :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }"
                                                class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9"
                                        >
                                                <span x-text="Object.values(options)[index]"
                                                      :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                                                      class="block font-normal truncate"
                                                ></span>
                
                                            <span
                                                    x-show="key === value"
                                                    :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
                                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600"
                                            >
                                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                              clip-rule="evenodd"/>
                                                    </svg>
                                                </span>
                                        </li>
                                    </template>
                
                                    <div
                                            x-show="! Object.keys(options).length"
                                            x-text="emptyOptionsMessage"
                                            class="px-3 py-2 text-gray-900 cursor-default select-none"></div>
                                </ul>
                            </div>
                        </div>
                

                    </div>
                </body>
                <div class="ml-auto">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">{{ $resolution_id_value ? 'Guardar Cambios' : 'Guardar' }}
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