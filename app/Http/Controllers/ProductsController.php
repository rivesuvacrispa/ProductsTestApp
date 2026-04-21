<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\ProductListRequest;
use App\Http\Resources\ProductResourceCollection;
use App\Services\ProductsService;
use OpenApi\Annotations as OA;


/**
 * @OA\Tag(
 *     name="Products",
 *     description="Работа с товарами"
 * )
 */
class ProductsController extends Controller
{
    public function __construct(private readonly ProductsService $productsService) {}

    /**
     * @OA\GET(
     *     path="/products/list",
     *     operationId="list-products",
     *     tags={"Products"},
     *     summary="Получение списка товаров с фильтрацией, сортировкой и пагинацией",
     *     @OA\Parameter(
     *          name="page", in="query", required=false,
     *          description="Номер страницы",
     *          @OA\Schema(type="int", default=1)
     *     ),
     *     @OA\Parameter(
     *          name="per_page", in="query", required=false,
     *          description="Кол-во сущностей на странице",
     *          @OA\Schema(type="int", default=10)
     *     ),
     *     @OA\Parameter(
     *          name="q", in="query", required=false,
     *          description="Подстрочный поиск по названию товара",
     *          @OA\Schema(type="string", default="", example="atque")
     *     ),
     *     @OA\Parameter(
     *          name="price_from", in="query", required=false,
     *          description="Фильтрация по цене, нижняя граница",
     *          @OA\Schema(type="number", format="float", default=20, example=15.12)
     *     ),
     *     @OA\Parameter(
     *         name="price_to", in="query", required=false,
     *         description="Фильтрация по цене, верхняя граница",
     *         @OA\Schema(type="number", format="float", default=50, example=55.55)
     *    ),
     *     @OA\Parameter(
     *          name="category_id", in="query", required=false,
     *          description="Фильтрация по айди категории",
     *          @OA\Schema(type="int", nullable=true, default=null)
     *     ),
     *     @OA\Parameter(
     *          name="in_stock", in="query", required=false,
     *          description="Фильтрация по наличию",
     *          @OA\Schema(type="bool")
     *     ),
     *     @OA\Parameter(
     *          name="rating_from", in="query", required=false,
     *          description="Фильтрация по рейтингу, нижняя граница",
     *          @OA\Schema(type="number", format="float", default=null)
     *     ),
     *     @OA\Parameter(
     *          name="sort", in="query", required=false,
     *          description="Сортировка",
     *          @OA\Schema(type="string", enum={"price_asc", "price_desc", "rating_desc", "newest"}, example="0")
     *     ),
     *     @OA\Response(
     *          response="422",
     *          ref="#/components/schemas/ValidationError"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Успех",
     *             @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="data", type="object", ref="#/components/schemas/Product"),
     *              @OA\Property(property="pagination", type="int", example="10", ref="#/components/schemas/PaginationMeta"),
     *         )
     *     )
     * )
     */
    public function list(ProductListRequest $request): ProductResourceCollection
    {
        $productsQuery = $this->productsService->queryProducts(
            $request->q(),
            $request->priceFrom(),
            $request->priceTo(),
            $request->categoryId(),
            $request->inStock(),
            $request->ratingFrom(),
            $request->sort()
        );

        $products = $productsQuery->paginate(perPage: $request->perPage(), page: $request->page());

        return new ProductResourceCollection($products);
    }
}
