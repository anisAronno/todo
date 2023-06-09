<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'priority' => [
                'required',
                'integer',
                Rule::unique('tasks')->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                }),
            ],
            'project_id' => 'required|exists:projects,id',
        ];
    }
}
