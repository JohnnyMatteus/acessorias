<?php

use App\Model\RoleHasPermission;
use Illuminate\Database\Seeder;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Grupo permissões administrador
         */
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 1
        ],[
            "role_id" => 1,
            "permission_id" => 1
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 2
        ],[
            "role_id" => 1,
            "permission_id" => 2
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 3
        ],[
            "role_id" => 1,
            "permission_id" => 3
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 4
        ],[
            "role_id" => 1,
            "permission_id" => 4
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 5
        ],[
            "role_id" => 1,
            "permission_id" => 5
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 6
        ],[
            "role_id" => 1,
            "permission_id" => 6
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 7
        ],[
            "role_id" => 1,
            "permission_id" => 7
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 8
        ],[
            "role_id" => 1,
            "permission_id" => 8
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 9
        ],[
            "role_id" => 1,
            "permission_id" => 9
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 10
        ],[
            "role_id" => 1,
            "permission_id" => 10
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 11
        ],[
            "role_id" => 1,
            "permission_id" => 11
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 12
        ],[
            "role_id" => 1,
            "permission_id" => 12
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 13
        ],[
            "role_id" => 1,
            "permission_id" => 13
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 14
        ],[
            "role_id" => 1,
            "permission_id" => 14
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 15
        ],[
            "role_id" => 1,
            "permission_id" => 15
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 16
        ],[
            "role_id" => 1,
            "permission_id" => 16
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 17
        ],[
            "role_id" => 1,
            "permission_id" => 17
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 18
        ],[
            "role_id" => 1,
            "permission_id" => 18
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 19
        ],[
            "role_id" => 1,
            "permission_id" => 19
        ]);
        RoleHasPermission::firstOrCreate([
            "role_id" => 1, "permission_id" => 20
        ],[
            "role_id" => 1,
            "permission_id" => 20
        ]);
    }
}
