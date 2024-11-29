<?php

namespace App\Filament\Admin\Resources\CitaResource\Pages;

use App\Enums\Diagnostico\TipoDiagnosticoEnum;
use App\Filament\Admin\Resources\CitaResource;
use App\Models\Diagnostico;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Actions;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditCita extends EditRecord
{
    protected static string $resource = CitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
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
                            Fieldset::make('Diagnosticos')
                                ->schema([
                                    TableRepeater::make('citaDiagnosticos')
                                        ->hiddenLabel()
                                        ->relationship('citaDiagnosticos')
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
                                ->schema([])
                        ]),
                    Tabs\Tab::make('Tab 3')
                        ->schema([
                            // ...
                        ]),
                ])
        ])->columns(1);
    }
}
