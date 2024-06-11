<?php

namespace App\Application\Services;

use App\Domain\Repositories\UserRepository;
use App\Application\DTOs\UserDTO;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function create(UserDTO $userDTO)
    {
        return $this->userRepository->create($userDTO);
    }

    public function update($id, UserDTO $userDTO)
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            return null;
        }
        return $this->userRepository->update($id, $userDTO);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    public function authenticate($email, $password)
    {
        $authResult = $this->userRepository->login($email, $password);

        return (object) [
            'access_token' => $authResult,
            'status' => true
        ];
    }

    public function forgotPassword($email)
    {
        $user = $this->userRepository->findByEmail($email);

        return (object) [
            'valido' => ($user) ? true: false,
            'status' => true
        ];
    }
    public function updatePassword($mail, $password)
    {
        return $this->userRepository->updatePassword($mail, $password);
    }

    public function logOut($email)
    {
        return $this->userRepository->logOut($email);
    }
}
