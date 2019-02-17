<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create([
        	'name' => 'admin',
        	'display_name' => 'administrador',
        	'descripcion' => 'tiene permisos de administrador'
        ]);
    }
}
