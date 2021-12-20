<div class="@if (!$isOpenDivEvidenceModal) hidden @endif flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-600 bg-opacity-75">
    <div class="bg-white rounded-lg w-9/12">
        <form wire:submit.prevent="" class="">
            <div class="flex flex-col p-4 ">
                <div class="flex items-center w-full border-b pb-4">
                    <div class="text-gray-900 font-medium text-lg font-semibold">Asociar medio probatorio</div>
                    <svg wire:click="closeDivEvidenceModal"
                            class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                    </svg>
                </div>
                
                <fieldset class="border-2 border-gray-400 rounded-md p-2 mt-3 mb-3">
                    <legend class="ml-5 px-3 font-semibold">Detalles del medio probatorio:</legend>
                    <div class="grid grid-cols-4 my-2 gap-2">
                        <div class="grid grid-cols-1">
                            <label for="" class="font-semibold">Medio probatorio:<br/></label>
                            <select name="" id="selectId" wire:model="evidence_id" class="rounded-md">
                                <option value="" selected disabled>Selecciona el medio</option>
                                @foreach ($evidences as $evidence)
                                    <option value="{{ $evidence->id }}">{{ $evidence->description }}</option>
                                @endforeach
                            </select>
                            <div class="grid grid-cols-1">
                                @error('evidence_id') <span class="text-red-500 text-sm italic">{{ $message }}</span><br/> @enderror
                            </div> 
                        </div> 
                        <div class="col-span-2">
                            <div class="grid grid-cols-1">
                                <label for="" class="font-semibold">Archivo del medio probatorio:<br/></label>
                                <input type="file" wire:model="identification_card_number" class="rounded-md border-2 border-gray-600 py-2 px-2 text-sm">
                            </div>
                        </div>   
                        <div>
                            <div id="upload-container" class="">
                                <button id="" class="hover:bg-indigo-600 p-1 px-4 bg-indigo-500 border border-indigo-600 rounded-md text-white focus:outline-none">Seleccionar archivo</button>
                            </div>
                            <div class="progress mt-3" style="height: 25px">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                            </div>
                        </div>                   
                    </div>                    
                </fieldset>

                <div class="ml-auto">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">Guardar
                    </button>
                    <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded"
                            wire:click="closeDivEvidenceModal"
                            type="button"
                            data-dismiss="modal">Cancelar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



