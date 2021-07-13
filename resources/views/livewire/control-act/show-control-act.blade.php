<div>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex">
                    <div class="flex-col w-4/6 px-8 pt-8">
                        <div class="">
                            <h3 class="text-gray-600 font-semibold">Tipo de busqueda:</h3>
                            <ul class="flex">
                                <li>
                                    <label class="mr-10 text-gray-700">
                                        <input wire:model='radioValue' wire:click="resetInput()" type="radio" name="myRadios" class="mr-2 checked:bg-blue-600" value="0" checked>Por Apellidos y nombres
                                    </label>
                                    @error('radioValue')
                                        <div class="text-red-500">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="flex">
                            @if ($isOpendivLastName)
                                <div class="mt-5 flex-col w-2/6">
                                    <div>
                                        <input wire:model='radio_names_business_name' type="text" class="rounded-md w-full text-sm" placeholder="Ingresa el nombre y apellidos">
                                    </div>
                                    <div>
                                        @error('radio_names_business_name')
                                            <span class="text-red-500 text-sm italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="mt-20 ml-48 p-2">
                            <a href="{{ route('actasDeCotrol.create') }}" class="flex items-center p-4 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100">
                                <i class="fas fa-file-alt"></i>
                                <div>
                                  <p class="text-xs font-medium ml-2">
                                    Registrar Acta de Control
                                  </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="pb-6 px-5 bg-white mt-10 flex justify-center">
                    <table>
                        <thead>
                            <tr class="bg-gray-200 text-xs">
                                <th class="border px-3">Num. Acta</th>
                                <th class="border px-3">Apellidos y Nombres</th>
                                <th class="border px-3">Num. de Licencia</th>
                                <th class="border px-3">Fecha. Infracción</th>
                                <th class="border px-3">Infracción</th>
                                <th class="border px-3">Servicio</th>
                                <th class="border px-3">Estado Actual</th>
                                <th class="border px-3">Sede Infracción</th>
                                <th class="border px-3">Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($controlActs as $controlAct)
                                <tr class="hover:bg-gray-100">
                                    <td class="border px-3 text-xs">{{ $controlAct->nro_acta }}</p></td>
                                    <td class="border px-3 text-xs">{{ $controlAct->nombre_apellidos }}</p></td>
                                    <td class="border px-3 text-xs">{{ $controlAct->nro_licencia }}</p></td>
                                    <td class="border px-3 text-xs">{{ $controlAct->fecha_infraccion }}</p></td>
                                    <td class="border px-3 text-xs">{{ $controlAct->infractions->description }}</p></td>
                                    <td class="border px-3 text-xs">{{ $controlAct->servicio }}</p></td>
                                    <td class="border px-3 text-xs">{{ $controlAct->estado_actual }}</p></td>
                                    <td class="border px-3 text-xs">{{ $controlAct->sede_infraccion }}</p></td>
                                    
                                    <td class="border px-3 text-xs">
                                        @if (auth()->user()->role == 'Administrador')
                                            <div class="flex item-center space-x-1">
                                                <a type="button" class="border-2 border-green-600 rounded-lg px-2 py-1 text-green-600 cursor-pointer hover:bg-green-600 hover:text-green-200 focus:outline-none" href="{{ route('actasDeCotrol.paiment', $controlAct) }} ">Pagar</a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty

                            <tr class="text-center">
                                <td colspan="12" class="py-3 italic">No hay registro de Infracciones.</td>
                            </tr>
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pb-6 px-5 bg-white my-6">
                    {{ $controlActs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
