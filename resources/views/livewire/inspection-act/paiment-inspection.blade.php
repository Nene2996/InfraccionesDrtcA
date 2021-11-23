<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                
                <div>
                    <div class="grid grid-cols-1">
                        <label for="">Nombres Apellidos / Razon Social:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $names_business_name }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-3 mt-3">
                    <div class="grid grid-col-1" >
                        <label for="">Acta de Fiscalización:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $act_number }}</h3>
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
                <div class="grid grid-cols-4 gap-3 my-2">
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
                <div>
                    <div class="grid grid-cols-1">
                        <label for="">Sancion Administrativa:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $administrative_sanction }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-3 my-2">
                    <div class="grid grid-cols-1">
                        <label for="">Fecha de la Infracción:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ date('d-m-Y', strtotime($date_infraction)) }}</h3>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Estado de Infraccion:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $status }}</h3>
                    </div>
                </div>
                <div>
                    <div class="my-3">
                        <span>Aplica descuento de resolución</span>
                        <div class="flex px-5">
                            <label class="px-3"><input wire:model="select" type="radio" value="0" name="_descuentoResolucion" class="mr-1 checked:bg-blue-600">No</label>
                            <label  class="px-3"><input wire:model="select" type="radio" value="1" name="_descuentoResolucion" class="mr-1 checked:bg-blue-600">Si</label>
                        </div>
                    </div>
                    @if ($isOpenDivResolution)
                        <div class="my-3">
                            <label for="">Resolución:</label>
                            <div class="flex">
                                <input type="text" 
                                class="w-3/6"
                                value="RESOLUCION DIRECTORIAL REGIONAL SECTORIAL" readonly>

                                <input 
                                class="w-1/6 mx-1" type="text">

                                <input type="text" 
                                class="w-2/6" 
                                value="GOBIERNO REGIONAL AMAZONAS-DRTC" readonly>
                            </div>
                        </div>
                        <div >
                            <input class="w-full p-1 rounded-md border border-gray-700" type="file">
                        </div>
                    @endif
                    
                </div>
                <div class="grid grid-cols-3 gap-3 my-2">
                    <div class="h-auto grid grid-cols-1">
                        <label for="">Fecha de Pago:</label>
                        <input type="date" class="rounded-md" wire:model="date_payment">
                        @error('date_payment') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                     <div class="h-auto grid grid-cols-1">
                        <label for="">Selecciona el Comprobante Pago:</label>
                         <select name="" id="" class="rounded-md" wire:model="type_proof_id">
                            <option value="" disabled>Selecciona</option>
                              @foreach ($type_proofs as $type_proof)
                                    <option value="{{ $type_proof->id }}">{{ $type_proof->type }}</option>
                              @endforeach
                         </select>
                         @error('type_proof_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                     </div>
                     <div class="h-auto grid grid-cols-1">
                        <label for="">Numero de comprobante Pago:</label>
                        <input type="text" class="rounded-md" wire:model="proof_number">
                        @error('proof_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <h1> Dias calendarios transcurridos: <strong>{{ $calendarDays }} dias.</strong></h1>
                    <h1> Dias hábiles transcurridos: <strong>{{ $businessDays }} dias.</strong></h1>
                    <h1> Descuento dentro de los 5 días hábiles: <strong>S/. {{ $discount_five_days }}</strong></h1>
                </div>
                <div class="grid grid-cols-3 gap-3 my-2">

                    <div class="grid grid-cols-1">
                        <label for="">Monto a Pagar:</label>
                        <input type="text" class="rounded-md" value="S/. {{ $total_amount_pay }}" readonly>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Monto Pagado:</label>
                        <input type="text" class="rounded-md" wire:model="total_amount">
                        @error('total_amount') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Pendiente por pagar:</label>
                        <input type="text" class="rounded-md" wire:model="pending_payment" readonly>
                    </div>
                    
                </div>
                <div>
                    <div class="my-5 grid grid-cols-1">
                        <label for="">Personal que realiza en pago:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $cashier }}</h3>
                    </div>
                </div>
                <div>
                    <x-jet-button class="mx-4"
                        wire:loading.attr="disabled"
                        wire:target="savePaiment"
                        wire:click="savePaiment">
                        Procesar Pago
                    </x-jet-button>
                    <a type="button" href="{{ route('actasDeFiscalizacion.show') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>
