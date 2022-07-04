<div class="h-screen">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if ($errors->any() )
                        <div class="w-auto mx-auto mt-2 flex bg-red-100 rounded-lg p-4 text-sm text-red-700 mb-3">
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
                    <div class="flex flex-col mb-3 md:w-full">
                        <span class="text-gray-600 font-extrabold">Selecciona la sede:</span>
                        <select wire:model="selectValueCampus"
                            @if ( $isDisabledSelectCampus )
                                class="rounded-md border-2 border-gray-300 bg-gray-100" disabled
                            @else
                                class="rounded-md border-2 border-gray-300"
                            @endif
                        name="" id="">
                            <option value="" selected disabled>selecciona</option>
                            @foreach ($campus as $campu)
                                <option value="{{ $campu->id }}">{{ $campu->campus_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col mb-3 md:w-1/2">
                        <span class="text-gray-600 font-extrabold">Selecciona el tipo de Acta:</span>
                        <select wire:model="selectValueTypeAct"
                            @if ( $isDisabledSelectTypeAct )
                                class="rounded-md border-2 border-gray-300 bg-gray-100" disabled
                            @else
                                class="rounded-md border-2 border-gray-300"
                            @endif
                        name="" id="">
                            <option value="" selected disabled>selecciona</option>
                            <option value="1">Acta de Control</option>
                            <option value="2">Acta de Fiscalizacion</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-gray-600 font-extrabold">Número de Acta:</span>
                        <input wire:model='act_number'
                            @if ( $isDisabledActNumber )
                                class="rounded-md md:w-1/6 rounded-lg border-2 border-gray-300 bg-gray-100 text-gray-500" disabled
                            @else
                                class="rounded-md md:w-1/6 rounded-lg border-2 border-gray-300"
                            @endif
                        type="text" required>
                    </div>
                    <div class="mt-3">
                        @if ($showButtonSearch)
                            <x-jet-button 
                            class="px-3"
                            wire:loading.attr="disabled"
                            wire:target="search"
                            wire:click="search">Buscar</x-jet-button>
                        @endif
                        
                        @if ($showButtonNewSearch)
                            <x-jet-button 
                            class="px-3"
                            wire:loading.attr="disabled"
                            wire:target="newSearch"
                            wire:click="newSearch">Nueva Busqueda</x-jet-button>
                            <button wire:click.prevent="OpenModalAssociateAct"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:bg-blue-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                Asociar Resolución
                            </button>
                            <button wire:click.prevent="OpenModalAssociateAct"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:bg-blue-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                Modificar Asociación
                            </button>
                        @endif


                    </div>
                    @if ($showTable)
                        <div class="pt-3">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-200 text-xs">
                                        <th class="border px-3"></th>
                                        <th class="border px-3">Nro. Acta</th>
                                        <th class="border px-3">Dni</th>
                                        <th class="border px-3">Nro de Licencia</th>
                                        <th class="border px-3">Conductor</th>
                                        <th class="border px-3">Cod. Infracción</th>
                                        <th class="border px-3">Calificación</th>
                                        <th class="border w-24 text-center">Fecha</th>
                                        <th class="border px-3">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @if ($selectValueTypeAct == 1)
                                            @isset($controlActs)
                                                @forelse ($controlActs as $controlAct)
                                                <tr class="hover:bg-gray-100">
                                                    <td class="px-6 py-2 border px-3 text-xs text-center whitespace-no-wrap">
                                                        <input type="checkbox" wire:model="selectedActs.{{ $controlAct->id }}">
                                                    </td>
                                                    <td class="border px-3 text-xs">{{ $controlAct->numero_acta }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $controlAct->nro_dni_conductor }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $controlAct->nro_licencia }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $controlAct->apellidos_nombres_conductor }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $controlAct->infractions->code }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $controlAct->infractions->qualification }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $controlAct->fecha_infraccion }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $controlAct->estado_actual }}</p></td>
                                                </tr>
                                                @empty 
                                                <tr class="text-center">
                                                    <td colspan="9" class="py-3 bg-gray-100 border font-mono text-xs">.:No existe registro de Actas de Control:.</td>
                                                </tr>
                                                @endforelse
                                            @endisset
                                        @endif
                                    
                                        @if ($selectValueTypeAct == 2)
                                            @isset($inspectionActs)
                                                @forelse ($inspectionActs as $inspectionAct)
                                                <tr class="hover:bg-gray-100">
                                                    <td class="px-6 py-2 border px-3 text-xs text-center whitespace-no-wrap">
                                                        <input type="checkbox" wire:model="selectedActs.{{ $inspectionAct->id }}">
                                                    </td>
                                                    <td class="border px-3 text-xs">{{ $inspectionAct->act_number }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $inspectionAct->document_number }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $inspectionAct->licence_number }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $inspectionAct->names_business_name }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $inspectionAct->infraction->code }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $inspectionAct->infraction->qualification }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $inspectionAct->date_infraction }}</p></td>
                                                    <td class="border px-3 text-xs">{{ $inspectionAct->status }}</p></td>
                                                </tr>
                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="8" class="py-3 bg-gray-100 border font-mono text-xs">.:No existe registro de Actas de Fiscalización:.</td>
                                                    </tr>
                                                @endforelse
                                            @endisset
                                        @endif
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <!--------------------------------MODAL LISTA DE RESOLUCIONES----------------------------------->
                        @if ($isOpenModalAssociateAct)
                            @include('components.resolutions.associate-resolution')
                        @endif
                    <!-----------------------------------END MODAL------------------------------------------------->
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @once 
        <script>
            function select(config) {
                return {
                    data: config.data,
        
                    emptyOptionsMessage: config.emptyOptionsMessage ?? 'Ningún resultado coincide con su búsqueda.',
        
                    focusedOptionIndex: null,
        
                    name: config.name,
        
                    open: false,
        
                    options: {},
        
                    placeholder: config.placeholder ?? 'Seleccione una opción',
        
                    search: '',
        
                    value: config.value,
        
                    closeListbox: function () {
                        this.open = false
        
                        this.focusedOptionIndex = null
        
                        this.search = ''
                    },
        
                    focusNextOption: function () {
                        if (this.focusedOptionIndex === null) return this.focusedOptionIndex = Object.keys(this.options).length - 1
        
                        if (this.focusedOptionIndex + 1 >= Object.keys(this.options).length) return
        
                        this.focusedOptionIndex++
        
                        this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                            block: "center",
                        })
                    },
        
                    focusPreviousOption: function () {
                        if (this.focusedOptionIndex === null) return this.focusedOptionIndex = 0
        
                        if (this.focusedOptionIndex <= 0) return
        
                        this.focusedOptionIndex--
        
                        this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                            block: "center",
                        })
                    },
        
                    init: function () {
                        console.log(this.data);
                        this.options = this.data
        
                        if (!(this.value in this.options)) this.value = null
        
                        this.$watch('search', ((value) => {
                            if (!this.open || !value) return this.options = this.data
        
                            this.options = Object.keys(this.data)
                                .filter((key) => this.data[key].toLowerCase().includes(value.toLowerCase()))
                                .reduce((options, key) => {
                                    options[key] = this.data[key]
                                    return options
                                }, {})
                        }))
                    },
        
                    selectOption: function () {
                        if (!this.open) return this.toggleListboxVisibility()
        
                        this.value = Object.keys(this.options)[this.focusedOptionIndex]
                        @this.set('resolution_id', this.value)
                        this.closeListbox()
                    },
        
                    toggleListboxVisibility: function () {
                        if (this.open) return this.closeListbox()
        
                        this.focusedOptionIndex = Object.keys(this.options).indexOf(this.value)
        
                        if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0
        
                        this.open = true
        
                        this.$nextTick(() => {
                            this.$refs.search.focus()
        
                            this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                                block: "center"
                            })
                        })
                    },
                }
            }
        </script>
    @endonce
@endpush