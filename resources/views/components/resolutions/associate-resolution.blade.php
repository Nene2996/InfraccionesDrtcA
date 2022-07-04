<div class="@if (!$isOpenModalAssociateAct) hidden @endif flex items-baseline pt-32 justify-center fixed left-0 bottom-0 w-full h-full bg-gray-600 bg-opacity-75">
    <div class="bg-white rounded-lg w-9/12">
        <div class="flex flex-col p-4">
            
                <div class="flex items-center w-full border-b pb-4">
                    <div class="text-gray-900 font-medium text-lg font-semibold">Asociar Resolucion</div>
                    <svg wire:click="CloseModalAssociateAct"
                            class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                    </svg>
                </div>
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
                <fieldset class="border-2 border-gray-400 rounded-md p-2 mt-3 mb-3">
                    <legend class="ml-5 px-3 font-semibold">Detalles de la asociación:</legend>
                    <div class="grid grid-cols-1 my-2 gap-2">
                        <div class="h-auto grid grid-cols-1">
                            
                            <div class="">
                                <label for=""><strong>Lista de Resoluciones emitidas:</strong></label>
                                <div
                                        x-data="select({ data: @entangle('resolutions').defer, emptyOptionsMessage: 'Ningúna resolucion coincide con su búsqueda.', name: 'country', placeholder: 'Selecciona la resolucion' })"
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
                                                    class="px-3 py-2 text-gray-900 cursor-default select-none">
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                    <div class="grid grid-cols-4 gap-3 my-2 text-sm">
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Fecha de Notificacion al Infractor:</strong></label>
                            <input type="date" class="rounded-md" wire:model="date_notification_driver">
                        </div>
                    </div>
                </fieldset>
                <!--------------------------------------------------------------------------->

                <!--------------------------------------------------------------------------->
                <div class="flex justify-end ml-auto">
                    <button wire:click.prevent="AssociateResolution"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Asociar 
                    </button>
                    
                    <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded"
                            wire:click="CloseModalAssociateAct"
                            type="button"
                            data-dismiss="modal">Cancelar
                    </button>
                </div>

        </div>
    </div>
</div>




