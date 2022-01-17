<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <fieldset class="border-2 border-gray-400 rounded-md p-3 mb-3">
                    <legend class="ml-5 px-3">Datos del Acta de Fiscalización</legend>
                    <div class="grid grid-cols-6 gap-3">
                        <div class="grid grid-col-2">
                            <label for="">Nro de Acta:</label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $act_number }}</h3>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-3">
                        <div class="grid grid-col-2">
                            <label for="">Apellidos y Nombres / Denominación o Razón Social:</label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $names_business_name }}</h3>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 py-2">
                        <div class="grid grid-col-2">
                            <label for="">Nro DNI / RUC:</label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $document_number }}</h3>
                        </div>
                        <div class="grid grid-col-2">
                            <label for="">Nro Licencia de Conducir:</label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $licence_number }}</h3>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 py-2">
                        <div class="grid grid-col-2">
                            <label for="">Fecha de Infracción:</label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ date('d/m/Y', strtotime($date_infraction)) }}</h3>
                        </div>
                        <div class="grid grid-col-2">
                            <label for="">Hora de Infracción:</label>
                            <h3 class="px-3 py-2 rounded-md bg-gray-100 border-double border-2">{{ $hour_infraction }}</h3>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-3 py-2">
                        <label for="">Descripción de Infracción:</label>
                        <textarea class="px-3 py-2 rounded-md bg-gray-100 border-double border-2" name="" id="" cols="30" rows="10" disabled>{{ $description }}</textarea>
                    </div>
                </fieldset>
                <fieldset class="border-2 border-gray-400 rounded-md p-2 mt-3 mb-3">
                    <legend class="ml-5 px-3 font-semibold">Detalles del medio probatorio:</legend>
                    <div class="grid grid-cols-4 my-2 gap-2">
                        
                        <div class="grid grid-cols-1">
                            <label for="" class="font-semibold">Archivo del medio probatorio:<br/></label>
                            <div id="upload-container" class="">
                                <button id="browseFile" class="btn btn-primary hover:bg-indigo-600 p-1 px-4 bg-indigo-500 border border-indigo-600 rounded-md text-white focus:outline-none">Seleccionar archivo</button>
                            </div>
                        </div>
                           
                        <div>
                            <div class="progress mt-5 ml-6" style="height: 25px">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                            </div>
                        </div>                   
                    </div>                    
                </fieldset>
                <div>
                    <div class=" flex justify-end mb-2">
                        <a class="underline text-blue-400 hover:text-blue-500 visited:text-blue-800" href="javascript:location.reload()">[ Actualizar tabla ]</a>
                    </div>
                    
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-200 text-xs">
                                <th class="border px-3">Tipo de Medio Probatorio</th>
                                <th class="border px-3">Archivo</th>
                                <th class="border px-3">Tamaño archivo</th>
                                <th class="border px-3">Fecha de registro</th>
                                <th class="border px-3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody >
                            @forelse ($evidencesFiles as $evidenceFile)
                                <tr class="hover:bg-gray-100 text-center">
                                    <td class="border px-3 text-xs py-2">{{ $evidenceFile->TypeEvidence->description }}</td>
                                    <td class="border px-3 text-xs">
                                        <a href="{{ Storage::url($evidenceFile->FileEvidence->url_path) }}" target="_blank">
                                            @if ($evidenceFile->evidence_id == 1)
                                                <span class="text-blue-600">
                                                    <i class="far fa-file-video fa-lg" aria-hidden="true"></i>
                                                </span>
                                            @elseif ($evidenceFile->evidence_id == 2)
                                                <span class="">
                                                    <i class="far fa-file-image fa-lg"></i>
                                                </span>
                                            @else
                                                <span>
                                                    <i class="far fa-file-archive fa-lg"></i>
                                                </span>
                                            @endif
                                        </a>                                        
                                    </td>
                                    <td class="border px-3 text-xs">{{ number_format($evidenceFile->FileEvidence->size/ 1048576, 2) . ' Mb' }}</td>
                                    <td class="border px-3 text-xs">{{ date('d/m/Y H:i:s', strtotime($evidenceFile->created_at)) }}</td>
                                    <td class="border px-3 text-xs">
                                        <div>
                                            <button wire:click="deleteEvidences({{ $evidenceFile->id }})" class="px-2 py-1 bg-red-200 text-red-500 hover:bg-red-500 hover:text-white rounded">Eliminar</button>
                                        </div>
                                    </td>                                  
                                </tr>
                            @empty
                                <tr class="hover:bg-gray-100 text-center">
                                    <td colspan="5" class="border px-3 text-sm">
                                        .: no existe medios probatorios asociados :.
                                    </td>
                                </tr>   
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="my-3">
                    <a type="button" href="{{ route('actasDeFiscalizacion.show') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">Ir al listado de Actas</a>
                </div>
            </div>
        </div>
    </div>
</div>


@push('styles')
    @once
    <style>
        .card-footer, .progress {
            display: none;
        }
    </style>
    @endonce
@endpush

@push('scripts')
    @once 
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js" ></script>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- Resumable JS -->
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

    <script type="text/javascript">

        let browseFile = $('#browseFile');
       
        var resumable = new Resumable({
            target: '{{ route('evidenceupload') }}',
            uploadMethod: 'POST',
            query:{ _token:'{{ csrf_token() }}', // CSRF token
                   inspection_id: "{{ json_encode($inspection_id) }}"
            },  
            fileType: ['jpg', 'jpeg', 'png', 'mp4'],
            headers: {
                'Accept' : 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        }); 

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function (file) { // trigger when file picked
            showProgress();
            resumable.upload() // to actually start uploading.
        });

        resumable.on('fileProgress', function (file) { // trigger when file progress update
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
           // response = JSON.parse(response)
            
        });

        resumable.on('fileError', function (file, response) { // trigger when there is any error
            alert('file uploading error.')
        });


        let progress = $('.progress');
        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    </script>
    @endonce
@endpush
