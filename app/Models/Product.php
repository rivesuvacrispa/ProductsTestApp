<?php

namespace App\Models;

use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[UseResource(ProductResource::class)]
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'in_stock',
        'rating',
        'category_id',
    ];

    protected $casts = [
          'in_stock' => 'boolean'
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
