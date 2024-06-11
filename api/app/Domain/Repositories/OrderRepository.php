<?php

namespace App\Domain\Repositories;

use App\Application\DTOs\OrderDTO;

interface OrderRepository
{
    public function getAll();
    public function findById($id);
    public function create(OrderDTO $productDTO);
    public function update($id, OrderDTO $productDTO);
    public function delete($id);
}
