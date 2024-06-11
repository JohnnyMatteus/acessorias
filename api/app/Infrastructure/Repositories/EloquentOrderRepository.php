<?php

namespace App\Infrastructure\Repositories;

use App\Application\DTOs\OrderDTO;
use App\Domain\Entities\Order;
use App\Domain\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;

class EloquentOrderRepository implements OrderRepository
{
    public function getAll()
    {
        return DB::table('orders')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('products', 'orders.product_id', '=', 'products.id')
            ->select(
                'orders.id',
                'orders.product_id',
                'products.name as product',
                'orders.quantity',
                'orders.user_id',
                'users.name as user',
                'orders.status',
                'orders.created_at',
                'orders.updated_at'
            )
            ->get()
            ->map(function ($item) {
                return new Order(
                    $item->id,
                    $item->product_id,
                    $item->quantity,
                    $item->user_id,
                    $item->status,
                    $item->created_at,
                    $item->updated_at,
                    $item->product,
                    $item->user
                );
            });
    }

    public function findById($id)
    {
        // $item = DB::table('orders')->find($id);
        $item = DB::table('orders')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('products', 'orders.product_id', '=', 'products.id')
            ->select(
                'orders.id',
                'orders.product_id',
                'products.name as product',
                'orders.quantity',
                'orders.user_id',
                'users.name as user',
                'users.email as userEmail',
                'orders.status',
                'orders.created_at',
                'orders.updated_at'
            )
            ->where('orders.id', $id)
            ->first();

        if (!$item) {
            return null;
        }
        return new Order(
            $item->id,
            $item->product_id,
            $item->quantity,
            $item->user_id,
            $item->status,
            $item->created_at,
            $item->updated_at,
            $item->product,
            $item->user,
            $item->userEmail,
        );
    }

    public function create(OrderDTO $orderDTO)
    {
        $id = DB::table('orders')->insertGetId([
            'product_id' => $orderDTO->product_id,
            'quantity' => $orderDTO->quantity,
            'user_id' => $orderDTO->user_id,
            'status' => $orderDTO->status,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $this->findById($id);
    }

    public function update($id, OrderDTO $orderDTO)
    {
        DB::table('orders')->where('id', $id)->update([
            'product_id' => $orderDTO->product_id,
            'quantity' => $orderDTO->quantity,
            'user_id' => $orderDTO->user_id,
            'status' => $orderDTO->status,
            'updated_at' => now()
        ]);
        return $this->findById($id);
    }

    public function delete($id)
    {
        return DB::table('orders')->where('id', $id)->delete();
    }
}
