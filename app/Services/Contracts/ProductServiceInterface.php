<?php

namespace App\Services\Contracts;

use App\Http\Requests\ProductCreateReq;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateReq;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

interface ProductServiceInterface
{
    public function create(ProductRequest $request): ProductResource;
    public function getAll(Request $request): ProductCollection;
    public function getById(string $id): ProductResource;
    public function update(ProductUpdateRequest $request): ProductResource;
    public function delete(string $id): void;
}