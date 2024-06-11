<?php

namespace App\Application\Services;

use App\Application\DTOs\ProductDTO;
use App\Domain\Repositories\ProductRepository;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function getProductById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function createProduct(ProductDTO $productDTO)
    {
        return $this->productRepository->create($productDTO);
    }

    public function updateProduct($id, ProductDTO $productDTO)
    {
        return $this->productRepository->update($id, $productDTO);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id) ? true : false;
    }
}
