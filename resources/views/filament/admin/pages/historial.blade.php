<x-filament-panels::page>
    {{ $this->form }}
    @if ($this->paciente)
        <x-filament::section collapsible collapsed compact>
            <x-slot name="heading">
                Atenciones
                <p
                    class="fi-section-header-description overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400">
                    Historia individual resumida del establecimiento
                </p>
            </x-slot>

            <div>
                @livewire(\App\Livewire\CitaTable::class, ['pacienteId' => $this->paciente->id])
            </div>
        </x-filament::section>
    @endif

    @if ($this->citaId)
        <div x-data="{ activeTab: 'cpt' }">
            <x-filament::tabs label="Content tabs">
                <x-filament::tabs.item alpine-active="activeTab === 'cpt'" x-on:click="activeTab = 'cpt'">
                    Procedmientos de apoyo a los diagnosticos generados.
                </x-filament::tabs.item>

                <x-filament::tabs.item alpine-active="activeTab === 'pdf'" x-on:click="activeTab = 'pdf'">
                    PDF generados
                </x-filament::tabs.item>
            </x-filament::tabs>
            <div x-show="activeTab === 'cpt'">
                @livewire(\App\Livewire\MedicamentoTable::class, ['citaId' => $this->citaId])
            </div>
            <div x-show="activeTab === 'pdf'">
                @if (empty($this->documentos))
                    <div class="flex items-center justify-center h-20 mt-6">
                        <x-dynamic-component component="tabler-alert-triangle" @class(['file-icon w-12 h-12 mr-4', 'text-red-500']) />
                        <p class="text-red-600 font-semibold text-lg">
                            Aun no tiene documentos para mostrar :).
                        </p>
                    </div>
                @else
                    <div class="flex flex-wrap p-4 gap-4">
                        @foreach ($this->documentos as $documento)
                            <div
                                class="file-entry flex items-center p-4 border rounded-lg shadow-md bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <x-dynamic-component component="tabler-pdf" @class(['file-icon w-12 h-12 mr-4', 'text-red-500']) />
                                <div class="file-info flex flex-col items-start">
                                    <strong
                                        class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ $documento['label'] }}</strong>
                                    <a href="{{ route($documento['url'], ['id' => $this->citaId]) }}" target="_blank"
                                        class="text-blue-500 dark:text-blue-400 hover:underline">Ver archivo</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    @endif

    <x-filament::modal id="historial-buscar-paciente" width="3xl">
        {{ $this->table }}
    </x-filament::modal>
</x-filament-panels::page>
