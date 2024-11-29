<?php

namespace App\Filament\Admin\Resources\CitaResource\Pages;

use App\Filament\Admin\Resources\CitaResource;
use Filament\Actions;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
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
                    Tabs\Tab::make('Tab 2')
                        ->schema([
                            // ...
                        ]),
                    Tabs\Tab::make('Tab 3')
                        ->schema([
                            // ...
                        ]),
                ])
        ])->columns(1);
    }
}
