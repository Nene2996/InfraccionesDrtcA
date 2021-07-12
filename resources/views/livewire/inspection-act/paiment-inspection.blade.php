<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">


                <div class="grid grid-cols-4 gap-3 mt-3">
                    <div class="grid grid-col-1" >
                        <label for="">Acta de Fiscalización:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $act_number }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3 my-2">
                    <div class="grid grid-cols-1">
                        <label for="">Nombres Apellidos / Razon Social:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $names_business_name }}</h3>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Dni/Ruc:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $document_number }}</h3>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Licencia de Conducir:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $licence_number }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3 my-2">
                    <div class="grid grid-cols-1">
                        <label for="">Codigo de Infraccion:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $code }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1">
                        <label for="">Uit:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $uit_penalty }}</h3>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Monto Uit:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $pecuniary_sanction }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3 my-2">
                    <div class="grid grid-cols-1">
                        <label for="">Sancion Administrativa:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $administrative_sanction }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1">
                        <label for="">Descuento 5 dias:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $discount_five_days }}</h3>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Descuento despues de la notificacion:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $discount_fifteen_days }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3 my-2">
                    <div class="grid grid-cols-1">
                        <label for="">Estado de Infraccion:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $status }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3 my-2">
                    <div class="grid grid-cols-1">
                        <label for="">Fecha de Pago:</label>
                        <input type="date" class="rounded-md" wire:model="date_payment">
                        @error('date_payment') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                     <div class="grid grid-cols-1">
                        <label for="">Selecciona el Comprobante Pago:</label>
                         <select name="" id="" class="rounded-md" wire:model="type_proof_id">
                            <option value="" disabled>Selecciona</option>
                              @foreach ($type_proofs as $type_proof)
                                    
                                    <option value="{{ $type_proof->id }}">{{ $type_proof->type }}</option>
                              @endforeach
                         </select>
                         @error('type_proof_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                     </div>
                     <div class="grid grid-cols-1">
                        <label for="">Numero de comprobante Pago:</label>
                        <input type="text" class="rounded-md" wire:model="proof_number">
                        @error('proof_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3 my-2">
                    <div class="grid grid-cols-1">
                        <label for="">Monto Pagado:</label>
                        <input type="text" class="rounded-md" wire:model="total_amount">
                        @error('total_amount') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <x-jet-button class="mx-4"
                        wire:loading.attr="disabled"
                        wire:target="savePaiment"
                        wire:click="savePaiment">
                        Procesar Pago
                    </x-jet-button>
                </div>
            </div>
        </div>
    </div>
</div>
