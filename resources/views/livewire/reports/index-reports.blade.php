<div class="h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-10">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <!--
                @if ($errors->any() )
                    <div class="w-auto mx-auto mt-2 flex bg-red-100 rounded-lg p-4 text-sm text-red-700 mb-3">
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
                -->
                <div class="flex flex-col mb-3 md:w-full">
                    <span class="text-gray-600 font-extrabold">Selecciona la sede:</span>
                    <select wire:model="selectCampus"
                            class="rounded-md border-2 border-gray-300
                            @error('selectCampus')
                                border-1 border-red-500
                            @enderror">
                        <option value="" selected disabled>selecciona</option>
                        @foreach ($allCampus as $campus)
                            <option value="{{ $campus->id }}">{{ $campus->campus_name }}</option>
                        @endforeach
                    </select>
                    @error('selectCampus') 
                        <span class="font-sans text-red-500 text-sm pt-1">
                            <div class="flex items-center space-x-1">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="font-light">
                                    {{ $message }}
                                </div>
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="flex flex-col mb-3 md:w-1/2">
                    <span class="text-gray-600 font-extrabold">Selecciona el tipo de Acta:</span>
                    <select wire:model="selectTypeAct" 
                            class="rounded-md border-2 border-gray-300
                            @error('selectTypeAct')
                                border-1 border-red-500
                            @enderror">
                        <option value="" selected disabled>selecciona</option>
                        <option value="1">Acta de Control</option>
                        <option value="2">Acta de Fiscalizacion</option>
                    </select>
                    @error('selectTypeAct') 
                        <span class="font-sans text-red-500 text-sm pt-1">
                            <div class="flex items-center space-x-1">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="font-light">
                                    {{ $message }}
                                </div>
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="grid grid-cols-3 gap-2 my-2">
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Selecciona el Año:</label>
                        <select wire:model="selectYear" 
                                class="rounded-md border-2 border-gray-300
                                @error('selectYear')
                                    border-1 border-red-500
                                @enderror">
                            <option value="" selected disabled>Selecciona...</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Fecha de Inicio:</label>
                        <input type="date" wire:model="beginDate" 
                                class="rounded-md border-2
                                @error('beginDate')
                                    border-1 border-red-500
                                @enderror">
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="" class="font-semibold">Fecha de Fin:</label>
                        <input type="date" wire:model="endDate" 
                                class="rounded-md border-2
                                @error('endDate')
                                    border-1 border-red-500
                                @enderror">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-2 my-2">
                    <div class="grid grid-cols-1">
                        @error('selectYear') 
                        <span class="font-sans text-red-500 text-sm pt-1">
                            <div class="flex items-center space-x-1">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="font-light">
                                    {{ $message }}
                                </div>
                            </div>
                        </span>
                    @enderror
                    </div>
                    <div class="grid grid-cols-1">
                        @error('beginDate') 
                        <span class="font-sans text-red-500 text-sm pt-1">
                            <div class="flex items-center space-x-1">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="font-light">
                                    {{ $message }}
                                </div>
                            </div>
                        </span>
                    @enderror
                    </div>
                    <div class="grid grid-cols-1">
                        @error('endDate') 
                        <span class="font-sans text-red-500 text-sm pt-1">
                            <div class="flex items-center space-x-1">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="font-light">
                                    {{ $message }}
                                </div>
                            </div>
                        </span>
                    @enderror
                    </div>
                </div>
                <div>
                    <button 
                            wire:loading.attr="disabled"
                            wire:target="reportExcel"
                            wire:click.prevent="reportExcel"
                            target="_blank"
                            class="inline-flex items-center px-2 py-2 bg-blue-500 border border-transparent rounded-md text-xs text-white font-bold uppercase text-white tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:bg-blue-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span class="mx-1">Generar Reporte Excel</span>
                    </button>
                    <button 
                            wire:loading.attr="disabled"
                            wire:target="reportExcel"
                            wire:click.prevent="reportExcel"
                            target="_blank"
                            class="inline-flex items-center px-2 py-2 bg-blue-500 border border-transparent rounded-md text-xs text-white font-bold uppercase text-white tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:bg-blue-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span class="mx-1">Generar Reporte PDF</span>
                    </button>
                    <button type="button" class="btn btn-success" onclick="openWindow()">show the receipt</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openWindow() {
         
        /*var page = 'https://www.codegrepper.com/code-examples/php/open+new+window+in+laravel';
        var myWindow = window.open(page, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,//left=500,width=600,height=400");
        */

        var myWindow = window.open("", "MsgWindow", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=600,height=400");
        myWindow.document.write("<p>Buenas noches, mujercita Dracula ya estas en tu camita. :)</p> ");
         
        myWindow.focus();  
    }
</script>
