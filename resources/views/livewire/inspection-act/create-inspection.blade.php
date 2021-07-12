<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                <div class="grid grid-cols-4">
                    <div class="grid grid-cols-1">
                        <label for="">Acta de Fiscalización:</label>
                        <input type="text" wire:model="act_number" class="rounded-md">
                        @error('act_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-3">
                    <fieldset class="border-2 border-gray-400 rounded-md">
                        <legend class="ml-5 px-3">Selecciona</legend>
                    <ul>
                        <li class="py-3">
                            <label class="mx-5">
                                <input wire:model='select' type="radio" name="myRadios" value="1" class="mr-3 selected" >Apellidos y Nombres
                            </label>
                            <label>
                                <input wire:model='select' type="radio" name="myRadios" value="2" class="mr-3">Razon social
                            </label>
                        </li>
                    </ul>
                    @if ($isOpenDivNamesDni)
                        <div class="py-4 ml-6">
                            <input wire:model='document_number' type="text" class="rounded-md md:w-1/4" placeholder="Escribe el nro de DNI" required>
                            <x-jet-button 
                                wire:loading.attr="disabled"
                                wire:target="getApiReniec"
                                wire:click="getApiReniec">CONSULTAR RENIEC</x-jet-button>
                            
                            @error('document_number') <span class="text-red-500 text-sm italic ml-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="py-4 ml-6">
                            @if ($messageApi)
                                <span class="text-red-500 text-sm italic ml-2"> {{ $messageApi }}</span><br/>
                            @endif
                            <input wire:model='names_business_name' type="text" class="rounded-md md:w-1/2" placeholder="Escribe los nombres y apellidos" >
                            
                            @error('names_business_name') <span class="text-red-500 text-sm italic ml-2">{{ $message }}</span> @enderror
                        </div>
                    @endif
                    @if ($isOpenDivBusinessNamesRuc) 
                        <div class="py-4 ml-6">
                            <input wire:model='_document_number' type="text" class="rounded-md md:w-1/4" placeholder="Escribe el nro de RUC">
                            <x-jet-button 
                                wire:loading.attr="disabled"
                                wire:target="getApiSunat"
                                wire:click="getApiSunat">CONSULTAR SUNAT</x-jet-button>
                            @error('_document_number') <span class="text-red-500 text-sm italic ml-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="py-4 ml-6">
                            @if ($messageApi)
                                <span class="text-red-500 text-sm italic ml-2"> {{ $messageApi }}</span><br/>
                            @endif
                            <input wire:model='_names_business_name' type="text" class="rounded-md md:w-1/2" placeholder="Escribe la Razón Social">
                            @error('_names_business_name') <span class="text-red-500 text-sm italic ml-2">{{ $message }}</span> @enderror
                        </div>
                        
                    @endif
                    </fieldset>
                </div>

                <div class="grid grid-cols-1 my-2">
                    <label for="">Domicilio:</label>
                    <input type="text" wire:model="address" class="rounded-md">
                    @error('address') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                    <div class="grid grid-cols-1">
                        <label for="">Licencia de Conducir:</label>
                        <input type="text" wire:model="licence_number" class="rounded-md">
                        @error('licence_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3 my-2">
                    <div class="grid grid-cols-1 ">
                        <label for="">Código de Infracción:</label>
                        <select name="" id="" wire:model="infraction_id" class="rounded-md" required>
                            <option value="" selected disabled>Selecciona...</option>
                            @foreach ($infractions as $infraction)
                                <option value="{{ $infraction->id }}">{{ $infraction->code }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Calificación:</label>
                        <input type="text" wire:model="qualification" class="rounded-md">
                        
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Uit:</label>
                        @if ($infraction_id)
                            <span>{{ $this->infraction->uit_penalty }}</span> 
                        @endif
                    </div><div class="grid grid-cols-1">
                        <label for="">Monto:</label>
                        @if ($infraction_id)
                            <span>S/. {{ $this->infraction->pecuniary_sanction }}</span> 
                        @endif
                        
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Fecha:</label>
                        <input type="date" wire:model="date_infraction" class="rounded-md">
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Hora:</label>
                        <input type="time" wire:model="hour_infraction" class="rounded-md">
                    </div>
                    
                    
                </div>
                <div class="grid grid-cols-1 gap-3 my-2">
                    <li class="flex flex-col">
                        @error('infraction_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        @error('qualification') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        @error('date_infraction') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        @error('hour_infraction') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </li>
                    
                </div>
                <div class="grid grid-cols-1">
                    <label for="">Información Adicional</label>
                    <input type="text" wire:model="additional_Information" class="rounded-md">
                </div>
                <div class="grid grid-cols-1 my-2">
                    <label for="">Lugar de la Infracción:</label>
                    <input type="text" wire:model="place" class="rounded-md">
                    @error('place') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="grid grid-cols-1">
                        <label for="">Departamento:</label>
                        <select name="" id="" disabled class="rounded-md bg-gray-300 border-transparent">
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name_department }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Provincia:</label>
                        <select name="" id="" wire:model="province_id" class="rounded-md">
                            <option value="" selected disabled>Selecciona una provincia</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name_province }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="grid grid-cols-1">
                        <label for="">Distrito:</label>
                        <select name="" id="" wire:model="district_id" class="rounded-md">
                            <option value="" selected disabled>Selecciona un distrito</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name_district }}</option>
                            @endforeach
                        </select>
                        @error('district_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>  
                </div>
                <div>
                    @error('province_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-1 my-2">
                    <label for="">Referencia:</label>
                    <input type="text" wire:model="reference" class="rounded-md">
                </div>
                <div class="grid grid-cols-1 my-2">
                    <label for="">Observaciones del Intervenido:</label>
                    <input type="text" wire:model="observation" class="rounded-md">
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="grid grid-cols-1">
                        <label for="">Número de placa única nacional de Rodaje:</label>
                        <input type="text" wire:model="plate_number" class="rounded-md">
                    </div>
                    
                    <div class="grid grid-cols-1">
                        <label for="">Número de Tarjeta de Identificación vehicular:</label>
                        <input type="text" wire:model="identification_card_number" class="rounded-md">
                    </div>
                    
                </div>
                <div class="grid grid-cols-3 gap-3">
                    @error('plate_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    @error('identification_card_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-4 my-2">
                    <div>
                        <label for="">Descripcion del medio probatorio:<br/></label>
                        @error('evidence_id') <span class="text-red-500 text-sm italic">{{ $message }}</span><br/> @enderror
                        <select name="" id="" wire:model="evidence_id" class="rounded-md">
                            <option value="" selected disabled>Selecciona el medio</option>
                            @foreach ($evidences as $evidence)
                                <option value="{{ $evidence->id }}">{{ $evidence->description }}</option>
                            @endforeach
                        </select>
                    </div>    
                </div>
                <div class="grid grid-col-1">
                    <label for="">Descripcion de la Infracción</label>
                    <textarea name="" id="" cols="30" rows="10" wire:model="description" class="rounded-md"></textarea>
                    @error('description') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-1 gap-3 mt-3">
                    <div class="grid grid-col-1" >
                        <label for="">Sede:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ auth()->user()->campus->campus_name }}</h3>
                        
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div class="grid grid-col-1">
                        <label for="">Inspector de Transporte:</label>
                        @error('inspector_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    <select name="" id="" wire:model="inspector_id" class="rounded-md">
                        <option value="" selected disabled>Selecciona el inspector</option>
                        @foreach ($inspectors as $inspector)
                            
                            <option value="{{ $inspector->id }} ">{{ $inspector->surnames_and_names }}</option>
                            
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex justify-center flex-1 mt-8">

                        <x-jet-button class="mx-4"
                            wire:loading.attr="disabled"
                            wire:target="save"
                            wire:click="save">
                            Guardar datos
                        </x-jet-button>

                        <a href="{{ route('actasDeFiscalizacion.show') }}" class="flex items-center p-4 px-7 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100 mx-4">
                            <div>
                              <p class="text-xs font-medium ml-2">
                                CANCELAR
                              </p>
                            </div>
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


