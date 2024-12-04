<div>
    <x-filament-panels::page>

        {{ $this->form }}
        <x-filament::grid :default="2" class="gap-x-3">
            @if ($programacion)
                <div x-data="{ activeTab: 'mañana' }" class="space-y-6">
                    <x-filament::tabs label="Content tabs" contained>
                        <x-filament::tabs.item alpine-active="activeTab === 'mañana'" x-on:click="activeTab = 'mañana'">
                            Mañana
                        </x-filament::tabs.item>

                        <x-filament::tabs.item alpine-active="activeTab === 'tarde'" x-on:click="activeTab = 'tarde'">
                            Tarde
                        </x-filament::tabs.item>
                    </x-filament::tabs>
                    <div x-show="activeTab === 'mañana'">
                        <x-filament-tables::container>
                            <div
                                class="divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10
                                flex flex-col  h-[510px] overflow-y-auto space-y-4 p-4">
                                <table
                                    class="w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                                    <thead class="divide-y divide-gray-200 dark:divide-white/5">
                                        <tr class="bg-gray-50 dark:bg-white/5">
                                            <x-filament-tables::header-cell
                                                alignment="center">Hora</x-filament-tables::header-cell>
                                            <x-filament-tables::header-cell
                                                alignment="center">Cita</x-filament-tables::header-cell>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                                        @if ($programacion->turno === App\Enums\Programacion\TurnoEnum::MAÑANA)
                                            @foreach ($programacion->citas as $cita)
                                                <x-filament-tables::row wire:key="{{ $cita->id }}">
                                                    <x-filament-tables::cell class="text-center p-2">
                                                        <div class=" text-sm leading-6 text-gray-950 dark:text-white">
                                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $cita->hora_inicio)->format('H:i') }}
                                                            -
                                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $cita->hora_fin)->format('H:i') }}
                                                        </div>
                                                    </x-filament-tables::cell>

                                                    <x-filament-tables::cell class="text-center p-2">
                                                        <div @class([
                                                            'flex flex-row shadow-md rounded-lg gap-4 items-center justify-center p-2',
                                                            'bg-yellow-300' => $cita->estado->color() === 'warning',
                                                            'bg-gray-300' => $cita->estado->color() === 'gray',
                                                            'bg-green-300' => $cita->estado->color() === 'success',
                                                        ])>
                                                            <p class="font-semibold text-black">
                                                                N° {{ $cita->numero_orden }}
                                                            </p>
                                                            @if ($cita->paciente)
                                                                <p class="text-sm text-black">
                                                                    Paciente
                                                                    :{{ $cita->paciente?->nombres ?? 'No asignado' }}
                                                                </p>
                                                            @endif
                                                            <div class="justify-self-end ">
                                                                <div class="space-x-2">
                                                                    <x-filament::icon-button icon="tabler-user-plus"
                                                                        label="Asignar paciente"
                                                                        tooltip="Asignar paciente"
                                                                        wire:click="openModal({{ $cita->id }})"
                                                                        @class([
                                                                            'hidden' => !$cita->estado->equals(App\States\Cita\Nuevo::class),
                                                                        ])>

                                                                    </x-filament::icon-button>
                                                                    <x-filament::icon-button icon="tabler-circle-x"
                                                                        color="danger" label="Cancelar cita"
                                                                        tooltip="Cancelar cita"
                                                                        wire:click="cancelarCita({{ $cita->id }})"
                                                                        @class([
                                                                            'hidden' =>
                                                                                !$cita->paciente_id ||
                                                                                $cita->estado->equals(App\States\Cita\Finalizado::class),
                                                                        ])>

                                                                    </x-filament::icon-button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </x-filament-tables::cell>
                                                </x-filament-tables::row>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </x-filament-tables::container>
                    </div>
                    <div x-show="activeTab === 'tarde'">
                        <x-filament-tables::container>
                            <div
                                class="divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10
                                flex flex-col  h-[510px] overflow-y-auto space-y-4 p-4">
                                <table
                                    class="w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                                    <thead class="divide-y divide-gray-200 dark:divide-white/5">
                                        <tr class="bg-gray-50 dark:bg-white/5">
                                            <x-filament-tables::header-cell
                                                alignment="center">Hora</x-filament-tables::header-cell>
                                            <x-filament-tables::header-cell
                                                alignment="center">Cita</x-filament-tables::header-cell>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                                        @if ($programacion->turno === App\Enums\Programacion\TurnoEnum::TARDE)
                                            @foreach ($programacion->citas as $cita)
                                                <x-filament-tables::row wire:key="{{ $cita->id }}">
                                                    <x-filament-tables::cell class="text-center p-2">
                                                        <div class=" text-sm leading-6 text-gray-950 dark:text-white">
                                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $cita->hora_inicio)->format('H:i') }}
                                                            -
                                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $cita->hora_fin)->format('H:i') }}
                                                        </div>
                                                    </x-filament-tables::cell>

                                                    <x-filament-tables::cell class="text-center p-2">
                                                        <div @class([
                                                            'flex flex-row shadow-md rounded-lg gap-4 items-center justify-center p-2',
                                                            'bg-yellow-300' => $cita->estado->color() === 'warning',
                                                            'bg-gray-300' => $cita->estado->color() === 'gray',
                                                            'bg-green-300' => $cita->estado->color() === 'success',
                                                        ])>
                                                            <p class="font-semibold text-black">
                                                                N° {{ $cita->numero_orden }}
                                                            </p>
                                                            @if ($cita->paciente)
                                                                <p class="text-sm text-black">
                                                                    Paciente
                                                                    :{{ $cita->paciente?->nombres ?? 'No asignado' }}
                                                                </p>
                                                            @endif
                                                            <div class="justify-self-end ">
                                                                <div class="space-x-2">
                                                                    <x-filament::icon-button icon="tabler-user-plus"
                                                                        label="Asignar paciente"
                                                                        tooltip="Asignar paciente"
                                                                        wire:click="openModal({{ $cita->id }})"
                                                                        @class([
                                                                            'hidden' => !$cita->estado->equals(App\States\Cita\Nuevo::class),
                                                                        ])>

                                                                    </x-filament::icon-button>
                                                                    <x-filament::icon-button icon="tabler-circle-x"
                                                                        color="danger" label="Cancelar cita"
                                                                        tooltip="Cancelar cita"
                                                                        wire:click="cancelarCita({{ $cita->id }})"
                                                                        @class([
                                                                            'hidden' =>
                                                                                !$cita->paciente_id ||
                                                                                $cita->estado->equals(App\States\Cita\Finalizado::class),
                                                                        ])>

                                                                    </x-filament::icon-button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </x-filament-tables::cell>

                                                </x-filament-tables::row>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </x-filament-tables::container>
                    </div>
                </div>
            @else
                <div class="">
                    <div class="flex h-full items-center justify-center">
                        Por favor seleccione una programación :)
                    </div>
                </div>
            @endif

            <div>
                @livewire(\App\Livewire\CitaCalendarWidget::class)
            </div>
        </x-filament::grid>
    </x-filament-panels::page>
    <x-filament::modal id="asignar-paciente" width="3xl">
        {{ $this->table }}
    </x-filament::modal>
</div>
