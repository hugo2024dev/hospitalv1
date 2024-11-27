<?php

namespace App\Filament\Admin\Pages;

use App\Models\Cita;
use App\Models\Empleado;
use App\Models\Especialidad;
use App\Models\Paciente;
use App\Models\Programacion;
use App\States\Cita\Asignado;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Livewire\Attributes\On;

class GestionarCita extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.admin.pages.gestionar-cita';

    public ?string $especialidad;
    public ?string $medico;
    public $programacion;
    public $citaSeleccionada;

    public function mount(): void
    {
        // $this->form->fill(['especialidad' => '', 'medico' => 'xd']);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Filtros')
                    ->headerActions([
                        Action::make('aplicar')
                            ->action(function (GestionarCita $livewire) {
                                $livewire->dispatch(
                                    'cita-filter-applied',
                                    $this->form->getState()
                                );
                            }),
                        Action::make('limpiar')
                            ->color('warning')
                            ->action(function (GestionarCita $livewire) {
                                $livewire->dispatch(
                                    'cita-filter-applied',
                                    $this->form->getState()
                                );
                            }),
                    ])
                    ->schema([
                        Select::make('especialidad')
                            ->hiddenLabel()
                            ->options(Especialidad::pluck('nombre', 'id')),
                        Select::make('medico')
                            ->hiddenLabel()
                            ->options(Empleado::pluck('nombres', 'id')),
                    ])
                    ->columns(2)
            ]);
    }

    #[On('cita-programacion-selected')]
    function setActiveProgramacion($id): void
    {
        $this->programacion = Programacion::findOrFail($id);

    }

    function openModal($id): void
    {
        // dd($id);
        $this->dispatch('open-modal', id: 'asignar-paciente');
        // $this->programacion = Programacion::findOrFail($id);
        $this->citaSeleccionada = Cita::findOrFail($id);

    }

    #[On('close-modal')]
    function closeModal($id): void
    {
        if ($id === 'asignar-paciente') {
            $this->citaSeleccionada = null;
            // $this->reset('programacion');
        }
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
                        // dd($record);
                        $this->citaSeleccionada->estado->transitionTo(Asignado::class, auth()->id(), $record->id);
                        $this->dispatch('close-modal', id: 'asignar-paciente');
                        Notification::make()
                            ->title('Paciente asignado correctamente')
                            ->success()
                            ->send();
                    })
            ])
            ->bulkActions([
                // ...
            ]);
    }

}
