<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-end">
                    <div class="mr-4 mt-3 p-2 md:w-40">
                        <a href="{{ route('papeletas.create') }}" class="flex items-center p-4 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100">
                            <i class="fas fa-file-alt"></i>
                            <div>
                              <p class="text-xs font-medium ml-2">
                                Registrar Acta de Fiscalizacion
                              </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <table>
                        <thead>
                            <tr class="bg-gray-200 text-sm">
                                <th class="border px-3">NRO. ACTA</th>
                                <th class="border px-3">NOMBRE Y APELLIDOS</th>
                                <th class="border px-3">DNI</th>
                                <th class="border px-3">RAZON SOCIAL</th>
                                <th class="border px-3">RUC</th>
                                <th class="border px-3">NRO DE LICENCIA</th>
                                <th class="border px-3">ESTADO PAPELETA</th>
                                <th class="border px-3">FECHA PAPELETA</th>
                                <th class="border px-3">NRO. BOLETA/VAUCHER</th>
                                <th class="border px-3">SEDE</th>
                                <th class="border px-3">OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ballots as $ballot)
                            <tr>
                                <td class="border px-3 text-xs">{{ $ballot->nro_acta }}</p></td>
                                <td class="border px-3 text-xs">{{ $ballot->nombre_apellidos }}</td>
                                <td class="border px-3 text-xs">{{ $ballot->dni }}</td>
                                <td class="border px-3 text-xs">{{ $ballot->razon_social }}</td>
                                <td class="border px-3 text-xs">{{ $ballot->ruc }}</td>
                                <td class="border px-3 text-xs">{{ $ballot->nro_licencia }}</td>
                                <td class="border px-3 text-xs">{{ $ballot->estado_actual }}</td>
                                <td class="border px-3 text-xs">{{ date('d-m-Y', strtotime($ballot->fecha_infraccion)) }}</td>
                                <td class="border px-3 text-xs">{{ $ballot->nro_boleta_pago }}</td>
                                <td class="border px-3 text-xs">{{ $ballot->sede_infraccion }}</td>
                                <td class="border px-3 text-xs">
                                    <div class="flex">
                                        <a class="px-1 py-1 text-blue-500 hover:underline" href="">Editar</a>
                                        <a class="px-1 py-1 text-red-500 hover:underline" href="">Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="my-5">
                        {{ $ballots->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>