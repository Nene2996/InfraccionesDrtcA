<div class="py-12 content-center">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-2">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div>
                @if (session()->has('message'))
                    <div class="mx-16 mt-8 p-2">
                        <div x-data="{ show: true }" x-show="show"
                        class="flex justify-between items-center bg-green-200 relative text-green-700 py-3 px-3 rounded-lg border border-green-400">
                            <div>
                                <span class="font-semibold text-gray-800">Bien echo !!!</span>
                                {{ session('message') }}
                            </div>
                            <div>
                                <button type="button" @click="show = false" class=" text-green-700">
                                    <span class="text-2xl">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div>
                <div class="px-5 flex justify-end">
                    <div class=" mt-5 p-2">
                        <a href="" class="flex items-center p-4 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            <div>
                                <p class="text-sm font-medium ml-2"> 
                                Registrar Infraccion
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="p-4 border-b border-gray-200">
                    <table class="w-full border">
                        <thead class="">
                            <tr class="bg-gray-200 text-xs">
                                <th class=""> Desripcion</th>
                                <th scope="col" class="">Codigo</th>
                                <th scope="col" class="">Tipo</th>
                                <th scope="col" class="">Agente Infractor</th>
                                <th scope="col" class="">Multa UIT</th>
                                <th scope="col" class="">Sancion Pecuniaria</th>
                                <th scope="col" class="">Sancion Administrativa</th>
                                <th scope="col" class="">Descuento 5 dias</th>
                                <th scope="col" class="">Descuento 15 dias(Resolucion)</th>
                                @if (auth()->user()->role == 'Administrador')
                                    <th class="">OPCIONES</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="">
                            @forelse ($infractions as $infraction)
                                <tr class="border text-xs hover:bg-gray-100">
                                    <td class="px-6 py-4">
                                        <div class="">{{ $infraction->description }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="">{{ $infraction->code }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="">{{ $infraction->type }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="">{{ $infraction->infringement_agent }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="">{{ $infraction->uit_penalty }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="">S/.{{ number_format($infraction->uit_percentage * 4600, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="">{{ $infraction->administrative_sanction }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($infraction->discount_five_days > 0)
                                            <div class="">S/.{{ number_format((($infraction->uit_percentage * 4600) * $infraction->discount_five_days), 2) }}</div>
                                        @else 
                                            <div class="">S/.0.00</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($infraction->discount_fifteen_days > 0)
                                            <div class="">S/.{{ number_format((($infraction->uit_percentage * 4600) * $infraction->discount_fifteen_days), 2) }}</div>
                                        @else 
                                            <div class="">S/.0.00</div>
                                        @endif
                                    </td>
                                    @if (auth()->user()->role == 'Administrador')
                                    <td class="px-6 py-6 flex justify-center ">
                                        <a href="" class="text-indigo-700 hover:text-indigo-400">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </span>
                                        </a>
                                        <button
                                            wire:loading.attr="disabled"
                                            wire:target="delete"
                                            wire:click="showModal('')"
                                            class="text-red-700 hover:text-red-400">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </span>
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="12" class="py-3 italic">No hay registro de la tabla de infracciones.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($infractions->hasPages())
                <div class="pb-6 px-5 bg-white my-6">
                    {{ $infractions->links() }}
                </div> 
            @endif
        </div>
    </div>
</div>