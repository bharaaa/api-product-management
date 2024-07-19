<?php

namespace App\Repositories;

use App\Models\CategoryProduct;
use App\Repositories\Contracts\CategoryProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryProductRepository implements CategoryProductRepositoryInterface
{
    public function findAll(Request $request): LengthAwarePaginator
    {
        $page = $request->input("page", 1);
        $size = $request->input("size", 10);

        $categories = CategoryProduct::query()->where("is_active", true);

        $categories = $categories->where(function (Builder $builder) use ($request) {
            $name = $request->input("name");
            if ($name) {
                $builder->where("name", 'like', '%' . $name . '%');
            }
        });

        return $categories
            ->orderBy("created_at")->paginate(perPage: $size, page: $page);
    }

    public function findById(string $id): ?CategoryProduct
    {
        return CategoryProduct::query()->where("is_active", true)->find($id);
    }

    public function create(CategoryProduct $category): void
    {
        $category->save();
    }

    public function update(CategoryProduct $category): CategoryProduct
    {
        $category->exists = true;
        $category->save();

        return $category;
    }

    public function delete(CategoryProduct $category): void
    {
        $category->exists = true;
        $category->delete();
    }
}
