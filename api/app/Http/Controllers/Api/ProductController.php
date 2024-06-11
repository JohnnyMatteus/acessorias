<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Application\Services\ProductService;
use App\Application\DTOs\ProductDTO;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Helpers;


class ProductController extends Controller
{
    protected $productService;
    protected $code;
    protected $message;
    protected $return;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->code = 200;
        $this->message = "";
        $this->return = null;
    }

    public function index()
    {
        $this->return = ProductResource::collection($this->productService->getAllProducts());

        if (!$this->return) {
            $this->code = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar produtos";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    public function show($id)
    {
        $this->return = new ProductResource($this->productService->getProductById($id));

        if (!$this->return) {
            $this->code = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar produto";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $productDTO = new ProductDTO($data['name'], $data['description'], $data['price'], $data['stock']);
        $this->return = new ProductResource($this->productService->createProduct($productDTO));
        $this->code = 201;

        if (!$this->return) {
            $this->code = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao criar produto";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->validated();
        $productDTO = new ProductDTO($data['name'], $data['description'], $data['price'], $data['stock']);
        $this->return = new ProductResource($this->productService->updateProduct($id, $productDTO));

        if (!$this->return) {
            $this->code = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao atualizar produto";
        }

        return \Helpers::collection($this->return, $this->code, $this->message);
    }

    public function destroy($id)
    {
        $this->return = null;
        $this->code = $this->productService->deleteProduct($id) ? 204 : 500;

        return \Helpers::collection($this->return, $this->code, $this->message);
    }
}