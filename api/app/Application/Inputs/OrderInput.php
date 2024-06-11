<?php

namespace App\Application\Inputs;

class OrderInput
{
    public $product_id;
    public $quantity;
    public $user_id;
    public $status;

    public function __construct($product_id, $quantity, $user_id, $status)
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->user_id = $user_id;
        $this->status = $status;
    }
}
