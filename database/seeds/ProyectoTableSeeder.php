<?php

use Illuminate\Database\Seeder;
use App\Proyecto;

class ProyectoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Proyecto::class,50)->create();
    }
}
