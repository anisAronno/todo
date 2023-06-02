<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
                    $query->where('user_id', $this->user()->id)
                        ->whereNotIn('id', [$this->route('task')->id]); // Ignore current task ID
                }),
            ],
            'project_id' => 'required|exists:projects,id',        ];
    }
}
