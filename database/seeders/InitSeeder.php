<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->tipoDocumentos();

        $enfermedads = base_path('database/sql/enfermedads.sql');
        $medicamentos = base_path('database/sql/medicamentos.sql');
        $procedimientos = base_path('database/sql/procedimientos.sql');
        if (file_exists($enfermedads)) {
            $sql = file_get_contents($enfermedads);
            \DB::unprepared($sql);
        }

        if (file_exists($medicamentos)) {
            $sql = file_get_contents($medicamentos);
            \DB::unprepared($sql);
        }

        if (file_exists($procedimientos)) {
            $sql = file_get_contents($procedimientos);
            \DB::unprepared($sql);
        }
    }

    public function tipoDocumentos()
    {
        \DB::table('tipo_documentos')->insert(['nombre' => 'DNI', 'digitos' => 8]);
        \DB::table('tipo_documentos')->insert(['nombre' => 'Carné de extranjeria', 'digitos' => 11]);
        \DB::table('tipo_documentos')->insert(['nombre' => 'RUC', 'digitos' => 14]);
    }
}
