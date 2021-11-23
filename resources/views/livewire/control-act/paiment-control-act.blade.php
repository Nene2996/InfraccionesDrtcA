<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                <div class="grid grid-cols-3 gap-3 mt-3">
                    <div class="grid grid-col-1" >
                        <label for="">Acta de Control:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $nro_acta  }}</h3>
                    </div>
                    
                    <div class="grid grid-col-1" >
                        <label for="">Num. de Licencia:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $nro_licencia }}</h3>
                    </div>
                </div>
                <fieldset class="border-2 border-gray-400 rounded-md px-3 pb-3">
                    <legend class="ml-5 px-3">Datos del conductor</legend>
                        <div class="grid grid-cols-1 gap-3 mt-3">
                            <div class="grid grid-col-2" >
                                <label for="">Apellidos y Nombres:</label>
                                @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                                <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $nombre_apellidos_conductor }}</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-4 gap-3 mt-3">
                            <div class="grid grid-col-1" >
                                <label for="">Num. de Licencia:</label>
                                @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                                <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $nro_licencia }}</h3>
                            </div>
                            <div class="grid grid-col-1" >
                                <label for="">Num. Dni:</label>
                                @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                                <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $dni_conductor }}</h3>
                            </div>
                        </div>
                </fieldset>
                <div class="grid grid-cols-3 gap-3 mt-3">
                    <div class="grid grid-col-1" >
                        <label for="">Fecha Infracción:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ date('d-m-Y', strtotime($fecha_infraccion)) }}</h3>
                    </div>
                    <div class="grid grid-col-1" >
                        <label for="">Codigo Infracción:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $codigo_infraccion }}</h3>
                    </div>
                    <div class="grid grid-col-1" >
                        <label for="">Monto Uit:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $monto_uit }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3 mt-3">
                    <div class="grid grid-col-1" >
                        <label for="">Descuento 15 dias(Resolución de Sanción):</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $descuento_15_dias_resolucion }}</h3>
                    </div>
                </div>
                <div>
                    <div class="my-3">
                        <span>PResolución de Sanción</span>
                        <div class="flex px-5">
                            <label class="px-3"><input type="radio" value="0" name="_descuentoResolucion" class="mr-1 checked:bg-blue-600">No</label>
                            <label  class="px-3"><input type="radio" value="1" name="_descuentoResolucion" class="mr-1 checked:bg-blue-600">Si</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="my-3">
                        <span>Aplica descuento de resolución</span>
                        <div class="flex px-5">
                            <label class="px-3"><input type="radio" value="0" name="_descuentoResolucion" class="mr-1 checked:bg-blue-600">No</label>
                            <label  class="px-3"><input type="radio" value="1" name="_descuentoResolucion" class="mr-1 checked:bg-blue-600">Si</label>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-3 mt-3">
                    <div class="grid grid-col-1" >
                        <label for="">Estado Actual:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $estado_actual }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3 mt-3">
                    <div class="grid grid-cols-1">
                        <label for="">Fecha de Pago:</label>
                        <input type="date" class="rounded-md" wire:model="fecha_pago">
                        
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Tipo de comprobante Pago:</label>
                        <select name="" id="" class="rounded-md" wire:model="select_value">
                            <option value="" selected disabled>Selecciona</option>
                            <option value="0">BOLETA DE VENTA</option>
                            <option value="1">FACTURA</option>
                            <option value="2">BAUCHER BANCO NACION</option>
                            <option value="3">BAUCHER AGENTE</option>
                        </select>
                    </div>
                    <div class="h-auto grid grid-cols-1">
                        <label for="">Número de comprobante Pago:</label>
                        <input type="text" class="rounded-md" wire:model="numero_comprobante" placeholder="{{ $this->placeholder }}">
                    </div>
                </div>
                <div class="flex flex-col mt-2">
                    @error('fecha_pago') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    @error('numero_comprobante') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    
                </div>
                <div class="grid grid-cols-3 gap-3 mt-3">
                    
                    <div class="h-auto grid grid-cols-1">
                        <label for="">Monto Pagado:</label>
                        <input type="text" class="rounded-md" wire:model="monto_pagado">
                        @error('monto_pagado') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                
                <div class="grid grid-cols-3 gap-3 mt-3">
                    <div class="grid grid-cols-1">
                        <label for="">Administrado que realiza el pago:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ $cajero_nombres }}</h3>
                    </div>

                </div>
                
                
                <div class="my-3">
                    <x-jet-button class="mx-4"
                        wire:loading.attr="disabled"
                        wire:target="savePaiment"
                        wire:click="savePaiment">
                        Procesar Pago
                    </x-jet-button>
                    <a type="button" href="{{ route('actasDeControl.show') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Regresar</a>
                </div>
            </div>
        </div>
    </div>    
</div>