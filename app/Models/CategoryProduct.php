<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $table = "m_category_product";
    protected $primaryKey = "id";
    protected $keyType = "uuid";
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        "id",
        "name"
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, "product_category_id", "id");
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function(CategoryProduct $model){
            if(empty($model->{$model->getKeyName()})){
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
