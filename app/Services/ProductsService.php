<?php

namespace App\Services;

use App\Enums\ProductSortEnum;
use App\Models\Product;
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
        ?ProductSortEnum $sortType = ProductSortEnum::NEWEST,
    ): Collection
    {
        $query = Product::query();

        if ($searchQuery)
        {
            $query->whereLike('name', "%$searchQuery%");
        }

        if (!is_null($priceFrom))
        {
            $query->where('price', '>=', $priceFrom);
        }

        if (!is_null($priceTo))
        {
            $query->where('price', '<=', $priceTo);
        }

        if (!is_null($categoryId))
        {
            $query->where('category_id', $categoryId);
        }

        if (!is_null($inStock))
        {
            $query->where('in_stock', $inStock);
        }

        if (!is_null($ratingFrom))
        {
            $query->where('rating', '>=', $ratingFrom);
        }

        if ($sortType)
        {
            match ($sortType)
            {
                ProductSortEnum::PRICE_ASC => $query->orderBy('price'),
                ProductSortEnum::PRICE_DESC => $query->orderBy('price', 'desc'),
                ProductSortEnum::RATING_DESC => $query->orderBy('rating', 'desc'),
                ProductSortEnum::NEWEST => $query->orderBy('created_at', 'desc')->orderBy('id', 'desc'),
            };
        }

        return $query->get();
    }
}
