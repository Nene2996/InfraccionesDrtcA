<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="grid grid-cols-8 gap-3 mt-3">
                    <div class="grid grid-col-1 pb-2" >
                        <label for="" class="font-extrabold">Acta de Control:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $numero_acta  }}</h3>
                    </div>
                </div>
                <fieldset class="border-2 border-gray-400 rounded-md p-3 mb-3">
                    <legend class="ml-5 px-3 font-extrabold">Datos del transportista</legend>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="grid grid-col-1">
                            <label for="">Nro DNI / RUC:</label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $ruc_dni }}</h3>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-3">
                        <div class="grid grid-col-2">
                            <label for="">Apellidos y Nombres / Denominación o Razón Social:</label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $razon_social_nombre }}</h3>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="border-2 border-gray-400 rounded-md px-3 pb-3">
                    <legend class="ml-5 px-3 font-extrabold">Datos del conductor</legend>
                        <div class="grid grid-cols-4 gap-3 mt-3">
                            <div class="grid grid-col-1" >
                                <label for="">Num. Dni:</label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $nro_dni_conductor }}</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-3 mt-3">
                            <div class="grid grid-col-2" >
                                <label for="">Apellidos y Nombres:</label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $apellidos_nombres_conductor }}</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div class="grid grid-col-1" >
                                <label for="">Num. de Licencia:</label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $nro_licencia }}</h3>
                            </div>
                            <div class="grid grid-col-1" >
                                <label for="">Categoria de Licencia:</label>
                                <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $clase_categoria_licencia }}</h3>
                            </div>
                        </div>
                </fieldset>
                <div class="grid grid-cols-4 gap-3 mt-3">
                    <div class="grid grid-col-1 pb-2" >
                        <label for="" class="font-extrabold">Placa de vehículo:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $placa_vehiculo }}</h3>
                    </div>
                    <div class="grid grid-col-1 pb-2" >
                        <label for="" class="font-extrabold">Fecha Infracción:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ date('d/m/Y', strtotime($fecha_infraccion)) }}</h3>
                    </div>
                    <div class="grid grid-col-1 pb-2" >
                        <label for="" class="font-extrabold">Hora Infracción:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $hora_infraccion }}</h3>
                    </div>
                    <div class="grid grid-col-1 pb-2" >
                        <label for="" class="font-extrabold">Codigo Infracción:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $codigo_infraccion }}</h3>
                    </div>
                </div>
<!--
                <div class="grid grid-cols-1 gap-3">
                    <div class="grid grid-col-1 pb-2" >
                        <label for="">Lugar de Intervención:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $lugar_intervencion }}</h3>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="grid grid-col-1 pb-2" >
                        <label for="">Origen:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $origen }}</h3>
                    </div>
                    <div class="grid grid-col-1 pb-2" >
                        <label for="">Destino:</label>
                        <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $destino }}</h3>
                    </div>
                </div>
-->
                @if ($controlAct->hasPaiment($controlAct->id))
                    @if ($monto_total_pagar > 0)
                    <button wire:click.prevent="OpenModalPaimentControlAct"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">
                        Adicionar pago
                    </button>
                    @endif
                @else 
                    @if ($monto_pago_infraccion > 0)
                    <button wire:click.prevent="OpenModalPaimentControlAct"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">
                        Realizar pago
                    </button>
                    @else
                        <div>
                            <span class="bg-red-300">Los incumplimientos no admiten realizar pagos</span>
                        </div>
                    @endif
                @endif

                

                <fieldset class="border-2 border-gray-400 rounded-md px-3 pb-3">
                    <legend class="ml-5 px-3 font-extrabold">Detalles de pago</legend>
                    <div>
                        @if ($isOpenModalPaimentControlAct)
                            @include('components.paiments.modal-paiment-control-act')
                        @endif
                        @if ($isOpenModalPaimentFile)
                            @include('components.paiments.modal-paiment-select-file')
                        @endif
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-200 text-xs">
                                    <th class="border px-3">Fecha Pago</th>
                                    <th class="border px-3">Tipo Comprobante</th>
                                    <th class="border px-3">Nro Comprobante</th>
                                    <th class="border px-3">Archivo digitalizado</th>
                                    <th class="border px-3">Monto infracción</th>
                                    <th class="border px-3">Descuento aplicado</th>
                                    <th class="border px-3">Monto pagado</th>
                                    <th class="border px-3">Pendiente por pagar</th>
                                    <th class="border px-3">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($paiments as $paiment)
                                    <tr class="hover:bg-gray-100 text-center">
                                        <td class="border px-3 text-xs">{{ date('d/m/Y', strtotime($paiment->date_payment)) }}</td>
                                        <td class="border px-3 text-xs">{{ $paiment->typeProof->type }}</td>
                                        <td class="border px-3 text-xs">{{ $paiment->proof_number }}</td>
                                        <td class="border px-3 text-xs">
                                            @if (isset($paiment->url_path_image_vaucher))
                                                <div class="whitespace-nowrap text-blue-600">
                                                    <a href="{{ Storage::url($paiment->url_path_image_vaucher) }}" target="_blank">
                                                        <span class="">
                                                            <i class="far fa-file-image fa-lg"></i>
                                                        </span>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="text-xs">
                                                    <p>No adjuntado</p>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="border px-3 text-xs">{{ 'S/ ' . number_format($paiment->total_amount, 2) }}</td>
                                        <td class="border px-3 text-xs">{{ 'S/ ' . number_format($paiment->discount, 2) }}</td>
                                        <td class="border px-3 text-xs">{{ 'S/ ' . number_format($paiment->amount_paid, 2) }}</td>
                                        
                                        <td class="border px-3 text-xs">{{ 'S/ ' . number_format($paiment->pending_amount, 2) }}</td>
                                        <td class="border px-3 text-xs">
                                            <div class="flex my-2">
                                                <button wire:click="OpenModalPaimentFile({{ $paiment->id }})"
                                                type="button" class="bg-blue-200 hover:bg-blue-500 hover:text-white text-blue-500 text-center py-2  rounded mr-2">

                                                @if (isset($paiment->url_path_image_vaucher))
                                                    Modificar Comprobante
                                                @else
                                                    Adjuntar Comprobante
                                                @endif
                                 
                                                </button>  
                                                <button wire:click="DeletePaiment({{ $paiment->id }})" 
                                                    onclick="confirm('Desea eliminar el pago realizado?') || event.stopImmediatePropagation()"
                                                    type="button" class="bg-red-200 hover:bg-red-500 hover:text-white text-red-500 text-center py-2  rounded">
                                                    Eliminar Pago
                                                </button>
                                            </div>
                                        </td>                                  
                                    </tr>
                                @empty
                                    <tr class="hover:bg-gray-100 text-center">
                                        <td colspan="9" class="border px-3 text-sm">
                                            .: no existe pagos asociados :.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                </fieldset>
                <div class="my-3">
                    <a type="button" href="{{ route('actasDeControl.show') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Ir al listado de Actas</a>
                </div>
            </div>
        </div>
    </div>
</div>


@push('styles')
    @once
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" /> 
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>
        <link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet"/>
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
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        
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

            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginImageEdit);
            FilePond.registerPlugin(FilePondPluginImageExifOrientation);
            FilePond.registerPlugin(FilePondPluginImageCrop);
        </script>
    @endonce
@endpush

