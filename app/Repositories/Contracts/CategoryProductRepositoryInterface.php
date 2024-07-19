<?php

namespace App\Repositories\Contracts;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryProductRepositoryInterface
{
    public function create(CategoryProduct $category): void;
    public function findAll(Request $request): LengthAwarePaginator;
    public function findById(string $id): ?CategoryProduct;
    public function update(CategoryProduct $category): CategoryProduct;
    public function delete(CategoryProduct $category): void;
}
