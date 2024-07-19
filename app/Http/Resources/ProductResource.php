<?php

namespace App\Http\Resources;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->resource["product"]->id,
            "category" => $this->resource["category"]->name,
            "name" => $this->resource["product"]->name,
            "price" => $this->resource["product"]->price,
            "image" => $this->resource["product"]->image,
        ];
    }

    public function toModel(CategoryProduct $categoryProduct){
        return new Product([
            "id" => $this->resource["product"]->id,
            "product_category_id" => $categoryProduct->id,
            "name" => $this->resource["product"]->name,
            "price" => $this->resource["product"]->price,
            "image" => $this->resource["product"]->image,
        ]);
    }
}
