<?php

namespace App\Application\Inputs;

class ProductInput
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
