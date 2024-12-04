<?php

namespace App\Filament\Admin\Resources\CitaResource\Pages;

use App\Enums\Diagnostico\TipoDiagnosticoEnum;
use App\Filament\Admin\Resources\CitaResource;
use App\Models\Diagnostico;
use App\Models\Medicamento;
use App\Models\Procedimiento;
use App\States\Cita\Finalizado;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditCita extends EditRecord
{
    protected static string $resource = CitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('finalizar_atencion')
                ->color('warning')
                ->requiresConfirmation()
                ->action(function () {
                    $this->getRecord()->estado->transitionTo(Finalizado::class);
                    $this->redirect(CitaResource::getUrl());
                    Notification::make()
                        ->title('Atencion finalizada correctamente')
                        ->success()
                        ->send();
                }),
        ];
    }

    function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('Anam / Examen Físico')
                        ->schema([
                            Group::make([
                                Textarea::make('motivo_consulta'),
                                Textarea::make('examen_clinico'),
                                Textarea::make('antecedentes')->columnSpanFull(),
                                Fieldset::make('Antecedentes personales')
                                    ->schema([
                                        Textarea::make('quirurgicos'),
                                        Textarea::make('alergias'),
                                        Textarea::make('patologicos'),
                                        Textarea::make('familiares'),
                                        Textarea::make('obstetricos'),
                                        Textarea::make('otros'),

                                    ])
                            ])
                                ->relationship('anamnesis')
                                ->columns(2)
                        ]),
                    Tabs\Tab::make('Diagnósticos')
                        ->schema([
                            Section::make('Diagnosticos')
                                ->schema([
                                    TableRepeater::make('citaDiagnosticos')
                                        ->hiddenLabel()
                                        ->addActionLabel('Añadir diagnostico')
                                        ->relationship('citaDiagnosticos')
                                        ->orderColumn('id')
                                        ->headers([
                                            Header::make('tipo')->markAsRequired()->width('150px'),
                                            Header::make('diagnostico')->markAsRequired(),
                                        ])
                                        ->schema([
                                            Select::make('tipo')
                                                ->options(TipoDiagnosticoEnum::class)
                                                ->required(),
                                            Select::make('diagnostico_id')
                                                ->relationship('diagnostico', 'nombre')
                                                ->getOptionLabelFromRecordUsing(fn(Diagnostico $record) => "{$record->codigo} - {$record->nombre}")
                                                ->searchable(['codigo', 'nombre'])
                                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                                ->required()

                                        ])

                                ])->columns(1),
                            Fieldset::make('CPT')
                                ->schema([
                                    TableRepeater::make('citaProcedimientos')
                                        ->hiddenLabel()
                                        ->addActionLabel('Añadir procedimiento')
                                        ->relationship()
                                        ->orderColumn('id')
                                        ->headers([
                                            Header::make('procedimiento')->markAsRequired(),
                                        ])
                                        ->schema([
                                            Select::make('procedimiento_id')
                                                ->relationship('procedimiento', 'nombre')
                                                ->getOptionLabelFromRecordUsing(fn(Procedimiento $record) => "{$record->codigo} - {$record->nombre}")
                                                ->searchable(['codigo', 'nombre'])
                                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                                ->required()

                                        ])
                                ])->columns(1)
                        ]),
                    Tabs\Tab::make('Ordenes Médicas')
                        ->schema([
                            Fieldset::make('Farmacia')
                                ->schema([
                                    TableRepeater::make('citaMedicamentos')
                                        ->hiddenLabel()
                                        ->addActionLabel('Añadir medicamento')
                                        ->relationship()
                                        ->orderColumn('id')
                                        ->headers([
                                            Header::make('medicamento')->markAsRequired(),
                                            Header::make('cantidad')->markAsRequired()->width('100px'),
                                            Header::make('dosis')->markAsRequired(),
                                            Header::make('unidad')->markAsRequired(),
                                            Header::make('frecuencia')->markAsRequired(),
                                            Header::make('via')->markAsRequired(),
                                            Header::make('dias')->markAsRequired()->width('100px'),
                                        ])
                                        ->schema([
                                            Select::make('medicamento_id')
                                                ->relationship('medicamento', 'nombre')
                                                ->searchable(['nombre'])
                                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                                ->required(),
                                            TextInput::make('cantidad')
                                                ->required()
                                                ->numeric()
                                                ->maxValue(99),
                                            Select::make('dosis_id')
                                                ->relationship('dosis', 'nombre')
                                                ->required(),
                                            Select::make('unidad_id')
                                                ->relationship('unidad', 'nombre')
                                                ->required(),
                                            Select::make('frecuencia_id')
                                                ->relationship('frecuencia', 'nombre')
                                                ->required(),
                                            Select::make('via_id')
                                                ->relationship('via', 'nombre')
                                                ->required(),
                                            TextInput::make('dias')
                                                ->required()
                                                ->numeric()
                                                ->maxValue(99),

                                        ])

                                ])->columns(1),
                            Fieldset::make('Rayos X')
                                ->schema([
                                    TableRepeater::make('citaRayosxes')
                                        ->hiddenLabel()
                                        ->addActionLabel('Añadir Rayos X')
                                        ->relationship()
                                        ->orderColumn('id')
                                        ->headers([
                                            Header::make('Rayos X')->markAsRequired(),
                                            Header::make('cantidad')->width('40px'),
                                        ])
                                        ->schema([
                                            Select::make('rayosx_id')
                                                ->relationship('rayosx', 'nombre')
                                                ->searchable(['nombre'])
                                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                                ->required(),
                                            TextInput::make('cantidad')
                                                ->required()
                                                ->numeric()
                                                ->maxValue(99),
                                        ])

                                ])->columns(1)->columnSpan(1),
                            Fieldset::make('Ecografia')
                                ->schema([
                                    TableRepeater::make('citaEcografias')
                                        ->hiddenLabel()
                                        ->addActionLabel('Añadir Ecografia')
                                        ->relationship()
                                        ->orderColumn('id')
                                        ->headers([
                                            Header::make('Ecografia')->markAsRequired(),
                                            Header::make('cantidad')->width('40px'),
                                        ])
                                        ->schema([
                                            Select::make('ecografia_id')
                                                ->relationship('ecografia', 'nombre')
                                                ->searchable(['nombre'])
                                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                                ->required(),
                                            TextInput::make('cantidad')
                                                ->required()
                                                ->numeric()
                                                ->maxValue(99),
                                        ])

                                ])->columns(1)->columnSpan(1),
                            Fieldset::make('Patologia Clinica')
                                ->schema([
                                    TableRepeater::make('citaExamens')
                                        ->hiddenLabel()
                                        ->addActionLabel('Añadir Examen')
                                        ->relationship()
                                        ->orderColumn('id')
                                        ->headers([
                                            Header::make('examen')->markAsRequired(),
                                            Header::make('cantidad')->width('40px'),
                                        ])
                                        ->schema([
                                            Select::make('examen_id')
                                                ->relationship('examen', 'nombre')
                                                ->searchable(['nombre'])
                                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                                ->required(),
                                            TextInput::make('cantidad')
                                                ->required()
                                                ->numeric()
                                                ->maxValue(99),
                                        ])

                                ])->columns(1)->columnSpan(1),
                        ])->columns(2),
                ])
        ])->columns(1);
    }
}


