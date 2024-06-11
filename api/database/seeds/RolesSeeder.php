<?php

use App\Model\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            "name" => "Administrador"
        ],[
            "name" => "Administrador",
            "guard_name" => "api"
        ]);
        Role::firstOrCreate([
            "name" => "Visistante"
        ],[
            "name" => "Visistante",
            "guard_name" => "api"
        ]);
        Role::firstOrCreate([
            "name" => "Construtora"
        ],[
            "name" => "Construtora",
            "guard_name" => "api"
        ]);
        Role::firstOrCreate([
            "name" => "Sindico"
        ],[
            "name" => "Sindico",
            "guard_name" => "api"
        ]);
    }
}
