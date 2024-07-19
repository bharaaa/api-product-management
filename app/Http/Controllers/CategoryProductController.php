<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryProductRequest;
use App\Services\Contracts\CategoryProductServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    use ApiResponse;

    private CategoryProductServiceInterface $categoryProductService;

    public function __construct(CategoryProductServiceInterface $categoryProductService)
    {
        $this->categoryProductService = $categoryProductService;
    }

    public function create(CategoryProductRequest $request): JsonResponse
    {
        try {
            $category = $this->categoryProductService->create($request);

            return $this->successResponse($category, "Successfully create category product", 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function getAll(Request $request): JsonResponse
    {
        try {
            $categories = $this->categoryProductService->getAll($request);

            return $this->successResponsePagination($categories, "Successfully get all category product", 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function getById(string $id): JsonResponse
    {
        try {
            $category = $this->categoryProductService->getById($id);

            return $this->successResponse($category, "Successfully get category product", 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
    public function update(CategoryProductRequest $request, string $id): JsonResponse
    {
        try {
            if ($request->id != $id) throw new \Exception("bad request", 400);

            $category = $this->categoryProductService->update($request);

            return $this->successResponse($category, "Successfully update category product", 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function delete(string $id): JsonResponse
    {
        try {
            $this->categoryProductService->delete($id);

            return $this->successResponse(true, "Successfully delete category product", 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
