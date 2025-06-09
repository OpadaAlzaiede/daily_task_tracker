<?php

namespace App\Http\Requests\RecurringTasks;

use App\Enums\RecurringTaskUnit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', Rule::exists('categories', 'id')->where('user_id', auth()->user()->id)],
            'frequency' => ['required', 'integer', 'min:1'],
            'frequency_unit' => ['required', Rule::in(array_column(RecurringTaskUnit::cases(), 'value'))],
            'start_date' => ['required', 'date', 'after:today'],
        ];
    }
}
