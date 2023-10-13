<?php

namespace App\Http\Requests\Admin\News;

use App\Enums\News\Status;
use App\Models\Category;
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
        $table_name_category = (new Category())->getTable();
        return [
            'title' => ['required', 'string', 'min:3', 'max:150'],
            'category_id' => ['required', 'integer', "exists:{$table_name_category},id"],
            'author' => ['required', 'string', 'min:3', 'max:100'],
            'status' => ['required', new Enum(Status::class)],
            'url' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
