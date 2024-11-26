<div>
    <x-filament-panels::page>

        {{ $this->form }}
        <x-filament::grid :default="2" class="gap-x-3">


            <div>
                @livewire(\App\Livewire\CitaCalendarWidget::class)
            </div>
        </x-filament::grid>
    </x-filament-panels::page>
</div>
