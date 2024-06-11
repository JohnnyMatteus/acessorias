<?php

namespace App\Application\DTOs;

class OrderDTO
{
    public $product_id;
    public $quantity;
    public $user_id;
    public $status;
    public $product;
    public $user;
    public $userEmail;

    public function __construct($product_id, $quantity, $user_id, $status, $product = null, $user = null, $userEmail = null)
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->user_id = $user_id;
        $this->status = $status;
        $this->product = $product;
        $this->user = $user;
        $this->userEmail = $userEmail;
    }
}
