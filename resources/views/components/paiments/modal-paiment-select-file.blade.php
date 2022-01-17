<div class="@if (!$isOpenModalPaimentFile) hidden @endif flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-600 bg-opacity-75">
    <div class="bg-white rounded-lg w-9/12">
        <form wire:submit.prevent="saveFileImg" class="">
            <div class="flex flex-col p-4">
                <div class="flex items-center w-full border-b pb-4">
                    <div class="text-gray-900 font-medium text-lg font-semibold">Adjuntar Comprobante de Pago</div>
                    <svg wire:click="CloseModalPaimentFile"
                            class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                    </svg>
                </div>
                @if ($errors->any() )
                    <div class="w-auto mx-auto mt-2 flex bg-red-100 rounded-lg p-4 text-sm text-red-700 ">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    <div role="alert">
                                        <div>
                                            <span class="font-medium">{{ '* ' . $error }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <div 
                    class="mt-3"
                    wire:ignore
                    x-data
                    x-init="() => {
                        const post = FilePond.create($refs.input);
                        post.setOptions({
                            server: {
                                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                    @this.upload('file_img', file, load, error, progress)
                                },
                                revert: (filename, load) => {
                                    @this.removeUpload('file_img', filename, load)
                                },
                            },
                            acceptedFileTypes: ['image/*'],
                            labelFileTypeNotAllowed: 'Archivo de tipo no válido',
                            fileValidateTypeLabelExpectedTypes: 'Espera archivo de tipo: {lastType}',
                            maxFileSize: '3MB',
                            labelMaxFileSizeExceeded: 'El archivo es demasiado grande',
                            labelMaxFileSize: 'El tamaño máximo de archivo es {filesize}',
                            allowImagePreview: true,
                            imagePreviewMinHeight: 100,
                            imagePreviewMaxHeight: 500,
                            

                        }); 

                        }"
                    >
                    <label for="" class="font-semibold">Archivo digitalizado del comprobante de pago:</label>
                    <input 
                        accept="image/*" 
                        type="file" x-ref="input" 
                        wire:model="file_img" 
                        
                    />
                </div>
                <div class="ml-auto">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">Adjuntar
                    </button>
                    <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded"
                            wire:click="CloseModalPaimentFile"
                            type="button"
                            data-dismiss="modal">Cancelar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

