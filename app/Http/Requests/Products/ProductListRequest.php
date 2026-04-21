<?php

namespace App\Http\Requests\Products;

use App\Enums\ProductSortEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductListRequest extends FormRequest
{
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
        return [
            'q' => ['nullable', 'string', 'max:255'],
            'price_from' => ['nullable', 'numeric', 'min:0'],
            'price_to' => ['nullable', 'numeric'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'in_stock' => ['nullable', 'boolean'],
            'rating_from' => ['nullable', 'numeric', 'min:0', 'max:5'],

            'sort' => ['string', 'nullable'],
        ];
    }

    public function q(): ?string
    {
        return $this->validated('q');
    }

    public function priceFrom(): ?float
    {
        return $this->validated('price_from');
    }

    public function priceTo(): ?float
    {
        return $this->validated('price_to');
    }

    public function categoryId(): ?int
    {
        return $this->validated('category_id');
    }

    public function inStock(): ?bool
    {
        return $this->validated('in_stock');
    }

    public function ratingFrom(): ?float
    {
        return $this->validated('rating_from');
    }

    public function sort(): ?ProductSortEnum
    {
        return ProductSortEnum::tryFrom($this->validated('sort'));
    }
}
