<?php

namespace App\Http\Requests\Process;

use Illuminate\Foundation\Http\FormRequest;

class ProcessUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'sometimes',
                'nullable',
                'string',
            ],
            'sector_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:sectors,id',
            ],
            'parent_id' => [
                'sometimes',
                'nullable',
                'integer',
                'exists:processes,id',
            ],
            'type' => [
                'sometimes',
                'required',
                'string',
                'in:root,subprocess',
            ],
            'status' => [
                'sometimes',
                'required',
                'string',
                'in:active,inactive',
            ],

            'details' => [
                'sometimes',
                'nullable',
                'array',
            ],
            'details.tools' => [
                'nullable',
                'string',
            ],
            'details.responsibles' => [
                'nullable',
                'string',
            ],
            'details.documentation' => [
                'nullable',
                'string',
            ],
        ];
    }

    /**
     * Custom messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome do processo é obrigatório.',
            'name.string' => 'O nome do processo deve ser um texto.',

            'sector_id.required' => 'O setor é obrigatório.',
            'sector_id.exists' => 'O setor informado não existe.',

            'parent_id.exists' => 'O processo pai informado não existe.',

            'type.in' => 'O tipo do processo deve ser root ou subprocess.',
            'status.in' => 'O status deve ser active ou inactive.',
        ];
    }
}
