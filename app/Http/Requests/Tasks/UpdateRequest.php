<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'title' => ['string', 'max:255'],
            'description' => ['string'],
            'due_date' => ['date'],
            'category_id' => [Rule::exists('categories', 'id')->where('user_id', auth()->user()->id)],
            'completed_at' => ['nullable', 'date'],
        ];
    }
}
