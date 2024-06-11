<?php

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
        $this->call([RolesSeeder::class,
            PermissionsSeeder::class,
            RoleHasPermissionSeeder::class,
            EmpresaSeeder::class,
            UsersSeeder::class,
            ModelHasRoleSeeder::class,
            ModelHasPermissionsSeeder::class])
             ;

    }
}
