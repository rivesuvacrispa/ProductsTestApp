<?php

namespace App\Http\Requests\Products;

use App\Enums\ProductSortEnum;
use App\Traits\PaginatesRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductListRequest extends FormRequest
{
    use PaginatesRequest;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'q' => ['nullable', 'string', 'max:255'],
            'price_from' => ['nullable', 'numeric', 'min:0'],
            'price_to' => ['nullable', 'numeric'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'in_stock' => ['nullable', 'boolean'],
            'rating_from' => ['nullable', 'numeric', 'min:0', 'max:5'],

            'sort' => ['string', 'nullable'],
        ];

        return array_merge($this->paginationRules(), $rules);
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('in_stock')) {
            $this->merge([
                'in_stock' => filter_var($this->in_stock, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            ]);
        }
    }

    public function q(): ?string
    {
        return $this->input('q');
    }

    public function priceFrom(): ?float
    {
        return $this->input('price_from');
    }

    public function priceTo(): ?float
    {
        return $this->input('price_to');
    }

    public function categoryId(): ?int
    {
        return $this->input('category_id');
    }

    public function inStock(): ?bool
    {
        return $this->input('in_stock');
    }

    public function ratingFrom(): ?float
    {
        return $this->input('rating_from');
    }

    public function sort(): ?ProductSortEnum
    {
        return ProductSortEnum::tryFrom($this->input('sort'));
    }
}
