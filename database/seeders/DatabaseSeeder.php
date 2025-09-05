<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llama a todos los seeders personalizados
        $this->call([
            users::class,
            users_factory::class,
            proyectos::class,
            proyectos_factory::class,
        ]);
    }
}
