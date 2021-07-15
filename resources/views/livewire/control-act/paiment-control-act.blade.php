<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                <div class="grid grid-cols-3 gap-3 mt-3">
                    <div class="grid grid-col-1" >
                        <label for="">Acta de Control:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $nro_acta  }}</h3>
                    </div>
                    <div class="grid grid-col-2" >
                        <label for="">Apellidos y Nombres:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $nombre_apellidos }}</h3>
                    </div>
                    <div class="grid grid-col-1" >
                        <label for="">Num. de Licencia:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $nro_licencia }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3 mt-3">
                    <div class="grid grid-col-1" >
                        <label for="">Fecha Infraccion:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ date('d-m-Y', strtotime($fecha_infraccion)) }}</h3>
                    </div>
                    <div class="grid grid-col-1" >
                        <label for="">Codigo Infraccion:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $codigo_infraccion }}</h3>
                    </div>
                    <div class="grid grid-col-1" >
                        <label for="">Monto Uit:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $monto_uit }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-3 mt-3">
                    <div class="grid grid-col-1" >
                        <label for="">Estado Actual:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $estado_actual }}</h3>
                    </div>
                </div>
                
                <div class="grid grid-cols-3 gap-3 mt-3">
                    <div class="h-auto grid grid-cols-1">
                        <label for="">Fecha de Pago:</label>
                        <input type="date" class="rounded-md" wire:model="fecha_pago">
                        @error('fecha_pago') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="h-auto grid grid-cols-1">
                        <label for="">Numero de comprobante Pago:</label>
                        <input type="text" class="rounded-md" wire:model="numero_comprobante">
                        @error('numero_comprobante') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="h-auto grid grid-cols-1">
                        <label for="">Monto Pagado:</label>
                        <input type="text" class="rounded-md" wire:model="monto_pagado">
                        @error('monto_pagado') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3 mt-3">
                    <div class="grid grid-cols-1">
                        <label for="">Personal de la Oficina de Caja:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{$cajero_nombres}}</h3>
                    </div>
                </div>
                <div class="my-3">
                    <x-jet-button class="mx-4"
                        wire:loading.attr="disabled"
                        wire:target="savePaiment"
                        wire:click="savePaiment">
                        Procesar Pago
                    </x-jet-button>
                    <a type="button" href="{{ route('actasDeCotrol.show') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Regresar</a>
                </div>
            </div>
        </div>
    </div>    
</div>