<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => [
                'nullable',
                'integer',
                Rule::exists('categories', 'id')->where('user_id', auth()->user()->id)
            ],
            'from_date' => [
                'nullable',
                'date',
            ],
            'to_date' => [
                'nullable',
                'date',
                'after:from_date',
            ],
            'status' => [
                'nullable',
                'in:completed,incomplete',
            ],
        ];
    }
}
