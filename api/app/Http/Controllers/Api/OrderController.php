<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Application\Services\OrderService;
use App\Application\DTOs\OrderDTO;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Helpers;

class OrderController extends Controller
{
    protected $orderService;
    protected $code;
    protected $message;
    protected $return;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
        $this->code = 200;
        $this->message = "";
        $this->return = null;
    }

    public function index()
    {
        $this->return = OrderResource::collection($this->orderService->getAllOrders());

        if (!$this->return) {
            $this->code = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar pedidos";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    public function show($id)
    {
        $this->return = new OrderResource($this->orderService->getOrderById($id));

        if (!$this->return) {
            $this->code = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar pedido";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        $orderDTO = new OrderDTO($data['product_id'], $data['quantity'], $data['user_id'], $data['status']);
        $this->return = new OrderResource($this->orderService->createOrder($orderDTO));
        $this->code = 201;

        if (!$this->return) {
            $this->code = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao criar pedido";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $data = $request->validated();
        $orderDTO = new OrderDTO($data['product_id'], $data['quantity'], $data['user_id'], $data['status']);
        $this->return = new OrderResource($this->orderService->updateOrder($id, $orderDTO));

        if (!$this->return) {
            $this->code = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao atualizar pedido";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    public function destroy($id)
    {
        $this->return = null;
        $this->code = $this->orderService->deleteOrder($id) ? 204 : 500;

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
}
