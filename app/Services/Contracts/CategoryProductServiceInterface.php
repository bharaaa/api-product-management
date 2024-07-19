<?php

namespace App\Services;

use App\Http\Requests\CategoryProductRequest;
use App\Http\Resources\CategoryProductResource;
use Illuminate\Http\Request;

interface CategoryProductServiceInterface
{
    public function create(CategoryProductRequest $request): CategoryProductResource;
    public function update(CategoryProductRequest $request): CategoryProductResource;
    public function delete(string $id): void;
    public function getAll(Request $request): CategoryProductResource;
    public function getById(string $id): CategoryProductResource;
}
