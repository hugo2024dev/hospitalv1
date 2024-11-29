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

        $diagnosticos = base_path('database/sql/diagnosticos.sql');
        $medicamentos = base_path('database/sql/medicamentos.sql');
        $procedimientos = base_path('database/sql/procedimientos.sql');
        $farmacia = base_path('database/sql/farmacia.sql');
        $rayosx = base_path('database/sql/rayosx.sql');
        $ecografias = base_path('database/sql/ecografias.sql');
        if (file_exists($diagnosticos)) {
            $sql = file_get_contents($diagnosticos);
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

        if (file_exists($farmacia)) {
            $sql = file_get_contents($farmacia);
            \DB::unprepared($sql);
        }

        if (file_exists($rayosx)) {
            $sql = file_get_contents($rayosx);
            \DB::unprepared($sql);
        }

        if (file_exists($ecografias)) {
            $sql = file_get_contents($ecografias);
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
