<div class="flex relative mt-4">
    <x-jet-input wire:model="search" type="text" class="" placeholder="Escribe el dato a buscar"/>
    <button class="p-3 ml-3 h-full bg-gray-500 flex items-center justify-center rounded-md text-white">BUSCAR
    </button>
    <div>
        @forelse ($ballots as $ballot)
                    <div>
                        <p>{{ $ballot->nombre_conductor }}</p>
                    </div>
        @empty

        @endforelse
    </div>
</div>
