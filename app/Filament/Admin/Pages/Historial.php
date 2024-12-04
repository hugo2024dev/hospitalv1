<?php

namespace App\Filament\Admin\Pages;

use App\Livewire\CitaTable;
use App\Models\Paciente;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;

class Historial extends Page implements HasTable
{
    use HasPageShield;
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'tabler-list-details';

    protected static string $view = 'filament.admin.pages.historial';

    private $paciente;

    function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('reset')
                ->icon('tabler-refresh')
                ->color('warning')
                ->label('Limpiar')
                ->action(function () {
                    $this->resetAll();
                })
        ];
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Datos del paciente')
                ->description('gsfsdf')
                ->collapsible()
                ->compact()
                ->headerActions([
                    Action::make('buscarPaciente')
                        ->icon('tabler-search')
                        ->action(function () {
                            $this->dispatch('open-modal', id: 'historial-buscar-paciente');
                        })
                ])
                ->schema([
                    ViewField::make('paciente-detalle')
                        ->view('components.paciente-detalle')
                ]),
        ]);
    }

    public function resetAll(): void
    {
        $this->reset();
        $this->dispatch('historial-paciente-seleccionado', data: []);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Paciente::query())
            ->deferLoading()
            ->columns([
                TextColumn::make('numero_documento')->searchable(),
                TextColumn::make('nombres')->searchable(),
                TextColumn::make('apellido_paterno')->searchable(),
                TextColumn::make('apellido_materno')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('asignarPaciente')
                    ->hiddenLabel()
                    ->icon('tabler-circle-check')
                    ->color('success')
                    // ->requiresConfirmation()
                    ->action(function (Paciente $record) {
                        $this->paciente = $record;
                        $this->dispatch('close-modal', id: 'historial-buscar-paciente');
                        $this->dispatch('historial-paciente-seleccionado', data: $this->paciente->attributesToArray());
                        Notification::make()
                            ->title('Paciente seleccionado correctamente')
                            ->success()
                            ->send();
                    })
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
