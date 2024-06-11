<?php

use App\Model\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
        User::firstOrCreate([
            "email" => "admin@manutencao.com"
        ],[
            'name' => 'Administrador', 
            'email' => 'admin@manutencao.com', 
            'password' => bcrypt("admin"), 
            'status' => 'A', 
            'id_empresa' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);
        /**
         * Construtora
         */
        User::firstOrCreate([
            "email" => "construtora@manutencao.com"
        ],[
            'name' => 'Construtora', 
            'email' => 'construtora@manutencao.com', 
            'password' => bcrypt("devomudar"), 
            'status' => 'A', 
            'id_empresa' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);
        /**
         * Síndico
         */
        User::firstOrCreate([
            "email" => "sindico@manutencao.com"
        ],[
            'name' => 'Sindico', 
            'email' => 'sindico@manutencao.com', 
            'password' => bcrypt("devomudar"), 
            'status' => 'A', 
            'id_empresa' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);
        /**
         * Visitante
         */
        User::firstOrCreate([
            "email" => "visitante@manutencao.com"
        ],[
            'name' => 'Visitante', 
            'email' => 'visitante@manutencao.com', 
            'password' => bcrypt("devomudar"), 
            'status' => 'A', 
            'id_empresa' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);
        
    }
}
