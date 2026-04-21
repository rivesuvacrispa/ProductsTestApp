<?php

namespace App\Http\Resources\Traits;

trait HasPagination
{
    /**
     * @param  array<string, mixed>  $paginated
     * @param  array<string, mixed>  $default
     * @return array<string, mixed>
     */
    public function paginationInformation($request, $paginated, $default): array
    {
        return [
            'pagination' => [
                'page' => $default['meta']['current_page'],
                'per_page' => $default['meta']['per_page'],
                'total' => $default['meta']['total'],
                'total_pages' => $default['meta']['last_page'],
            ],
        ];
    }
}