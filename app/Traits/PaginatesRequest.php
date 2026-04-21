<?php

namespace App\Traits;

use Illuminate\Http\Concerns\InteractsWithInput;

trait PaginatesRequest
{
    use InteractsWithInput;

    public function paginationRules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function page(): int
    {
        return $this->input('page', 1);
    }

    public function perPage(): int
    {
        return $this->input('per_page', 10);
    }
}
