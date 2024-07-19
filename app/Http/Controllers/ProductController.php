<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Services\Contracts\ProductServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class ProductController extends Controller
{
    use ApiResponse;

    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function create(ProductRequest $request): JsonResponse
    {
        try {
            $product = $this->productService->create($request);
            return $this->successResponse($product, "Successfully created product", 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function getAll(Request $request): JsonResponse
    {
        try {
            $products = $this->productService->getAll($request);
            return $this->successResponsePagination($products, "Successfully get all product", 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function getById(string $id): JsonResponse
    {
        try {
            $product = $this->productService->getById($id);

            return $this->successResponse($product, "Successfully get product", 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function update(ProductUpdateRequest $request, string $id): JsonResponse
    {
        try {
            if ($request->id != $id) {
                throw new Exception("bad request", 400);
            }

            $product = $this->productService->update($request);

            return $this->successResponse($product, "Successfully updated product", 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }


    public function delete(string $id): JsonResponse
    {
        try {
            $this->productService->delete($id);

            return $this->successResponse(true, "Successfully delete product", 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
