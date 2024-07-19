<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(Product $product): void
    {
        $product->save();
    }

    public function findAll(Request $request): LengthAwarePaginator
    {
        $page = $request->input("page", 1);
        $size = $request->input("size", 10);

        $products = Product::query()->where("is_active", true);

        $products = $products->where(function (Builder $builder) use ($request) {
            $name = $request->input("name");
            if ($name) {
                $builder->where("name", 'like', '%' . $name . '%');
            }

            $price = $request->input("price");
            if ($price) {
                $builder->where("price", $price);
            }

            $lowPrice = $request->input("low-price");
            $maxPrice = $request->input("max-price");
            if (!is_null($lowPrice) && !is_null($maxPrice)) {
                $builder->whereBetween("price", [$lowPrice, $maxPrice]);
            } else if (!is_null($lowPrice) || !is_null($maxPrice)) {
                $builder->where(function (Builder $builder) use ($lowPrice, $maxPrice) {
                    if (!is_null($lowPrice)) {
                        $max = Product::query()->max("price");
                        $builder->whereBetween("price", [$lowPrice, $max]);
                    } else {
                        $builder->whereBetween("price", [0, $maxPrice]);
                    }
                });
            }
        });

        return $products
            ->with("categoryProduct")
            ->orderBy("created_at")->paginate(perPage: $size, page: $page);
    }

    public function findById(string $id): ?Product
    {
        return Product::query()->where("is_active", true)->find($id);
    }


    public function update(Product $product): Product
    {
        $product->exists = true;
        $product->save();

        return $product;
    }

    public function delete(Product $product): void
    {
        $product->exists = true;
        $product->delete();
    }
}
