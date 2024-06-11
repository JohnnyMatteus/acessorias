<?php

namespace App\Infrastructure\Repositories;

use App\Application\DTOs\ProductDTO;
use App\Domain\Entities\Product;
use App\Domain\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;

class EloquentProductRepository implements ProductRepository
{
    public function getAll()
    {
        return DB::table('products')->get()->map(function ($item) {
            return new Product(
                $item->id,
                $item->name,
                $item->description,
                $item->price,
                $item->stock,
                $item->created_at,
                $item->updated_at);
        });
    }

    public function findById($id)
    {
        $item = DB::table('products')->find($id);

        if (!$item) {
            return null;
        }
        return new Product($item->id,
            $item->name,
            $item->description,
            $item->price,
            $item->stock,
            $item->created_at,
            $item->updated_at);
    }

    public function create(ProductDTO $productDTO)
    {
        $id = DB::table('products')->insertGetId([
            'name' => $productDTO->name,
            'description' => $productDTO->description,
            'price' => $productDTO->price,
            'stock' => $productDTO->stock,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $this->findById($id);
    }

    public function update($id, ProductDTO $productDTO)
    {
        DB::table('products')->where('id', $id)->update([
            'name' => $productDTO->name,
            'description' => $productDTO->description,
            'price' => $productDTO->price,
            'stock' => $productDTO->stock,
            'updated_at' => now()
        ]);
        return $this->findById($id);
    }

    public function delete($id)
    {
        return DB::table('products')->where('id', $id)->delete();
    }
}
