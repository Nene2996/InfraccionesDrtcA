<div class="h-auto">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <form wire:submit.prevent="uploadToServer">
                        <div class="grid grid-cols-1">
                            <label for="" class="font-bold">Sede:</label>
                            <select name="" id="" class="rounded-md" wire:model="campus_id">
                                <option value="" selected disabled>Selecciona...</option>
                                @foreach ($campus as $camp)
                                    <option value="{{ $camp->id }}">{{ $camp->campus_name }}</option>
                                @endforeach
                            </select>
                            @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="grid grid-cols-1"> 
                            <label for="" class="font-bold">Titulo/Nombre de la Resolución:</label>
                            <input type="text" class="rounded-md" wire:model="title">
                        </div>
                        @error('title') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <div class="grid grid-cols-3 gap-3">
                            <div class="grid grid-cols-1">
                                <label for="" class="font-bold">Tipo de la Resolución:</label>
                                <select name="" id="" class="rounded-md" wire:model="type_resolution">
                                    <option value="" selected disabled>Selecciona...</option>
                                    <option value="RESOLUCIÓN DE SANCION">Resolución de sancion</option>
                                    <option value="RESOLUCIÓN DE NULIDAD">Resolución de nulidad</option>
                                    <option value="RESOLUCIÓN DE PRESCRIPCION">Resolución de prescripcion</option>
                                </select>
                            </div>
                            <div class="grid grid-cols-1">
                                <label for="" class="font-bold">Fecha de Emision:</label>
                                <input type="date" class="rounded-md" wire:model="date_resolution">
                            </div>
                        </div>
                        @error('type_resolution') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
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
                        <div>
                            @error('url_path')
                            <span class="text-red-500 text-sm italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid grid-cols-1">
                            @if ($campus_id == 1)
                                <label for="" class="font-bold">Titulo/Nombre del informe de Sanción:</label>
                            @endif
                            @if ($campus_id == 2 && $type_resolution == 'RESOLUCIÓN DE SANCION')
                                <label for="" class="font-bold">Titulo/Nombre del Informe de Técnico:</label>
                            @endif
                            @if ($campus_id == 2 && $type_resolution == 'RESOLUCIÓN DE NULIDAD')
                                <label for="" class="font-bold">Titulo/Nombre del Informe Final de Etapa Instructiva:</label>
                            @endif
                            @if ($campus_id == 2 && $type_resolution == 'RESOLUCIÓN DE PRESCRIPCION')
                                <label for="" class="font-bold">Titulo/Nombre del Informe de Técnico:</label>
                            @endif
                            <input type="text" class="rounded-md" wire:model="document_title">
                        </div>
                        <div>
                            @error('document_title')
                            <span class="text-red-500 text-sm italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <div class="grid grid-cols-1">
                                <label for="" class="font-bold">Año de emision del Informe:</label>
                                <select name="" id="" class="rounded-md" wire:model="document_year">
                                    <option value="" selected disabled>Selecciona...</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2022">2023</option>
                                    <option value="2022">2024</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            @error('document_year')
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

