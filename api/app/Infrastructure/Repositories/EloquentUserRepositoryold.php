<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\User as DomainUser;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\ValueObjects\Users\Email;
use App\Domain\ValueObjects\Users\Name;
use App\Domain\ValueObjects\Users\Password;
use App\Model\User as EloquentUser;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepositoryold implements UserRepositoryInterface
{
    public function save(DomainUser $user): void
    {
        $eloquentUser = new EloquentUser();
        $eloquentUser->name = (string) $user->getName();
        $eloquentUser->email = (string) $user->getEmail();
        $eloquentUser->password = Hash::make((string) $user->getPassword());
        $eloquentUser->save();
    }

    public function findByEmail(string $email): ?DomainUser
    {
        $userModel = EloquentUser::where('email', $email)->first();

        return new DomainUser(
            new Name($userModel->name),
            new Email($userModel->email),
            new Password($userModel->password)
        );
    }

    public function getToken(DomainUser $user): string
    {
        $userModel = EloquentUser::where('email', $user->getEmail())->first();
        return $userModel->createToken('auth_token')->plainTextToken;
    }

    public function login(string $email, string $password): ?DomainUser
    {
        $userModel = EloquentUser::where('email', $email)->first();
        if ($userModel && Hash::check($password, $userModel->password)) {
            return new DomainUser(
                new Name($userModel->name),
                new Email($userModel->email),
                new Password($userModel->password)
            );
        } else {
            return null;
        }
    }

    public function update(DomainUser $user): bool
    {
        $eloquentUser = EloquentUser::where('email', $user->getEmail())->first();

        $eloquentUser->name = (string) $user->getName();
        $eloquentUser->email = (string) $user->getEmail();
        $eloquentUser->password = Hash::make((string) $user->getPassword());

        return $eloquentUser->save();
    }

    public function deleteToken(string $email): bool
    {
        $eloquentUser = EloquentUser::where('email', $email)->first();

        return $eloquentUser->tokens()->delete();
    }
}