<?php

namespace App\Filament\Admin\Pages;

use App\Enums\Programacion\TurnoEnum;
use App\Livewire\Forms\ProgramacionForm;
use App\Models\Consultorio;
use App\Models\Empleado;
use App\Models\Especialidad;
use App\Models\Programacion;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class GestionarProgramaciones extends Page
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'tabler-calendar-due';

    protected static string $view = 'filament.admin.pages.gestionar-programaciones';

    public ProgramacionForm $form;
    public array $arr_fechas_seleccionadas = [];

    function getHeaderActions(): array
    {
        return [
            Action::make('saveAction')
                ->label('Generar programaciones')
                ->action(function () {
                    $this->save();
                    Notification::make()
                        ->title('Programaciones generadas correctamente')
                        ->success()
                        ->send();
                })
        ];
    }


    #[Computed()]
    public function empleados()
    {
        return Empleado::get();
    }

    #[Computed()]
    public function especialidads()
    {
        return Especialidad::get();
    }

    #[Computed()]
    public function consultorios()
    {
        return Consultorio::get();
    }

    #[Computed()]
    public function turnos()
    {
        return TurnoEnum::toArray();
    }

    function mount(): void
    {

    }

    public function save()
    {
        // dd($this->form->toArray());
        $this->validate();
        try {
            \DB::transaction(function () {
                foreach ($this->form->arr_fechas as $value) {
                    $programacion = Programacion::create([
                        'cantidad_citas' => $this->form->cantidad_citas,
                        'fecha' => $value['fecha'],
                        'duracion_cita' => $this->form->duracion_cita,
                        'turno' => $value['turno'],
                        'empleado_id' => $this->form->empleado_id,
                        'consultorio_id' => $this->form->consultorio_id,
                        'especialidad_id' => $this->form->especialidad_id,
                    ]);
                    $horaInicio = Carbon::parse($programacion->hora_inicio); // Convertimos la hora de inicio a un objeto Carbon
                    for ($i = 1; $i <= $programacion->cantidad_citas; $i++) {
                        $horaFin = $horaInicio->copy()->addMinutes(value: $programacion->duracion_cita); // Calculamos la hora de fin sumando $programacion->duracion_cita minutos
                        $programacion->citas()->create([
                            'numero_orden' => $i,
                            'hora_inicio' => $horaInicio->format('H:i'), // Formateamos la hora de inicio
                            'hora_fin' => $horaFin->format('H:i') // Formateamos la hora de fin
                        ]);

                        $horaInicio->addMinutes($programacion->duracion_cita); // Avanzamos $programacion->duracion_cita minutos para la próxima iteración
                    }
                }
            });
        } catch (\Throwable $th) {
            throw $th;
        }
        $this->form->resetErrorBag();
        $this->form->reset();
        $this->form->resetValidation();
        $this->dispatch('programacion-array-updated', $this->form->arr_fechas);
    }

    #[On('programacion-date-clicked')]
    public function addFecha($info)
    {
        // dd($info);
        $this->form->arr_fechas[] = [
            'fecha' => Carbon::parse($info['date'])->toDateString(),
            'turno' => null
        ];
        $this->dispatch('programacion-array-updated', $this->form->arr_fechas);
        // dd($info, $this->arr_fechas_seleccionadas);
    }

    public function deleteFecha($key)
    {
        // dd($key);
        unset($this->form->arr_fechas[$key]);
        $this->dispatch('programacion-array-updated', $this->form->arr_fechas);
        // dd($info, $this->arr_fechas_seleccionadas);
    }
}
