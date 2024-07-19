<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Contracts\CategoryProductServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductService implements ProductServiceInterface
{
    use ApiResponse;
    private ProductRepositoryInterface $productRepository;
    private CategoryProductServiceInterface $categoryService;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryProductServiceInterface $categoryService,
    ) {
        $this->productRepository = $productRepository;
        $this->categoryService = $categoryService;
    }

    public function create(ProductRequest $request): ProductResource
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $product = new Product([
                "product_category_id" => $data["productCategoryId"],
                "name" => $data["name"],
                "price" => $data["price"],
                "image" => $data["image"],
            ]);

            $this->productRepository->create($product);
            $category = $this->categoryService->getById($product->product_category_id);
            DB::commit();

            return new ProductResource([
                "product" => $product,
                "category" => $category
            ]);
        } catch (ServiceException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function getAll(Request $request): ProductCollection
    {
        try {
            $products = $this->productRepository->findAll($request);
            return new ProductCollection($products);
        } catch (\Exception $e) {
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function getById(string $id): ProductResource
    {
        try {
            $product = $this->productRepository->findById($id);
            if (is_null($product)) {
                throw new ServiceException("Product not found", 404);
            }

            $category = $this->categoryService->getById($product->product_category_id);


            return new ProductResource([
                "product" => $product,
                "category" => $category
            ]);
        } catch (ServiceException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new ServiceException($e->getMessage(), 500);
        }
    }
    public function update(ProductUpdateRequest $request): ProductResource
    {
        $data = $request->validated();

        try {
            $product = $this->getById($data["id"]);
            $categoryProduct = $this->categoryService->getById($data["productCategoryId"])->toModel();
            $product = $product->toModel($categoryProduct);

            if (isset($data["name"])) {
                $product->name = $data["name"];
            }
            if (isset($data["price"])) {
                $product->price = $data["price"];
            }
            if (isset($data["product_category_id"])) {
                $product->product_category_id = $data["productCategoryId"];
            }

            if (isset($data["image"])) {
                $product->image = $data["image"];
            }

            $this->productRepository->update($product);
            return new ProductResource(
                [
                    "product" => $product,
                    "category" => $categoryProduct
                ]
            );
        } catch (ServiceException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function delete(string $id): void
    {
        try {
            $product = $this->productRepository->findById($id);
            if (is_null($product)) {
                throw new ServiceException("Product not found", 404);
            }

            $product->is_active = false;

            $this->productRepository->update($product);
        } catch (ServiceException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new ServiceException($e->getMessage(), 500);
        }
    }
}
