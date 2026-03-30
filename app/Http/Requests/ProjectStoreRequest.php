<?php

namespace App\Http\Requests;

use App\Enums\ProjectStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ProjectStoreRequest extends FormRequest
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
            'title'       => 'required|string|max:255',
            'tagline'     => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'tech'        => 'nullable|string',
            'link'        => 'nullable|url',
            'category'    => 'nullable|string|max:100',
            'status'      => ['required', new Enum(ProjectStatus::class)],
            'progress'    => 'nullable|integer|min:0|max:100',
            'launch_date' => 'nullable|date',
            'image'       => 'nullable|image|max:2048',
            'featured'    => 'nullable|boolean',
        ];
    }
}

