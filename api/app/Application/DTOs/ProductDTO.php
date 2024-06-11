<?php

namespace App\Application\DTOs;

class ProductDTO
{
    public $name;
    public $description;
    public $price;
    public $stock;

    public function __construct($name, $description, $price, $stock)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
    }
}
