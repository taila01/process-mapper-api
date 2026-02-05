<?php

namespace App\Http\Requests\Process;

use Illuminate\Foundation\Http\FormRequest;

class ProcessDetailsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->status ?? 'active',
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'sector_id' => [
                'required',
                'integer',
                'exists:sectors,id',
            ],
            'parent_id' => [
                'nullable',
                'integer',
                'exists:processes,id',
            ],
            'type' => [
                'required',
                'string',
                'in:root,subprocess',
            ],
            'status' => [
                'required',
                'string',
                'in:active,inactive',
            ],

            // DETAILS
            'details' => [
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
                // se quiser validar URL, troca por 'url'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do processo é obrigatório.',
            'name.string' => 'O nome do processo deve ser um texto.',
            'name.max' => 'O nome do processo não pode ter mais de 255 caracteres.',

            'sector_id.required' => 'O setor é obrigatório.',
            'sector_id.integer' => 'O setor deve ser um ID válido.',
            'sector_id.exists' => 'O setor informado não existe.',

            'parent_id.integer' => 'O processo pai deve ser um ID válido.',
            'parent_id.exists' => 'O processo pai informado não existe.',

            'type.required' => 'O tipo do processo é obrigatório.',
            'type.in' => 'O tipo do processo deve ser root ou subprocess.',

            'status.required' => 'O status do processo é obrigatório.',
            'status.in' => 'O status deve ser active ou inactive.',
        ];
    }
}
