<table class="table table-auto w-full">
    <thead>
    <tr>
        <th class="text-left">Medio probatorio</th>
        <th class="text-left">Archivo del medio probatorio</th>
        <th class="text-left" width="100"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($evidencesFiles as $index => $evidencesFile)
        <tr>
            <td class="p-1" valign="top">
                <select id="evidence_id.{{$index}}" wire:model="evidence_id.{{$index}}" class="focus:outline-none w-full border rounded-md p-1">
                    <option value="">-- Selecciona --</option>
                    @foreach ($evidences as $evidence)
                        <option value="{{ $evidence->id }}">{{ $evidence->description }}</option>
                    @endforeach
                </select>
            </td>
            <td class="p-1" valign="top">
                <input  type="file" wire:model="file_evidence" class="w-full rounded-md border-2 border-gray-600 py-2 px-2 text-sm">
                <div class="progress mt-3" style="height: 25px">
                    <div class="progress-bar w-full bg-gray-200 rounded-full">
                        <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-l-full" style="width: 25%"> 25%</div>
                    </div>
                </div>
            </td>
            <td class="p-1" valign="top">
                <div class="flex"> 
                    @if ($file_evidence)
                        <button id="" wire:click.prevent="" class="hover:bg-blue-600 ml-1 p-1 px-2 bg-blue-500 border border-blue-600 rounded-md text-white focus:outline-none px-3">Subir</button>
                        <div id="upload-container" class="text-center">
                            <button id="browseFile" class="btn btn-primary">Brows File</button>
                        </div>
                    @endif
                    

                    <button wire:click.prevent="removeEvidence({{ $index }})" class="hover:bg-red-600 ml-1 p-1 px-2 bg-red-500 border border-red-600 rounded-md text-white focus:outline-none px-3">Eliminar</button>
                </div>
                
            </td>
        </tr>
        <tr>
            <td>
                @error('evidence_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
            </td>
            <td>
                @error('file_evidence') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
            </td>
            <td>
                
            </td>
        </tr>
    @endforeach
        
    </tbody>
</table>


<div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h5>Upload File</h5>
                </div>

                <div class="card-body">
                    <div id="upload-container" class="text-center">
                        <button id="browseFile" class="btn btn-primary">Brows File</button>
                    </div>
                    <div class="progress mt-3" style="height: 25px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                    </div>
                </div>

                <div class="card-footer p-4" >
                    <video id="videoPreview" src="" controls style="width: 100%; height: auto"></video>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-footer, .progress {
        display: none;
    }
</style>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <!-- Resumable JS -->
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

    <script type="text/javascript">
    
        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            
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
            response = JSON.parse(response)
            $('#videoPreview').attr('src', response.path);
            $('.card-footer').show();
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
