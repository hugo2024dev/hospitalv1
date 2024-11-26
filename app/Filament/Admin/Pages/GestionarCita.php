<?php

namespace App\Filament\Admin\Pages;

use App\Models\Empleado;
use App\Models\Especialidad;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Livewire\Attributes\On;

class GestionarCita extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.admin.pages.gestionar-cita';

    public ?string $especialidad;
    public ?string $medico;

    public function mount(): void
    {
        // $this->form->fill(['especialidad' => '', 'medico' => 'xd']);
    }

    // protected function getForms(): array
    // {
    //     // parent::getForms()
    //     return [
    //         'editProfileForm',
    //         'editPasswordForm',
    //     ];
    // }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Filtros')
                    ->headerActions([
                        Action::make('aplicar')
                            ->action(function (GestionarCita $livewire) {
                                $formData = $this->form->getState();
                                $formData2 = $this->form->getStatePath();
                                // dd($formData, $formData2); // Muestra la data para depurar
                                $livewire->dispatch(
                                    'cita-filter-applied',
                                    $this->form->getState()
                                );
                            }),
                        Action::make('limpiar')
                            ->color('warning')
                            ->action(function (GestionarCita $livewire) {
                                $formData = $this->form->fill();
                                // dd($formData, $formData2); // Muestra la data para depurar
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

}
