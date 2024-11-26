<form wire:submit="save">
    <x-filament-panels::page>
        <x-filament::section>
            <x-slot name="heading">
                Datos Generales
            </x-slot>

            {{-- Content --}}
            <x-filament::grid :default="2" class="gap-3">
                {{-- consultrio --}}
                <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                    <div data-field-wrapper="" class="fi-fo-field-wrp">
                        <div class="grid gap-y-2">
                            <div class="flex items-center gap-x-3 justify-between ">
                                <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                    for="data.descripcion">
                                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                        Médico
                                    </span>
                                </label>
                            </div>
                            <div class="grid auto-cols-fr gap-y-2">
                                <x-filament::input.wrapper :valid="!$errors->has('form.empleado_id')">
                                    <x-filament::input.select wire:model="form.empleado_id">
                                        <option value="">Seleccione un médico...</option>
                                        @foreach ($this->empleados as $empleado)
                                            <option value="{{ $empleado->id }}">{{ $empleado->nombres }}</option>
                                        @endforeach
                                    </x-filament::input.select>
                                </x-filament::input.wrapper>
                                @error('form.empleado_id')
                                    <p class="fi-fo-field-wrp-error-message text-sm text-danger-600 dark:text-danger-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- consultrio --}}
                <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                    <div data-field-wrapper="" class="fi-fo-field-wrp">
                        <div class="grid gap-y-2">
                            <div class="flex items-center gap-x-3 justify-between ">
                                <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                    for="data.descripcion">
                                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                        Consultorio
                                    </span>
                                </label>
                            </div>
                            <div class="grid auto-cols-fr gap-y-2">
                                <x-filament::input.wrapper :valid="!$errors->has('form.consultorio_id')">
                                    <x-filament::input.select wire:model="form.consultorio_id">
                                        <option value="">Seleccione un consultorio...</option>
                                        @foreach ($this->consultorios as $consultorio)
                                            <option value="{{ $consultorio->id }}">{{ $consultorio->nombre }}</option>
                                        @endforeach
                                    </x-filament::input.select>
                                </x-filament::input.wrapper>
                                @error('form.consultorio_id')
                                    <p class="fi-fo-field-wrp-error-message text-sm text-danger-600 dark:text-danger-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </x-filament::grid>
            <x-filament::grid :default="3" class="gap-3 pt-3">
                {{-- especialidad --}}
                <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                    <div data-field-wrapper="" class="fi-fo-field-wrp">
                        <div class="grid gap-y-2">
                            <div class="flex items-center gap-x-3 justify-between ">
                                <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                    for="data.descripcion">
                                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                        Especialidad
                                    </span>
                                </label>
                            </div>
                            <div class="grid auto-cols-fr gap-y-2">
                                <x-filament::input.wrapper :valid="!$errors->has('form.especialidad_id')">
                                    <x-filament::input.select wire:model="form.especialidad_id">
                                        <option value="">Seleccione una especialidad...</option>
                                        @foreach ($this->especialidads as $especialidad)
                                            <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                                        @endforeach
                                    </x-filament::input.select>
                                </x-filament::input.wrapper>
                                @error('form.especialidad_id')
                                    <p class="fi-fo-field-wrp-error-message text-sm text-danger-600 dark:text-danger-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CANTIDAD DE CITAS --}}
                <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                    <div data-field-wrapper="" class="fi-fo-field-wrp">
                        <div class="grid gap-y-2">
                            <div class="flex items-center gap-x-3 justify-between ">
                                <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                    for="data.descripcion">
                                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                        Cantidad de citas
                                    </span>
                                </label>
                            </div>
                            <div class="grid auto-cols-fr gap-y-2">
                                <x-filament::input.wrapper :valid="!$errors->has('form.cantidad_citas')">
                                    <x-filament::input type="number" wire:model="form.cantidad_citas" min="0" />
                                </x-filament::input.wrapper>
                                @error('form.cantidad_citas')
                                    <p class="fi-fo-field-wrp-error-message text-sm text-danger-600 dark:text-danger-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DURACION DE LA CITA --}}
                <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                    <div data-field-wrapper="" class="fi-fo-field-wrp">
                        <div class="grid gap-y-2">
                            <div class="flex items-center gap-x-3 justify-between ">
                                <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                    for="data.descripcion">
                                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                        Duracion de la cita
                                    </span>
                                </label>
                            </div>
                            <div class="grid auto-cols-fr gap-y-2">
                                <x-filament::input.wrapper :valid="!$errors->has('form.duracion_cita')">
                                    <x-filament::input type="number" wire:model="form.duracion_cita" min="0"
                                        step="5" />
                                </x-filament::input.wrapper>
                                @error('form.duracion_cita')
                                    <p class="fi-fo-field-wrp-error-message text-sm text-danger-600 dark:text-danger-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </x-filament::grid>
        </x-filament::section>

        <x-filament::grid :default="2" class="gap-x-3">
            <x-filament-tables::container>
                <div class="divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10">
                    <table class="w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                        <thead class="divide-y divide-gray-200 dark:divide-white/5">
                            <tr class="bg-gray-50 dark:bg-white/5">
                                <x-filament-tables::header-cell alignment="center">N°</x-filament-tables::header-cell>
                                <x-filament-tables::header-cell
                                    alignment="center">Fecha</x-filament-tables::header-cell>
                                <x-filament-tables::header-cell
                                    alignment="center">Turno</x-filament-tables::header-cell>
                                <x-filament-tables::header-cell
                                    alignment="center">Acción</x-filament-tables::header-cell>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                            @foreach ($form->arr_fechas as $key => $data)
                                <x-filament-tables::row wire:key="{{ $key }}">
                                    <x-filament-tables::cell class="text-center p-2">
                                        <div class=" text-sm leading-6 text-gray-950 dark:text-white">
                                            {{ $loop->iteration }}
                                        </div>
                                    </x-filament-tables::cell>
                                    <x-filament-tables::cell class="text-center p-2">
                                        {{-- fecha --}}
                                        <div style="--col-span-default: span 1 / span 1;"
                                            class="col-[--col-span-default]">
                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                <div class="grid auto-cols-fr gap-y-2">
                                                    <x-filament::input.wrapper :valid="!$errors->has(sprintf('form.arr_fechas.%s.fecha', $key))" disabled>
                                                        <x-filament::input type="date"
                                                            wire:model="form.arr_fechas.{{ $key }}.fecha"
                                                            disabled />
                                                    </x-filament::input.wrapper>
                                                    @error(sprintf('form.arr_fechas.%s.fecha', $key))
                                                        <p
                                                            class="fi-fo-field-wrp-error-message text-sm text-danger-600 dark:text-danger-400">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </x-filament-tables::cell>
                                    <x-filament-tables::cell class="text-center p-2">
                                        <div style="--col-span-default: span 1 / span 1;"
                                            class="col-[--col-span-default]">
                                            <div data-field-wrapper="" class="fi-fo-field-wrp">
                                                <div class="grid auto-cols-fr gap-y-2">
                                                    <x-filament::input.wrapper :valid="!$errors->has(sprintf('form.arr_fechas.%s.turno', $key))">
                                                        <x-filament::input.select
                                                            wire:model="form.arr_fechas.{{ $key }}.turno">
                                                            <option value="">Seleccione un Turno...
                                                            </option>
                                                            @foreach ($this->turnos as $k => $value)
                                                                <option value="{{ $value }}">
                                                                    {{ $k }}
                                                                </option>
                                                            @endforeach
                                                        </x-filament::input.select>
                                                    </x-filament::input.wrapper>
                                                    @error(sprintf('form.arr_fechas.%s.turno', $key))
                                                        <p
                                                            class="fi-fo-field-wrp-error-message text-wrap text-sm text-danger-600 dark:text-danger-400">
                                                            {{ $message }}
                                                        </p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </x-filament-tables::cell>

                                    <x-filament-tables::cell class="text-center p-2">
                                        <x-filament::icon-button icon="tabler-circle-minus" color="danger"
                                            wire:click="deleteFecha({{ $key }})" label="Eliminar" />
                                    </x-filament-tables::cell>

                                </x-filament-tables::row>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-filament-tables::container>
            <div>
                @livewire(\App\Livewire\ProgramacionCalendarWidget::class)
            </div>
        </x-filament::grid>
    </x-filament-panels::page>
</form>
