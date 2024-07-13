<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userAdmin = User::create([
            'name' => 'Karo',
            'email' => 'karo@123.com',
            'password' => bcrypt('contra123') 
        ]);

        $userAdmin->assignRole('admin');

        $userBombero = User::create([
            'name' => 'Carlos',
            'email' => 'carlos@ejemplo.com',
            'password' => bcrypt('carvar1535') 
        ]);

        $userBombero->assignRole('bombero');

        $userComandante = User::firstOrCreate([
            'name' => 'Toño',
            'email' => 'antonio@ejemplo.com',
            'password' => bcrypt('jefe1234') 
        ]);
        $userComandante->assignRole('comandante');

        $userGeneral = User::firstOrCreate([
            'name' => 'Usuario',
            'email' => 'usuario@ejemplo.com',
            'password' => bcrypt('usuario1234') 
        ]);
        $userGeneral->assignRole('usuario general');
    }
}
