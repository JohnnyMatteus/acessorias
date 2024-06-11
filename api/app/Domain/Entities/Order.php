<?php

namespace App\Domain\Entities;

class Order
{
    public $id;
    public $product_id;
    public $quantity;
    public $user_id;
    public $status;
    public $created_at;
    public $updated_at;
    public $product;
    public $user;
    public $userEmail;

    public function __construct($id, $product_id, $quantity, $user_id, $status, $created_at, $updated_at,
                                $product = null, $user = null, $userEmail = null)
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->user_id = $user_id;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->product = $product;
        $this->user = $user;
        $this->userEmail = $userEmail;
    }
}
