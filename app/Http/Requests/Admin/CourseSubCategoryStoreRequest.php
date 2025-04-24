<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CourseSubCategoryStoreRequest extends FormRequest
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
            'image' => ['nullable', 'image', 'mimes:png,jpeg,jpg,webp', 'max:3000'],
            'name' => ['required', 'string', 'max:255', 'unique:course_sub_categories,name,'],
            'icon' => ['required',  'string', 'max:50'],
            'status' => ['required', 'boolean'],
            'show_at_trending' => ['required', 'boolean'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->has('status') ? 1 : 0,
            'show_at_trending' => $this->has('show_at_trending') ? 1 : 0,
        ]);
    }
}
