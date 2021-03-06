<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="grid grid-cols-4">
                    <div class="grid grid-cols-1">
                        <label for="">Acta de Fiscalización:</label>
                        <input type="text" wire:model="inspection.act_number" class="rounded-md">
                        @error('inspection.act_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-3">
                    <label for="">Selecciona:</label>
                    <select name="" id="" wire:model="inspection.typeNames_id" class="rounded-md" required>
                        <option value="" selected disabled>........................</option>
                        @foreach ($names_business_names as $names_business_name)
                            <option value="{{ $names_business_name->id }}">{{ $names_business_name->type_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-3 my-2">
                    <div class="grid grid-cols-1">
                        <label for="">Nombres Apellidos / Razon Social:</label>
                        <input type="text" wire:model="inspection.names_business_name" class="rounded-md">
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Dni/Ruc:</label>
                        <input type="text" wire:model="inspection.document_number" class="rounded-md">
                    </div>
                </div>
                <div class="flex flex-col">
                    @error('inspection.names_business_name') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    @error('inspection.document_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-1 my-2">
                    <label for="">Domicilio:</label>
                    <input type="text" wire:model="inspection.address" class="rounded-md">
                    @error('inspection.address') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                    <div class="grid grid-cols-1">
                        <label for="">Licencia de Conducir:</label>
                        <input type="text" wire:model="inspection.licence_number" class="rounded-md">
                        @error('inspection.licence_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3 my-2">
                    <div class="grid grid-cols-1 ">
                        <label for="">Código de Infracción:</label>
                        <select name="" id="" wire:model="inspection.infraction_id" class="rounded-md" required>
                            <option value="" selected disabled>Selecciona...</option>
                            @foreach ($infractions as $infraction)
                                <option value="{{ $infraction->id }}">{{ $infraction->code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Calificación:</label>
                        
                        @if ($infraction_id)
                            <span>{{ $this->infraction->qualification }}</span> 
                        @else
                            <span>-------</span>
                        @endif
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Uit:</label>
                        @if($this->infraction->id)
                            <span>{{ $this->infraction->uit_penalty }}</span> 
                        @endif
                    </div><div class="grid grid-cols-1">
                        <label for="">Monto:</label>
                        @if ($this->infraction->id)
                            <span>S/. {{ $this->infraction->pecuniary_sanction }}</span> 
                        @endif
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Fecha:</label>
                        <input type="date" wire:model="inspection.date_infraction" class="rounded-md">
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Hora:</label>
                        <input type="time" wire:model="inspection.hour_infraction" class="rounded-md">
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-3 my-2">
                    <li class="flex flex-col">
                        @error('inspection.infraction_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        @error('inspection.qualification') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        @error('inspection.date_infraction') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        @error('inspection.hour_infraction') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </li>
                </div>
                <div class="grid grid-cols-1">
                    <label for="">Información Adicional</label>
                    <input type="text" wire:model="inspection.additional_Information" class="rounded-md">
                </div>
                <div class="grid grid-cols-1 my-2">
                    <label for="">Lugar de la Infracción:</label>
                    <input type="text" wire:model="inspection.place" class="rounded-md">
                    @error('inspection.place') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="grid grid-cols-1">
                        <label for="">Departamento:</label>
                        <select name="" id="" disabled class="rounded-md bg-gray-300 border-transparent">
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name_department }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Provincia:</label>
                        <select name="" id="" wire:model="province_id" class="rounded-md">
                            <option value="" selected disabled>Selecciona una provincia</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name_province }}</option>
                            @endforeach
                        </select>
                        @error('province_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Distrito:</label>
                        <select name="" id="" wire:model="inspection.district_id" class="rounded-md">
                            <option value="" selected disabled>Selecciona un distrito</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name_district }}</option>
                            @endforeach
                        </select>
                        @error('inspection.district_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>  
                </div>
                <div class="grid grid-cols-1 my-2">
                    <label for="">Referencia:</label>
                    <input type="text" wire:model="inspection.reference" class="rounded-md">
                </div>
                <div class="grid grid-cols-1 my-2">
                    <label for="">Observaciones del Intervenido:</label>
                    <input type="text" wire:model="inspection.observation" class="rounded-md">
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="grid grid-cols-1">
                        <label for="">Número de placa única nacional de Rodaje:</label>
                        <input type="text" wire:model="plate_number" class="rounded-md">
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="">Número de Tarjeta de Identificación vehicular:</label>
                        <input type="text" wire:model="identification_card_number" class="rounded-md">
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-3">
                    @error('plate_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    @error('identification_card_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-3 gap-3">
                    @error('inspection.evidence_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-col-1">
                    <label for="">Descripcion de la Infracción</label>
                    <textarea name="" id="" cols="30" rows="10" wire:model="inspection.description" class="rounded-md"></textarea>
                    @error('inspection.description') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-1 gap-3 mt-3">
                    <div class="grid grid-col-1" >
                        <label for="">Sede:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-300">{{ $campus_inspection }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div class="grid grid-col-1">
                        <label for="">Inspector de Transporte:</label>
                    <select name="" id="" wire:model="inspection.inspector_id" class="rounded-md">
                        <option value="" selected disabled>Selecciona el inspector</option>
                        @foreach ($inspectors as $inspector)
                            <option value="{{ $inspector->id }}">{{ $inspector->surnames_and_names }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="grid grid-col-1">
                        <label for="">Estado de la Infracción</label>
                        <span>{{ $this->inspection->status }}</span> 
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    @error('inspection.inspector_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    @error('inspection.campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
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
                                @this.upload('file_pdf', file, load, error, progress)
                            },
                            revert: (filename, load) => {
                                @this.removeUpload('file_pdf', filename, load)
                            },
                        },
                        acceptedFileTypes: ['application/pdf'],
                        labelFileTypeNotAllowed: 'Archivo de tipo no válido',
                        fileValidateTypeLabelExpectedTypes: 'Espera archivo de tipo: {lastType}',
                        maxFileSize: '1MB',
                        labelMaxFileSizeExceeded: 'El archivo es demasiado grande',
                        labelMaxFileSize: 'El tamaño máximo de archivo es {filesize}',
                        allowPdfPreview: true,
                        pdfPreviewHeight: 700,
                        pdfComponentExtraParams: 'toolbar=0&view=fit&page=1' 
                    }); 

                }"
                >
                    <label for="" class="font-semibold">Archivo digitalizado del Acta de Fiscalización:</label>
                    <input 
                        accept="application/pdf" 
                        type="file" x-ref="input" 
                        wire:model="file_pdf" 
                        data-pdf-preview-height="700"  
                        data-pdf-component-extra-params="toolbar=0&navpanes=0&scrollbar=0&view=fitH"
                    />
                </div>
                <div>
                    @error('file_pdf') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="flex items-center">
                    <div class="flex justify-center flex-1 mt-8">
                        <x-jet-button class="mx-4"
                            wire:loading.attr="disabled"
                            wire:target="save"
                            wire:click="save">
                            Actualizar datos
                        </x-jet-button>
                        <a href="{{ route('actasDeFiscalizacion.show') }}" class="flex items-center p-4 px-7 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100 mx-4">
                            <div>
                              <p class="text-xs font-medium ml-2">
                                CANCELAR
                              </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    @once 
        <link href="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
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
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
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
            FilePond.registerPlugin(FilePondPluginPdfPreview);
        </script>
    @endonce
@endpush