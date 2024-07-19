<?php

namespace App\Services\Impl;

use App\Exceptions\ServiceException;
use App\Http\Requests\CategoryProductRequest;
use App\Http\Resources\CategoryProductResource;
use App\Models\CategoryProduct;
use App\Repositories\CategoryProductRepositoryInterface;
use App\Services\CategoryProductServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class CategoryProductService implements CategoryProductServiceInterface
{
    use ApiResponse;
    private CategoryProductRepositoryInterface $categoryProductRepository;

    public function __construct(CategoryProductRepositoryInterface $categoryProductRepository)
    {
        $this->categoryProductRepository = $categoryProductRepository;
    }

    public function create(CategoryProductRequest $request): CategoryProductResource
    {
        $data = $request->validated();

        try{
            $category = new CategoryProduct($data);
            $this->categoryProductRepository->create($category);

            return new CategoryProductResource($category);
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function update(CategoryProductRequest $request): CategoryProductResource
    {
        $data = $request->validated();
        try{
            $category = $this->getById($data["id"]);
            $category= $category->toModel();

            if(isset($data["name"])){
                $category->name = $data["name"];
            }

            $this->categoryProductRepository->update($category);
            return new CategoryProductResource($category);
        }catch(ServiceException $e){
            throw $e;
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function delete(string $id): void
    {
        try{
            $category = $this->getById($id)->toModel();
            $category->is_active = false;

            $this->categoryProductRepository->update($category);
        }catch(ServiceException $e){
            throw $e;
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function getAll(Request $request): CategoryProductResource
    {
        try{
            $categories = $this->categoryProductRepository->findAll($request);
            return new CategoryProductResource($categories);
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }

    public function getById(string $id): CategoryProductResource
    {
        try{
            $category = $this->categoryProductRepository->findById($id);

            if(is_null($category)){
                throw new ServiceException("Category not found", 404);
            }

            return new CategoryProductResource($category);
        }catch(ServiceException $e){
            throw $e;
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage(), 500);
        }
    }
}