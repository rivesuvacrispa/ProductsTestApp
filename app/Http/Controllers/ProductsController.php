<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\ProductListRequest;
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
     *          name="q", in="path", required=false,
     *          description="Подстрочный поиск по названию товара",
     *          @OA\Schema(type="string", default="", example="Яблоко")
     *     ),
     *     @OA\Parameter(
     *          name="price_from", in="path", required=false,
     *          description="Фильтрация по цене, нижняя граница",
     *          @OA\Schema(type="number", format="float", default=20, example=15.12)
     *     ),
     *     @OA\Parameter(
     *         name="price_to", in="path", required=false,
     *         description="Фильтрация по цене, верхняя граница",
     *         @OA\Schema(type="number", format="float", default=50, example=55.55)
     *    ),
     *     @OA\Parameter(
     *          name="category_id", in="path", required=false,
     *          description="Фильтрация по айди категории",
     *          @OA\Schema(type="int", example="1")
     *     ),
     *     @OA\Parameter(
     *          name="in_stock", in="path", required=false,
     *          description="Фильтрация по наличию",
     *          @OA\Schema(type="boolean", example="false")
     *     ),
     *     @OA\Parameter(
     *          name="rating_from", in="path", required=false,
     *          description="Фильтрация по рейтингу, нижняя граница",
     *          @OA\Schema(type="number", format="float", default="3", example=4.5)
     *     ),
     *     @OA\Parameter(
     *          name="sort", in="path", required=false,
     *          description="Подстрочный поиск по названию товара",
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
     *              @OA\Property(property="products", type="object", ref="#/components/schemas/Product"),
     *              @OA\Property(property="pagination_meta", type="int", example="10", ref="#/components/schemas/PaginationMeta"),
     *         )
     *     )
     * )
     */
    public function list(ProductListRequest $request)
    {
        $products = $this->productsService->getProducts();

        return response()->json($products->toResourceCollection());
    }
}
