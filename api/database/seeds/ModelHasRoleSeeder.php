<?php

use App\Model\ModelHasRole;
use Illuminate\Database\Seeder;

class ModelHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Administrador
         */
        ModelHasRole::firstOrCreate([
            "model_id" => 1, "role_id" => 1
        ],[
            "model_id" => 1,
            "role_id" => 1,
            "model_type" => 'App\Model\User'
        ]);
        /**
         * Construtora
         */
        ModelHasRole::firstOrCreate([
            "model_id" => 2, "role_id" => 3
        ],[
            "model_id" => 1,
            "role_id" => 1,
            "model_type" => 'App\Model\User'
        ]);
        /**
         * Visitante
         */
        ModelHasRole::firstOrCreate([
            "model_id" => 4, "role_id" => 2
        ],[
            "model_id" => 1,
            "role_id" => 1,
            "model_type" => 'App\Model\User'
        ]);
        /**
         * Sindico
         */
        ModelHasRole::firstOrCreate([
            "model_id" => 3, "role_id" => 3
        ],[
            "model_id" => 1,
            "role_id" => 1,
            "model_type" => 'App\Model\User'
        ]);        
    }
}
