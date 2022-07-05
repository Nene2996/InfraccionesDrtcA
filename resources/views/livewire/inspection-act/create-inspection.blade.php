<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="grid grid-cols-5">
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Nro de Acta de Fiscalización:</label>
                        <input type="text" wire:model="act_number" class="rounded-md">
                        @error('act_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-3">
                    <fieldset class="border-2 border-gray-400 rounded-md">
                        <legend class="ml-5 px-3 font-semibold">Selecciona</legend>
                    <ul>
                        <li class="py-3">
                            <label class="mx-5 font-semibold">
                                <input wire:model='select' type="radio" name="myRadios" value="1" class="mr-3 selected" >Apellidos y Nombres
                            </label>
                            <label class="font-semibold">
                                <input wire:model='select' type="radio" name="myRadios" value="2" class="mr-3">Razon social
                            </label>
                        </li>
                    </ul>
                    @if ($isOpenDivNamesDni)
                        <div class="py-4 ml-6">
                            <input wire:model='document_number' type="text" class="rounded-md md:w-1/4" placeholder="Escribe el nro de DNI" required>
                            <x-jet-button 
                                wire:loading.attr="disabled"
                                wire:target="getApiReniec"
                                wire:click="getApiReniec">CONSULTAR RENIEC</x-jet-button>
                            @error('document_number') <span class="text-red-500 text-sm italic ml-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="py-4 ml-6">
                            @if ($messageApi)
                                <span class="text-red-500 text-sm italic ml-2"> {{ $messageApi }}</span><br/>
                            @endif
                            <input wire:model='names_business_name' type="text" class="rounded-md md:w-1/2" placeholder="Escribe los apellidos y nombres" >
                            @error('names_business_name') <span class="text-red-500 text-sm italic ml-2">{{ $message }}</span> @enderror
                        </div>
                    @endif
                    @if ($isOpenDivBusinessNamesRuc) 
                        <div class="py-4 ml-6">
                            <input wire:model='_document_number' type="text" class="rounded-md md:w-1/4" placeholder="Escribe el nro de RUC">
                            <x-jet-button 
                                wire:loading.attr="disabled"
                                wire:target="getApiSunat"
                                wire:click="getApiSunat">CONSULTAR SUNAT</x-jet-button>
                            @error('_document_number') <span class="text-red-500 text-sm italic ml-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="py-4 mx-6">
                            @if ($messageApi)
                                <span class="text-red-500 text-sm italic ml-2"> {{ $messageApi }}</span><br/>
                            @endif
                            <input wire:model='_names_business_name' type="text" class="rounded-md md:w-full" placeholder="Escribe la Razón Social">
                            @error('_names_business_name') <span class="text-red-500 text-sm italic ml-2">{{ $message }}</span> @enderror
                        </div>
                    @endif
                    </fieldset>
                </div>
                <div class="grid grid-cols-1 my-2">
                    <label for="" class="font-semibold">Domicilio:</label>
                    <input type="text" wire:model="address" class="rounded-md">
                    @error('address') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-3 gap-3 mt-3">
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Nro de Licencia de Conducir:</label>
                        <input type="text" wire:model="licence_number" class="rounded-md">
                        @error('licence_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3 my-2">
                    <div class="grid grid-cols-1 ">
                        <label for="" class="font-semibold">Código de Infracción:</label>
                        <select name="" id="" wire:model="infraction_id" class="rounded-md" required>
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
                        <label for="" class="font-semibold">Uit:</label>
                        @if ($infraction_id)
                            <span>{{ $this->infraction->uit_penalty }}</span> 
                        @else
                            <span>-------</span>
                        @endif
                    </div><div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Monto:</label>
                        @if ($infraction_id)
                            <span>S/. {{ number_format($this->infraction->uit_percentage * 4600, 2) }}</span> 
                        @else 
                            <span>-------</span>
                        @endif
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Fecha:</label>
                        <input type="date" wire:model="date_infraction" class="rounded-md">
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Hora:</label>
                        <input type="time" wire:model="hour_infraction" class="rounded-md">
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-3 my-2">
                    <li class="flex flex-col">
                        @error('infraction_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        @error('qualification') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        @error('date_infraction') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        @error('hour_infraction') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </li>
                </div>
                <div class="grid grid-cols-1">
                    <label for="" class="font-semibold">Información Adicional</label>
                    <textarea name="" id="" cols="30" rows="2" wire:model="additional_Information" class="rounded-md"></textarea>
                </div>
                <div class="grid grid-cols-1 my-2">
                    <label for="" class="font-semibold">Lugar de la Infracción:</label>
                    <input type="text" wire:model="place" class="rounded-md">
                    @error('place') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Departamento:</label>
                        <select name="" id="" disabled class="rounded-md bg-gray-200 border-transparent">
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name_department }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Provincia:</label>
                        <select name="" id="" wire:model="province_id" class="rounded-md">
                            <option value="" selected disabled>Selecciona una provincia</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name_province }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Distrito:</label>
                        <select name="" id="" wire:model="district_id" class="rounded-md">
                            <option value="" selected disabled>Selecciona un distrito</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name_district }}</option>
                            @endforeach
                        </select>
                    </div>  
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="grid grid-cols-1">
                    </div>
                    <div class="grid grid-cols-1">
                        @error('province_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-1">
                        @error('district_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 my-2">
                    <label for="" class="font-semibold">Referencia:</label>
                    <input type="text" wire:model="reference" class="rounded-md">
                </div>
                <div class="grid grid-cols-1 my-2">
                    <label for="" class="font-semibold">Observaciones del Intervenido:</label>
                    <textarea name="" id="" cols="30" rows="2" wire:model="observation" class="rounded-md"></textarea>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Número de placa única nacional de Rodaje:</label>
                        <input type="text" wire:model="plate_number" class="rounded-md">
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Número de Tarjeta de Identificación vehicular:</label>
                        <input type="text" wire:model="identification_card_number" class="rounded-md">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="grid grid-cols-1">
                        @error('plate_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-1">
                        @error('identification_card_number') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-col-1">
                    <label for="description" class="font-semibold">Descripcion de la Infracción</label>
                    <textarea name="" id="" cols="10" rows="4" wire:model="description" class="rounded-md"></textarea>
                    @error('description') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-1 gap-3 mt-3">
                    <div class="grid grid-col-1" >
                        <label for="" class="font-semibold">Sede:</label>
                        @error('campus_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        <h3 class="px-3 py-2 rounded-md bg-gray-200">{{ auth()->user()->campus->campus_name }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div class="grid grid-col-1">
                        <label for="" class="font-semibold">Inspector de Transporte:</label>
                        @error('inspector_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    <select name="" id="" wire:model="inspector_id" class="rounded-md">
                        <option value="" selected disabled>Selecciona el inspector</option>
                        @foreach ($inspectors as $inspector)
                            <option value="{{ $inspector->id }} ">{{ $inspector->surnames_and_names }}</option>
                        @endforeach
                    </select>
                    </div>
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
                            Guardar datos
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
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.css" rel="stylesheet">
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
        <script src="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.js"></script>

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