<?php

namespace App\Http\Resources;

use App\Http\Resources\Traits\HasPagination;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductResourceCollection extends ResourceCollection
{
    use HasPagination;

    public $collects = ProductResource::class;
}