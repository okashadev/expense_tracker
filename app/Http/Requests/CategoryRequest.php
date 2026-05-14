<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),
            ],
            'icon' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter a category name.',
            'name.unique'   => 'You already have a category with this name.',
            'icon.required' => 'Please select an icon.',
        ];
    }

    /**
     * Normalize name before validation (Food = food)
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'name' => strtolower(trim($this->name)),
        ]);
    }
}
