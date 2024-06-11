<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepository;
use App\Application\DTOs\UserDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Model\User as EloquentUser;

class EloquentUserRepository implements UserRepository
{
    public function getAll()
    {
        $users = DB::table('users')->get();
        return $users->map(function ($user) {
            return new User(
                $user->id,
                $user->name,
                $user->email,
                $user->password,
                $user->created_at,
                $user->updated_at
            );
        });
    }

    public function findById($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        if ($user) {
            return new User(
                $user->id,
                $user->name,
                $user->email,
                $user->password,
                $user->created_at,
                $user->updated_at
            );
        }
        return null;
    }

    public function create(UserDTO $userDTO)
    {
        $id = DB::table('users')->insertGetId([
            'name' => $userDTO->name,
            'email' => $userDTO->email,
            'password' => bcrypt($userDTO->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $this->findById($id);
    }

    public function update($id, UserDTO $userDTO)
    {
        DB::table('users')->where('id', $id)->update([
            'name' => $userDTO->name,
            'email' => $userDTO->email,
            'updated_at' => now(),
        ]);

        return $this->findById($id);
    }

    public function delete($id)
    {
        $user = $this->findById($id);

        if ($user) {
            DB::table('users')->where('id', $id)->delete();
            return true;
        }

        return false;
    }

    public function findByEmail($email)
    {
        $user = DB::table('users')->where('email', $email)->first();
        if ($user) {
            return new User(
                $user->id,
                $user->name,
                $user->email,
                $user->password,
                $user->created_at,
                $user->updated_at
            );
        }
        return null;
    }

    public function login($email, $password)
    {
        $user = DB::table('users')->where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            $eloquentUser = EloquentUser::find($user->id);
            return $eloquentUser->createToken('auth_token')->plainTextToken;
        }
        return null;
    }

    public function updatePassword($mail, $password)
    {
        $user = $this->findByEmail($mail);
        if($user) {
            DB::table('users')->where('id', $user->id)->update([
                'password' => bcrypt($password),
                'updated_at' => now(),
            ]);

            return $this->findById($user->id);
        }
        return null;
    }

    public function logOut($email)
    {
        $user = DB::table('users')->where('email', $email)->first();
        if ($user) {
            $eloquentUser = EloquentUser::find($user->id);
            return $eloquentUser->tokens()->delete();
        }
        return null;
    }
}
