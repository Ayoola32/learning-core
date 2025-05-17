<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CourseBasicInfoCreateRequest extends FormRequest
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
            'title' => ['required','string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'demo_video_storage' => ['nullable', 'string', 'in:upload,vimeo,youtube,external_link'],
            'file' => ['required_if:demo_video_storage,upload', 'nullable', 'string', 'max:255'],
            'url' => ['required_if:demo_video_storage,youtube,vimeo,external_link', 'nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', '
            min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'description' => ['required', 'string'],
            'thumbnail' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
}
