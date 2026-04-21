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
 *
 */
class SwaggerController extends Controller
{

}