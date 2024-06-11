<?php

namespace App\Domain\ValueObjects\Users;

use InvalidArgumentException;

class Password
{
    private string $password;

    public function __construct(string $password)
    {
        if (strlen($password) < 8) {
            throw new InvalidArgumentException('Password must be at least 8 characters long');
        }
        $this->password = $password;
    }

    public function __toString(): string
    {
        return $this->password;
    }
}
