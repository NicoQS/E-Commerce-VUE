<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto;
use App\Models\ImagenProducto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'celular' => '1234567890',
        ])->assignRole('admin');

        \App\Models\DireccionUsuario::factory()->create([
            'user_id' => 1,
            'numero' => 123,
            'direccion_1' => 'Calle 123',
            'direccion_2' => 'Piso 1',
            'provincia' => 'Buenos Aires',
            'localidad' => 'La Plata',
            'codigo_postal' => '1900',
        ]);

        Storage::deleteDirectory('public/productos');
        Storage::makeDirectory('public/productos');
        Proveedor::factory(10)->create();
        Categoria::factory(14)->create();
        Producto::factory(10)->create();
        ImagenProducto::factory(10)->create();

    }
}
