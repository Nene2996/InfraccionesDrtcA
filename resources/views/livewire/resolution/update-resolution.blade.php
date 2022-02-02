<div class="h-screen">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <form wire:submit.prevent="updateToServer" enctype="multipart/form-data">
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Titulo/Nombre de la Resolución:</strong></label>
                            <input type="text" class="rounded-md" wire:model="title">
                        </div>
                        @error('title') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <div class="grid grid-cols-1">
                            <label for=""><strong>Tipo de la Resolución:</strong></label>
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
                                <label for=""><strong>Fecha de Emision:</strong></label>
                                <input type="date" class="rounded-md" wire:model="date_resolution">
                            </div>
                        </div>
                        <div>
                            @error('date_resolution') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        </div>              
                        <div 
                        class="mt-3"
                        wire:ignore
                        x-data
                        x-init="() => {
                            const post = FilePond.create($refs.input);
                            post.setOptions({
                                server: {
                                    process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                        @this.upload('url_path', file, load, error, progress)
                                    },
                                    revert: (filename, load) => {
                                        @this.removeUpload('url_path', filename, load)
                                    },
                                },
                                acceptedFileTypes: ['application/pdf'],
                                labelFileTypeNotAllowed: 'Archivo de tipo no válido',
                                fileValidateTypeLabelExpectedTypes: 'Espera archivo de tipo: {lastType}',
                                maxFileSize: '3MB',
                                labelMaxFileSizeExceeded: 'El archivo es demasiado grande',
                                labelMaxFileSize: 'El tamaño máximo de archivo es {filesize}',
                            }); 
    
                        }"
                        >
                            <label for="" class="font-bold">Archivo digitalizado de la Resolución:</label>
                            <input 
                                accept="application/pdf" 
                                type="file" x-ref="input" 
                                wire:model="url_path" 
                            />
                        </div>
                        <div class="my-3">
                            <x-jet-button>
                                ACTUALIZAR
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
</div>
@push('styles')
    @once 
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <style>
            .filepond--panel-root {
                background-color: transparent;
                border: 2px solid #2c3340;
            }
        </style>       
    @endonce
@endpush

@push('scripts')
    @once 
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>

        <script>
            const labels_es = {
            labelIdle: "Arrastra y suelta el archivo o <span class = 'filepond--label-action'> Examinar <span>",
            labelInvalidField: "El campo contiene archivos inválidos" ,
            labelFileWaitingForSize: "Esperando tamaño",
            labelFileSizeNotAvailable: "Tamaño no disponible" ,
            labelFileLoading: "Cargando",
            labelFileLoadError: "Error durante la carga", 
            labelFileProcessing: "Cargando",
            labelFileProcessingComplete: "Carga completa", 
            labelFileProcessingAborted: "Carga cancelada",
            labelFileProcessingError: "Error durante la carga", 
            labelFileProcessingRevertError: "Error durante la reversión",
            labelFileRemoveError: "Error durante la eliminación", 
            labelTapToCancel: "Toca para cancelar",
            labelTapToRetry: "Tocar para volver a intentar", 
            labelTapToUndo: "Tocar para deshacer",
            labelButtonRemoveItem: "Eliminar", 
            labelButtonAbortItemLoad: "Abortar", 
            labelButtonRetryItemLoad: "Reintentar",
            labelButtonAbortItemProcessing: "Cancelar", 
            labelButtonUndoItemProcessing: "Deshacer",
            labelButtonRetryItemProcessing: "Reintentar", 
            labelButtonProcessItem: "Cargar",
            };
            FilePond.setOptions(labels_es);
            // Register the plugin
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            FilePond.registerPlugin(FilePondPluginFileValidateSize);
        </script>
    @endonce
@endpush