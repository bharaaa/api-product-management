<?php

namespace App\Http\Resources;

use App\Models\CategoryProduct;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryProductResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name
        ];
    }

    public function toModel(){
        return new CategoryProduct([
            "id" => $this->id,
            "name" => $this->name
        ]);
    }
}
