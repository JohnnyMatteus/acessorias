<?php

namespace App\Domain\Repositories;

use App\Application\DTOs\ProductDTO;

interface ProductRepository
{
    public function getAll();
    public function findById($id);
    public function create(ProductDTO $productDTO);
    public function update($id, ProductDTO $productDTO);
    public function delete($id);
}
