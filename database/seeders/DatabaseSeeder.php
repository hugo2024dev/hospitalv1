<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            InitSeeder::class,
            EmpleadosSeeder::class,
            EspecialidadSeeder::class,
            ConsultorioSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            PacientesSeeder::class,
        ]);

        Artisan::call('shield:generate --all --ignore-existing-policies');
        $this->call([
            GiveBasicPermissionsSeeder::class,
        ]);
    }
}
