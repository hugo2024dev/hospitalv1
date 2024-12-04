<x-filament-panels::page>
    {{ $this->form }}
    <x-filament::section collapsible collapsed compact @class(['hidden' => !$this->paciente])>
        <x-slot name="heading">
            Atenciones
            <p
                class="fi-section-header-description overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400">
                Historia individual resumida del establecimiento
            </p>
        </x-slot>

        <div>
            @livewire(\App\Livewire\CitaTable::class)
        </div>
    </x-filament::section>

    <x-filament::modal id="historial-buscar-paciente" width="3xl">
        {{ $this->table }}
    </x-filament::modal>
</x-filament-panels::page>
