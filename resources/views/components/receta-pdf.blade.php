{!! $fontHtml !!}
<style>
    .default-template-container * {
        /* font-size: 1.2rem; */
        /* margin-top: 1rem; */
        font-family: '{{ $fontFam }}', sans-serif;
    }

    .pagebreak {
        page-break-before: always;
        clear: both;
    }
</style>
<div class="default-template-container">
    {{-- TITULO --}}
    <div class="flex justify-center items-center">
        <div class="text-center max-w-2xl">
            <span class="text-3xl font-bold uppercase text-red-800">Receta Médica</span>
            @if ($reportSettings->sub_header)
                <p>{{ $reportSettings->sub_header }}</p>
            @endif
        </div>

    </div>
    <div class="grid grid-cols-2 mt-6 justify-center items-center gap-2">
        <div class="">
            <span class="font-bold">Fecha de vigencia:</span>
            <span>Rayos x</span>
        </div>
        <div class="">
            <span class="font-bold">Fecha y hora de atencion:</span>
            <span>
                {{ \Carbon\Carbon::parse($cita->programacion->fecha)->format('d/m/Y') }}
                {{ \Carbon\Carbon::parse($cita->hora_inicio)->format('h:i A') }}
            </span>
        </div>
        <div class="">
            <span class="font-bold">Paciente:</span>
            <span>{{ $cita->paciente->nombre_completo }}</span>
        </div>
        <div class="">
            <span class="font-bold">Paciente:</span>
            <span>{{ $cita->paciente->nombre_completo }}</span>
        </div>
        <div class="">
            <span class="font-bold">Tipo Financ:</span>
            <span>SIS</span>
        </div>
        <div class="">
            <span class="font-bold">Edad:</span>
            <span>{{ $cita->paciente->fecha_nacimiento->age }}</span>
        </div>
        <div class="">
            <span class="font-bold">Especialidad:</span>
            <span>{{ $cita->programacion->especialidad->nombre }}</span>
        </div>
        <div class="">
            <span class="font-bold">Servicio:</span>
            <span>Consultorios Externos</span>
        </div>
        <div class="">
            <span class="font-bold">Consultorio:</span>
            <span>{{ $cita->programacion->consultorio->nombre }}</span>
        </div>


    </div>
    <div class="mt-6">
        <span class="text-lg font-bold uppercase text-gray-700">DIAGNOSTICOS</span>
        <div class="overflow-hidden border border-gray-300 rounded-lg">
            <table class="w-full table-auto">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left font-bold">TIPO</th>
                        <th class="px-4 py-2 text-left font-bold">CIE 10</th>
                        <th class="px-4 py-2 text-center font-bold">DESCRIPCIÓN</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($cita->diagnosticos as $diagnostico)
                        <tr>
                            <td class="px-4 py-2">{{ $diagnostico->pivot->tipo }}</td>
                            <td class="px-4 py-2">{{ $diagnostico->codigo }}</td>
                            <td class="px-4 py-2">{{ $diagnostico->nombre }}</td>
                        </tr>
                    @endforeach
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6">
        {{-- <span class="text-lg font-bold uppercase text-gray-700">Exámenes Solicitados</span> --}}
        <div class="overflow-hidden border border-gray-300 rounded-lg">
            <table class="w-full table-auto">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left font-bold">Medicamento o Insumo</th>
                        <th class="px-4 py-2 text-center font-bold">Cantidad</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($cita->medicamentos as $medicamento)
                        <tr>
                            <td class="px-4 py-2">{{ $medicamento->nombre }}
                                {{ $medicamento->pivot->dosis->nombre }} - {{ $medicamento->pivot->unidad->nombre }}
                            </td>
                            <td class="px-4 py-2 text-center">{{ $medicamento->pivot->cantidad }}</td>
                        </tr>
                    @endforeach
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-16 flex items-center justify-end">
        <span class="border-t-2 border-collapse">{{ $cita->programacion->empleado->nombre_completo }}</span>
    </div>
    <p class="pagebreak"></p>

    <div class="flex justify-center items-center">
        <div class="text-center max-w-2xl">
            <span class="text-3xl font-bold uppercase text-red-800">Receta Médica</span>
            @if ($reportSettings->sub_header)
                <p>{{ $reportSettings->sub_header }}</p>
            @endif
        </div>

    </div>
    <div class="grid grid-cols-2 mt-6 justify-center items-center gap-2">
        <div class="">
            <span class="font-bold">Fecha de vigencia:</span>
            <span>Rayos x</span>
        </div>
        <div class="">
            <span class="font-bold">Fecha y hora de atencion:</span>
            <span>
                {{ \Carbon\Carbon::parse($cita->programacion->fecha)->format('d/m/Y') }}
                {{ \Carbon\Carbon::parse($cita->hora_inicio)->format('h:i A') }}
            </span>
        </div>
        <div class="">
            <span class="font-bold">Paciente:</span>
            <span>{{ $cita->paciente->nombre_completo }}</span>
        </div>
        <div class="">
            <span class="font-bold">Paciente:</span>
            <span>{{ $cita->paciente->nombre_completo }}</span>
        </div>
    </div>

    <div class="mt-6">
        <span class="text-lg font-bold uppercase text-gray-700">Indicaciones</span>
        <div class="overflow-hidden border border-gray-300 rounded-lg">
            <table class="w-full table-auto">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left font-bold">Medicamento</th>
                        <th class="px-4 py-2 text-center font-bold">Dosis</th>
                        <th class="px-4 py-2 text-center font-bold">Via</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($cita->medicamentos as $medicamento)
                        <tr>
                            <td class="px-4 py-2">{{ $medicamento->nombre }}
                                {{ $medicamento->pivot->dosis->nombre }} - {{ $medicamento->pivot->unidad->nombre }}
                                <p>Frecuencia: {{ $medicamento->pivot->frecuencia->nombre }}</p>
                            </td>
                            <td class="px-4 py-2 text-center">{{ $medicamento->pivot->cantidad }}</td>
                            <td class="px-4 py-2 text-center">{{ $medicamento->pivot->via->nombre }}</td>
                        </tr>
                    @endforeach
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-16 flex items-center justify-end">
        <span class="border-t-2 border-collapse">{{ $cita->programacion->empleado->nombre_completo }}</span>
    </div>
</div>
