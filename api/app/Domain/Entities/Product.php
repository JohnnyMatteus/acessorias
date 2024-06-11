<?php

namespace App\Domain\Entities;

class Product
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $created_at;
    public $updated_at;

    public function __construct($id, $name, $description, $price, $stock, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
