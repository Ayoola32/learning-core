<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ProfileSocialLinksUpdateRequest extends FormRequest
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
            'website' => ['nullable', 'string', 'url', 'max:255'],
            'facebook' => ['nullable', 'string', 'url', 'max:255'],
            'twitter' => ['nullable', 'string', 'url', 'max:255'],
            'github' => ['nullable', 'string', 'url', 'max:255'],
            'linkedin' => ['nullable', 'string', 'url', 'max:255'],
        ];
    }
}
