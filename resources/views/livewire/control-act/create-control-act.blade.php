<div>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h3 class="my-10 text-red-500 bold text-3xl text-center">MODULO EN DESARROLLO.</h3>
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-4 gap-2">
                        <div class="grid grid-cols-1">
                            <label for="">Numero de Acta de Control:</label>
                            <input type="text" wire:model="" class="rounded-md">
                            @error('') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label for="">Datos del Transportista:</label>
                    </div>
                    <div class="grid grid-cols-4 gap-2">
                        <div class="grid grid-cols-1">
                            <select name="" id="" class="rounded-md">
                                <option value="">Ruc</option>
                                <option value="">Dni</option>
                            </select>
                        </div> 
                        <div class="grid grid-cols-1">
                            <input type="text" class="rounded-md">
                        </div>
                    </div>
                    <div class="grid grid-cols-4">
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
