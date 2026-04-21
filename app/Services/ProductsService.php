<?php

namespace App\Services;

use App\Enums\ProductSortEnum;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductsService
{
    public function __construct() {}

    /**
     * Получение запроса товаров с доступными фильтрами и видом сортировки
     *
     * @param string|null $searchQuery - Подстрочный поиск по названию товара
     * @param float|null $priceFrom - Фильтрация по цене, нижняя граница
     * @param float|null $priceTo - Фильтрация по цене, верхняя граница
     * @param int|null $categoryId - Фильтрация по айди категории
     * @param bool|null $inStock - Фильтрация по наличию
     * @param float|null $ratingFrom - Фильтрация по рейтингу, нижняя граница
     * @param ProductSortEnum|null $sortType - тип сортировки
     * @return Builder
     */
    public function queryProducts(
        ?string $searchQuery = null,
        ?float $priceFrom = null,
        ?float $priceTo = null,
        ?int $categoryId = null,
        ?bool $inStock = null,
        ?float $ratingFrom = null,
        ?ProductSortEnum $sortType = ProductSortEnum::NEWEST,
    ): Builder
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

        return $query;
    }
}
