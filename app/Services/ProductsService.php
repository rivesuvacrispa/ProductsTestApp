<?php

namespace App\Services;

use App\Enums\ProductSortEnum;
use Illuminate\Support\Collection;

class ProductsService
{
    public function __construct() {}

    /**
     *
     *
     * Фильтры (через query-параметры):
     *  q — поиск по подстроке в name
     *  price_from, price_to
     *  category_id
     *  in_stock (true/false)
     *  rating_from
     *
     * Сортировка:
     * параметр sort с допустимыми значениями: price_asc, price_desc, rating_desc, newest.
     *
     * @return void
     */
    public function getProducts(
        ?string $searchQuery = null,
        ?float $priceFrom = null,
        ?float $priceTo = null,
        ?int $categoryId = null,
        ?bool $inStock = null,
        ?float $ratingFrom = null,
        ProductSortEnum $sortType = ProductSortEnum::NEWEST,
    ) : Collection {

    }
}
