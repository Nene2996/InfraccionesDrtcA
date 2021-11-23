<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <form wire:submit.prevent="uploadToServer">
                    <div class="grid grid-cols-1">
                        <label for="" >Titulo/Nombre de la Resolución:</label>
                        <input type="text" class="rounded-md" wire:model="title">
                    </div>
                    @error('title') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    <div class="grid grid-cols-1">
                        <label for="">Tipo de la Resolución:</label>
                        <select name="" id="" class="rounded-md" wire:model="type_resolution">
                            <option value="" selected disabled>Selecciona...</option>
                            <option value="RESOLUCIÓN DE SANCION">Resolución de sancion</option>
                            <option value="RESOLUCIÓN DE NULIDAD">Resolución de nulidad</option>
                            <option value="RESOLUCIÓN DE PRESCRIPCION">Resolución de prescripcion</option>
                        </select>
                    </div>
                    @error('type_resolution') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    
                    <div class="grid grid-cols-4 gap-3 my-2">
                        <div class="grid grid-cols-1">
                            <label for="">Fecha de Emision:</label>
                            <input type="date" class="rounded-md" wire:model="date_resolution">
                        </div>
                        
                    </div>
                    <div>
                        @error('date_resolution') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>                        
                    <div >
                        <input class="w-full p-1 rounded-md border border-gray-700" type="file" wire:model="url_path" id="upload{{ $iteration }}">
                    </div>
                    <div>
                        @error('url_path')
                        <span class="text-red-500 text-sm italic">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <div class="my-3">
                        <x-jet-button>
                            SUBIR RESOLUCION
                        </x-jet-button>
                        <a type="button" href="{{ route('MostrarResoluciones') }}" 
                        class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                        REGRESAR</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
