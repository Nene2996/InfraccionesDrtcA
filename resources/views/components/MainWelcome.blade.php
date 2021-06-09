<main>
    @auth

    @else
    <div class="">
        <div class="flex flex-col text-center bg-195% md:bg-175% pt-10 px-4">
            <div>
                <h1 class="text-4xl mb-10 font-bold max-w-4xl mx-auto leading-none">CONSULTAR INFRACCIONES AL REGLAMENTO NACIONAL DE TRANSPORTE: </h1>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <h3 class="text-gray-600 text-lg font-semibold">Tipo de busqueda:</h3>
                        <ul>
                            <li>
                                <label class="mr-10 text-gray-700">
                                    <input type="radio" name="value01" class="mr-2">Por Nro. Documento
                                </label>
                                <label class="mr-10">
                                    <input type="radio" name="value01" class="mr-2">Por Nro. Licencia
                                </label>
                                <label class="mr-10">
                                    <input type="radio" name="value01" class="mr-2">Por Nro. Acta
                                </label>
                            </li>
                        </ul>
                        @livewire('search')
                    </div>
                </div>
            </div>
        </div>

        <div>

        </div>
    </div>
    @endauth

</main>