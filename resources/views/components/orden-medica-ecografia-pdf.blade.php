{!! $fontHtml !!}
<style>
    .default-template-container * {
        /* font-size: 1.2rem; */
        /* margin-top: 1rem; */
        font-family: '{{ $fontFam }}', sans-serif;
    }
</style>
<div class="default-template-container">
    {{-- TITULO --}}
    <div class="flex justify-center items-center">
        <div class="text-center max-w-2xl">
            <span class="text-3xl font-bold uppercase text-red-800">Orden Médica</span>
            @if ($reportSettings->sub_header)
                <p>{{ $reportSettings->sub_header }}</p>
            @endif
        </div>

    </div>
    <div class="row gap-x-2 mt-6 justify-center items-center">
        <div class="">
            <span class="font-bold">Servicio:</span>
            <span>Ecografia</span>
        </div>
        <div class="">
            <span class="font-bold">Fecha y hora de atencion:</span>
            <span>
                {{ \Carbon\Carbon::parse($cita->programacion->fecha)->format('d/m/Y') }}
                {{ \Carbon\Carbon::parse($cita->hora_inicio)->format('h:i A') }}
            </span>
        </div>
        <div class="">
            <span class="font-bold">N° Cita:</span>
            <span>{{ $cita->numero_orden }}</span>
        </div>
        <div class="">
            <span class="font-bold">Consultorio:</span>
            <span>{{ $cita->programacion->consultorio->nombre }}</span>
        </div>
        <div class="">
            <span class="font-bold">Medico:</span>
            <span>{{ $cita->programacion->empleado->nombre_completo }}</span>
        </div>
        <div class="">
            <span class="font-bold">Paciente:</span>
            <span>{{ $cita->paciente->nombre_completo }}</span>
        </div>
        {{-- <div class="">
            <span class="font-bold">Tipo plan:</span>
        </div> --}}

    </div>
    <div class="mt-6">
        {{-- <span class="text-lg font-bold uppercase text-gray-700">Exámenes Solicitados</span> --}}
        <div class="overflow-hidden border border-gray-300 rounded-lg">
            <table class="w-full table-auto">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left font-bold">#</th>
                        <th class="px-4 py-2 text-left font-bold">Concepto</th>
                        <th class="px-4 py-2 text-center font-bold">Cantidad</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($cita->ecografias as $rayosx)
                        <tr>
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $rayosx->nombre }}</td>
                            <td class="px-4 py-2 text-center">{{ $rayosx->pivot->cantidad }}</td>
                        </tr>
                    @endforeach
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
        </div>
    </div>

</div>
