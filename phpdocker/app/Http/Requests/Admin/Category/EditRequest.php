<?php

namespace App\Http\Requests\Admin\Category;

use App\Enums\News\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class EditRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return[
            'title' => ['required', 'string', 'min:3', 'max:150'],
            'status' => ['required', new Enum(Status::class)],
            'url' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
