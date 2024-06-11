<?php

use App\Model\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Permissões de menu
         */
        Permission::firstOrCreate([
            "name" => "menu.create"
        ],[
            "name" => "menu.create",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "menu.edit"
        ],[
            "name" => "menu.edit",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "menu.delete"
        ],[
            "name" => "menu.delete",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "menu.view"
        ],[
            "name" => "menu.view",
            "guard_name" => "api"
        ]);
        /**
         * Permissões de usuarios
         */
        Permission::firstOrCreate([
            "name" => "usuario.create"
        ],[
            "name" => "usuario.create",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "usuario.edit"
        ],[
            "name" => "usuario.edit",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "usuario.delete"
        ],[
            "name" => "usuario.delete",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "usuario.view"
        ],[
            "name" => "usuario.view",
            "guard_name" => "api"
        ]);
        /**
         * Permissões de roles
         */
        Permission::firstOrCreate([
            "name" => "roles.create"
        ],[
            "name" => "roles.create",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "roles.edit"
        ],[
            "name" => "roles.edit",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "roles.delete"
        ],[
            "name" => "roles.delete",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "roles.view"
        ],[
            "name" => "roles.view",
            "guard_name" => "api"
        ]);
        /**
         * Permissões de Permission
         */
        Permission::firstOrCreate([
            "name" => "permission.create"
        ],[
            "name" => "permission.create",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "permission.edit"
        ],[
            "name" => "permission.edit",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "permission.delete"
        ],[
            "name" => "permission.delete",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "permission.view"
        ],[
            "name" => "permission.view",
            "guard_name" => "api"
        ]);
        /**
         * Permissões de paineis de controle
         */
        Permission::firstOrCreate([
            "name" => "painel.administrativo"
        ],[
            "name" => "painel.administrativo",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "painel.visitante"
        ],[
            "name" => "painel.visitante",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "painel.construtora"
        ],[
            "name" => "painel.construtora",
            "guard_name" => "api"
        ]);
        Permission::firstOrCreate([
            "name" => "painel.sindico"
        ],[
            "name" => "painel.sindico",
            "guard_name" => "api"
        ]);

        Permission::firstOrCreate([
            "name" => "public.read"
        ],[
            "name" => "public.read",
            "guard_name" => "api"
        ]);
    }
}
