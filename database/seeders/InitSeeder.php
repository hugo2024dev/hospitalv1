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
    }

    public function tipoDocumentos()
    {
        \DB::table('tipo_documentos')->insert(['nombre' => 'DNI', 'digitos' => 8]);
        \DB::table('tipo_documentos')->insert(['nombre' => 'Carné de extranjeria', 'digitos' => 11]);
        \DB::table('tipo_documentos')->insert(['nombre' => 'RUC', 'digitos' => 14]);
    }
}
