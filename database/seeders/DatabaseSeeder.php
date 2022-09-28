<?php

namespace Database\Seeders;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Plato;
use App\Models\Comanda;
use App\Models\DetalleComanda;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EmpresaSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        Categoria::factory(20)->create();
        Cliente::factory(20)->create();
        Plato::factory(20)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(EmpresaSeeder::class);
    }
}
