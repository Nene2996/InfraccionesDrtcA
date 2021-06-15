<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                <div class="grid grid-cols-4">
                    <div class="grid grid-cols-1">
                        <label for="">Acta de Fiscalización:</label>
                        <input type="text" wire:model="nro_acta" class="rounded-md">
                        @error('nro_acta') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1">
                    <fieldset class="border-2 border-gray-400 rounded-md">
                        <legend class="ml-5 px-3">Selecciona</legend>
                    <ul>
                        <li class="py-3">
                            <label class="mx-5">
                                <input wire:model='select' type="radio" name="myRadios" value="nombre_apellidos" class="mr-3">Apellidos y Nombres
                            </label>
                            <label>
                                <input wire:model='select' type="radio" name="myRadios" value="razon_social" class="mr-3">Razon social
                            </label>
                        </li>
                    </ul>

                    @if($isOpendivNamesSurname)
                        <div class="py-4 ml-6">
                            <input wire:model='nombre_apellidos' type="text" class="rounded-md md:w-1/2" placeholder="Escribe los nombres y apellidos">
                        </div>
                    @endif

                    @if($isOpendivBusinessName)
                        <div class="py-4 ml-6">
                            <input wire:model='razon_social' type="text" class="rounded-md md:w-1/2"  placeholder="Escribe la razon social">
                        </div>
                    @endif

                    </fieldset>
                </div>

                <div class="grid grid-cols-1 my-2">
                    <label for="">Domicilio:</label>
                    <input type="text" wire:model="direccion_infractor" class="rounded-md">
                    @error('direccion_infractor') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <fieldset class="border-2 border-gray-400 rounded-md">
                        <legend class="ml-5 px-3">Selecciona</legend>
                    <ul>
                        <li class="py-3">
                            <label class="mx-5">
                                <input 
                                    wire:model='selectTipoDoc'  
                                     
                                    type="radio" 
                                    name="myRadios02" 
                                    value="dni" 
                                    class="mr-3">DNI
                            </label>
                            <label>
                                <input 
                                    wire:model='selectTipoDoc'  
                                    type="radio" 
                                    name="myRadios02" 
                                    value="ruc" 
                                    class="mr-3">RUC
                            </label>
                        </li>
                    </ul>

                    @if($isOpendivDni)
                        <div class="py-4 ml-6">
                            <input wire:model='dni' type="text" class="rounded-md md:w-1/2" placeholder="Escribe el nro de DNI">
                        </div>
                    @endif

                    @if($isOpendivRuc)
                        <div class="py-4 ml-6">
                            <input wire:model='ruc' type="text" class="rounded-md md:w-1/2"  placeholder="Escribe el nro de RUC">
                        </div>
                    @endif

                    </fieldset>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="grid grid-cols-1">
                        <label for="">Licencia de Conducir:</label>
                        <input type="text" wire:model="nro_licencia" class="rounded-md">
                        @error('nro_licencia') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3 my-2">
                    <div class="grid grid-cols-1 ">
                        <label for="">Código de Infracción:</label>
                        <select name="" id="" wire:model="codigo_infraccion" class="rounded-md" required>
                            <option value="" selected disabled>Selecciona...</option>
                            @foreach ($infractions as $infraction)
                                <option value="{{ $infraction->id }}">{{ $infraction->codigo }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Calificación:</label>
                        <input type="text" wire:model="calificacion" class="rounded-md">
                        
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Uit:</label>
                        @if ($codigo_infraccion)
                            <span>{{ $this->infraction->multa_uit }}</span> 
                        @endif
                    </div><div class="grid grid-cols-1">
                        <label for="">Monto:</label>
                        @if ($codigo_infraccion)
                            <span>S/. {{ $this->infraction->monto_multa }}</span> 
                        @endif
                        
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Fecha:</label>
                        <input type="date" wire:model="fecha_infraccion" class="rounded-md">
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Hora:</label>
                        <input type="time" wire:model="hora_infraccion" class="rounded-md">
                    </div>
                    
                    
                </div>
                <div class="grid grid-cols-1 gap-3 my-2">
                    <li class="flex flex-col">
                        @error('codigo_infraccion') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        @error('calificacion') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        @error('fecha_infraccion') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        @error('hora_infraccion') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </li>
                    
                </div>
                <div class="grid grid-cols-1">
                    <label for="">Información Adicional</label>
                    <input type="text" wire:model="informacion_adicional" class="rounded-md">
                </div>
                <div class="grid grid-cols-1 my-2">
                    <label for="">Lugar de la Infracción:</label>
                    <input type="text" wire:model="lugar_intervencion" class="rounded-md">
                    @error('lugar_intervencion') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="grid grid-cols-1">
                        <label for="">Departamento:</label>
                        <select name="" id="" disabled class="rounded-md bg-gray-300">
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
                        @error('province_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
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
                <div class="grid grid-cols-1 my-2">
                    <label for="">Referencia:</label>
                    <input type="text" wire:model="referencia" class="rounded-md">
                </div>
                <div class="grid grid-cols-1 my-2">
                    <label for="">Observaciones del Intervenido:</label>
                    <input type="text" wire:model="observaciones_verificacion" class="rounded-md">
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="grid grid-cols-1">
                        <label for="">Número de placa única nacional de Rodaje:</label>
                        <input type="text" wire:model="placa_vehiculo" class="rounded-md">
                    </div>
                    
                    <div class="grid grid-cols-1">
                        <label for="">Número de Tarjeta de Identificación vehicular:</label>
                        <input type="text" wire:model="nro_tarjeta_vehicular" class="rounded-md">
                    </div>
                    
                </div>
                <div class="grid grid-cols-3 gap-3">
                    @error('placa_vehiculo') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    @error('nro_tarjeta_vehicular') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-1 my-2">
                    <div>
                        <label for="">Descripcion del medio probatorio:</label>
                    </div>
                    <div class="flex">
                        <div class="ml-5">
                            <label for="">Filmico</label>
                            <input type="checkbox">
                        </div>
                        <div class="ml-5">
                            <label for="">Fotografico</label>
                            <input type="checkbox">
                        </div>
                        <div class="ml-5">
                            <label for="">Otros</label>
                            <input type="checkbox">
                        </div>
                    </div>
                </div>
                <div class="grid grid-col-1">
                    <label for="">Descripcion de la Infracción</label>
                    <textarea name="" id="" cols="30" rows="10" wire:model="descripcion" class="rounded-md"></textarea>
                    @error('descripcion') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div class="grid grid-col-1">
                        <label for="">Inspector de Transporte:</label>
                    <select name="" id="" wire:model="idinspectores" class="rounded-md">
                        <option value="" selected disabled>Selecciona el inspector</option>
                        @foreach ($inspectors as $inspector)
                            <option value="{{ $inspector->id }}">{{ $inspector->nombres }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="grid grid-col-1" >
                        <label for="">Sede:</label>
                        <select name="" id="" wire:model="sede_infraccion" class="rounded-md">
                            <option value="" selected disabled>Selecciona la sede</option>
                            <option value="CHACHAPOYAS">CHACHAPOYAS</option>
                            <option value="BAGUA">BAGUA</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    @error('idinspectores') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    @error('sede_infraccion') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="flex items-center">
                    <div class="flex justify-center flex-1 mt-8">

                        <x-jet-button class="mx-4"
                            wire:loading.attr="disabled"
                            wire:target="save"
                            wire:click="save">
                            Guardar datos
                        </x-jet-button>

                        <a href="{{ route('papeletas.show') }}" class="flex items-center p-4 px-7 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100 mx-4">
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

