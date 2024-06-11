<?php

namespace App\Domain\Repositories;

use App\Application\DTOs\UserDTO;

interface UserRepository
{
    public function getAll();
    public function findById($id);
    public function findByEmail($email);
    public function create(UserDTO $userDTO);
    public function update($id, UserDTO $userDTO);
    public function delete($id);
    public function login($email, $password);
    public function updatePassword($mail, $password);
    public function logOut($email);

}
