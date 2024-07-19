<?php

namespace App\Services\Contracts;

use App\Http\Requests\CategoryProductRequest;
use App\Http\Resources\CategoryProductCollection;
use App\Http\Resources\CategoryProductResource;
use Illuminate\Http\Request;

interface CategoryProductServiceInterface
{
    public function create(CategoryProductRequest $request): CategoryProductResource;
    public function getAll(Request $request): CategoryProductCollection;
    public function getById(string $id): CategoryProductResource;
    public function update(CategoryProductRequest $request): CategoryProductResource;
    public function delete(string $id): void;
}
