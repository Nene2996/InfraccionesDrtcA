
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="grid grid-cols-4 gap-2">
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Numero de Acta de Control:</label>
                        <input type="text" wire:model="controlAct.numero_acta" class="rounded-md">
                        
                    </div>
                </div>
                <div class="grid grid-cols-1">
                    @error('controlAct.numero_acta') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-1 mt-3">
                    <fieldset class="border-2 border-gray-400 rounded-md px-2 py-2">
                        <legend class="ml-5 px-3 font-semibold">Datos del Transportista</legend>
                        <div class="flex">
                            <div class="pr-2">
                                <select name="" id="" wire:model="select_dni_ruc" class="rounded-md">
                                    <option value="0">DNI</option>
                                    <option value="1">RUC</option>
                                </select>
                            </div>
                            <div class="">
                                <input type="text" wire:model="ruc_dni" class="rounded-md">
                                @error('ruc_dni') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 mt-2">
                            <label for="" class="font-semibold">{{ $label_razon_social_nombre }}</label>
                            <input type="text" wire:model="value_razon_social_nombre" class="rounded-md">
                            @error('value_razon_social_nombre') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        </div>
                    </fieldset>
                </div>
                <div class="grid grid-cols-2 gap-2 my-2">
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Número de Habilitación</label>
                        <input type="text" wire:model="nro_habilitacion" class="rounded-md">
                        @error('nro_habilitacion') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-2 my-2">
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Tipo de Servicio:</label>
                        <select name="" id="" wire:model="tipo_servicio" class="rounded-md">
                            <option value="" selected disabled>Selecciona</option>
                            <option value="MERCANCIAS">Mercancias</option>
                            <option value="PASAJEROS">Pasajeros</option>
                            <option value="NO ESPECIFICADO">No especificado</option>
                        </select>
                        @error('tipo_servicio') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-2 my-2">
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Placa de Rodaje:</label>
                        <input type="text" wire:model="controlAct.placa_vehiculo" class="rounded-md" placeholder="BAG-456">
                        @error('controlAct.placa_vehiculo') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-2 my-2">
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Lugar de Intervención:</label>
                        <input type="text" wire:model="controlAct.lugar_intervencion" class="rounded-md">
                        @error('controlAct.lugar_intervencion') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 my-2">
                    
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Origen:</label>
                        <input type="text" wire:model="controlAct.origen" class="rounded-md">
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Destino:</label>
                        <input type="text" wire:model="controlAct.destino" class="rounded-md">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="grid grid-cols-1">
                        @error('controlAct.origen') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-1">
                        @error('controlAct.destino') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-2 my-2">
                    <fieldset class="border-2 border-gray-400 rounded-md px-2 py-2">
                        <legend class="ml-5 px-3 font-semibold">Datos del Conductor</legend>
                        <div class="grid grid-cols-4 gap-2">
                            <div class="grid grid-cols-1">
                                <label for="" class="font-semibold">Nro DNI:</label>
                                <input type="text" wire:model="controlAct.nro_dni_conductor" class="rounded-md">
                            </div>
                        </div>
                        <div class="grid grid-cols-1">
                            @error('controlAct.dni_conductor') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-2 my-2">
                            <div class="grid grid-cols-1">
                                <label for="" class="font-semibold">Apellidos:</label>
                                <input type="text" wire:model="apellidos_conductor" class="rounded-md">
                            </div>
                            <div class="grid grid-cols-1">
                                <label for="" class="font-semibold">Nombres:</label>
                                <input type="text" wire:model="nombres_conductor" class="rounded-md">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid grid-cols-1">
                                @error('apellidos_conductor') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                            </div>
                            <div class="grid grid-cols-1">
                                @error('nombres_conductor') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div>
                            <span class="font-semibold">Dispone de Licencia de Conducir:</span>
                            <div class="flex px-5">
                                <label class="px-3">
                                    <input  wire:model='posee_licencia' type="radio" value="0" name="posee_licencia" class="mr-1 checked:bg-blue-600">SI
                                </label>
                                <label  class="px-3">
                                    <input  wire:model='posee_licencia' type="radio" value="1" name="posee_licencia" class="mr-1 checked:bg-blue-600">NO
                                </label>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid grid-cols-1">
                                <label for="" class="font-semibold">Nro Licencia:</label>
                                
                                <input 
                                    type="text" 
                                    wire:model="nro_licencia_conductor" 
                                    
                                    @if ( $isDisabled_input_select )
                                        class="rounded-md bg-gray-200 text-sm" disabled
                                    @else
                                        class="rounded-md text-sm"
                                    @endif

                                >
                            </div>
                            <div class="grid grid-cols-1">
                                <label for="" class="font-semibold">Clase y Cat.:</label>
                                <select name="" id="" wire:model="clase_cat_licencia"
                                        @if ( $isDisabled_input_select )
                                            class="rounded-md bg-gray-200" disabled
                                        @else
                                            class="rounded-md"
                                        @endif
                                >
                                    <option value="" selected disabled>Selecciona</option>
                                    <option value="A-I">A-I</option>
                                    <option value="A-II-A">A-II-A</option>
                                    <option value="A-II-B">A-II-B</option>
                                    <option value="A-III-A">A-III-A</option>
                                    <option value="A-III-B">A-III-B</option>
                                    <option value="A-III-C">A-III-C</option>
                                    <option value="A-IV">A-IV</option>
                                    <option value="INTERNACIONAL">INTERNACIONAL</option>
                                    <option value="NO ESPECIFICADO">NO ESPECIFICADO</option>
                                    <option value="NO CUENTA CON LICENCIA DE CONDUCIR">NO CUENTA CON LICENCIA</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid grid-cols-1">
                                @error('nro_licencia_conductor') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                            </div>
                            <div class="grid grid-cols-1">
                                @error('clase_cat_licencia') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="grid grid-cols-4 gap-2 my-2">
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Fecha:</label>
                        <input type="date" wire:model="controlAct.fecha_infraccion" class="rounded-md">
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Hora:</label>
                        <input type="time" wire:model="controlAct.hora_infraccion" class="rounded-md">
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-2">
                    <div class="grid grid-cols-1">
                        @error('controlAct.fecha_infraccion') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-1">
                        @error('controlAct.hora_infraccion') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-2">
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Tipo de Falta</label>
                        <select name="" id="" wire:model="infraction_type" class="rounded-md">
                            <option value="" selected disabled>Selecciona</option>
                            <option value="Infraccion">Infraccion</option>
                            <option value="Incumplimiento">Incumplimiento</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Código:</label>
                        <select name="" id="" wire:model="infraction_id" class="rounded-md">
                            @foreach ($infractions as $infraction)
                                <option value="{{ $infraction->id }}">{{ $infraction->code }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-2">
                    <div class="grid grid-cols-1">
                        @error('infraction_type') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-col-1 my-2">
                    <label for="" class="font-semibold">Descripcion de la Infracción:</label>
                    <textarea name="" id="" wire:model="controlAct.descripcion_infraccion" cols="30" rows="10" class="rounded-md"></textarea>
                    @error('controlAct.descripcion_infraccion') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-col-1">
                    <label for="" class="font-semibold">Manifestación de Usuario:</label>
                    <textarea name="" id="" wire:model="controlAct.manifestacion_usuario" cols="30" rows="10" class="rounded-md"></textarea>
                    @error('controlAct.manifestacion_usuario') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-1 gap-3 mt-3">
                    <div class="grid grid-col-1" >
                        <label for="" class="font-semibold">Sede:</label>
                        <h1 class="px-3 py-2 rounded-md bg-gray-200">{{ $campus }}</h1>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div class="grid grid-col-1">
                        <label for="" class="font-semibold">Inspector de Transporte:</label>
                        
                    <select name="" id="" wire:model="inspector_id" class="rounded-md">
                        <option value="" selected disabled>Selecciona</option>
                        @foreach ($inspectors as $inspector)
                            <option value="{{ $inspector->id }}">{{ $inspector->surnames_and_names }}</option>
                        @endforeach
                    </select>
                    @error('inspector_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                    </div>
                </div>
                <!----------------------------------------FILEPOND OBJECT--------------------------------------------------------->
            <div 
            class="mt-3"
            wire:ignore
            x-data
            x-init="() => {
                const post = FilePond.create($refs.input);
                post.setOptions({
                    server: {
                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
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
            <label for="" class="font-semibold">Archivo digitalizado del Acta:</label>
            <input 
                accept="application/pdf" 
                type="file" x-ref="input" 
                wire:model="file_pdf" 
                data-pdf-preview-height="700"  
                data-pdf-component-extra-params="toolbar=0&navpanes=0&scrollbar=0&view=fitH"
            />
        </div>
                <div class="flex items-center">
                    <div class="flex justify-center flex-1 mt-8">

                        <x-jet-button class="mx-4"
                            wire:loading.attr="disabled"
                            wire:target="save"
                            wire:click="save">
                            Actualizar datos
                        </x-jet-button>

                        <a href="{{ route('actasDeControl.show') }}" class="flex items-center p-4 px-7 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100 mx-4">
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