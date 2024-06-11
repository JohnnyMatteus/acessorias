<?php

namespace App\Domain\ValueObjects\Users;

use InvalidArgumentException;

class Name
{
    private string $name;

    public function __construct(string $name)
    {
        if (empty($name) || strlen($name) > 255) {
            throw new InvalidArgumentException('Invalid name');
        }
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
