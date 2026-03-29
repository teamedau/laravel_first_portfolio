<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
            'description' => 'nullable|string',
            'tagline'     => 'nullable|string|max:255',
            'tech'        => 'nullable|string',
            'status'      => 'nullable|string',
            'progress'    => 'nullable|integer|min:0|max:100',
            'image'       => 'nullable|image|max:2048',
            'github_url'  => 'nullable|url',
            'live_url'    => 'nullable|url',
            'featured'    => 'nullable|boolean',
        ];
    }
}
