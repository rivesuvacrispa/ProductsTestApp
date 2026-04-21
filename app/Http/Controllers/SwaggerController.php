<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 *
 * @OA\Info(
 *     version="1.0",
 *     title="Products Test App API documentation",
 *     description="Документация к сервису поиска по товарам",
 *     @OA\Contact(
 *         email="vova.cpeda@yandex.ru",
 *         name="Vladimir Yagnaev"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000/api/v1/",
 *     description="local dev server"
 * )
 *
 * @OA\Schema(
 *     schema="ValidationError",
 *     @OA\Property(property="message", type="string", example="The *** field must be a ***. (and 1 more error)"),
 *     @OA\Property(property="errors", type="object", example={"field1": {"The *** field must be a ***."}, "field2": {"The *** field must be *** characters."}})
 * )
 *
 * @OA\Response(
 *     response="ValidationResponse",
 *     description="Ошибка валидации данных",
 *     @OA\JsonContent(ref="#/components/schemas/ValidationError")
 * )
 *
 * @OA\Schema(
 *     schema="NotFoundError",
 *     @OA\Property(property="message", type="string", example="The requested resource is not found or unavailable."),
 * )
 *
 * @OA\Response(
 *     response="NotFoundError",
 *     description="Сущность не найдена",
 *     @OA\JsonContent(ref="#/components/schemas/NotFoundError")
 * )
 *
 * @OA\Schema(
 *     schema="PaginationMeta",
 *     title="Пагинация",
 *     @OA\Property(property="page", type="integer", example=1),
 *     @OA\Property(property="per_page", type="integer", example=10),
 *     @OA\Property(property="total", type="integer", example=50),
 *     @OA\Property(property="total_pages", type="integer", example=5),
 * )
 *
 * @OA\Schema(
 *     schema="Product",
 *     title="Товар",
 *     @OA\Property(property="name", type="string", example="Товар 1"),
 * )
 *
 */
class SwaggerController extends Controller
{

}