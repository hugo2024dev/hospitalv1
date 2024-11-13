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
            EspecialidadSeeder::class,
            InitSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            EmpleadosSeeder::class,
            PacientesSeeder::class,
        ]);

        Artisan::call('shield:generate --all');
        $this->call([
            GiveBasicPermissionsSeeder::class,
        ]);
    }
}
