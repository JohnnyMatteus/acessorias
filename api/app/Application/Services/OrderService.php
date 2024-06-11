<?php

namespace App\Application\Services;
namespace App\Application\Services;

use App\Application\DTOs\OrderDTO;
use App\Domain\Repositories\OrderRepository;
use App\Events\OrderRegistered;
use App\Mail\OrderConfirmationMail;

class OrderService
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAll();
    }

    public function getOrderById($id)
    {
        return $this->orderRepository->findById($id);
    }

    public function createOrder(OrderDTO $orderDTO)
    {
        $order = $this->orderRepository->create($orderDTO);

        $orderDTO->product_id = $order->id;
        $orderDTO->quantity = $order->quantity;
        $orderDTO->user_id = $order->user_id;
        $orderDTO->status = $order->status;
        $orderDTO->product = $order->product;
        $orderDTO->user = $order->user;
        $orderDTO->userEmail = $order->userEmail;

        event(new OrderRegistered($orderDTO));

        // $command = new OrderConfirmationMail($orderDTO);
        // dispatch($command);
        return $order;
    }

    public function updateOrder($id, OrderDTO $orderDTO)
    {
        return $this->orderRepository->update($id, $orderDTO);
    }

    public function deleteOrder($id)
    {
        return $this->orderRepository->delete($id) ? true : false;
    }
}
