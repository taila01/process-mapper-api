<?php

namespace App\Http\Requests\Process;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProcessesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'process_ids' => [
                'required',
                'array',
            ],
            'process_ids.*' => [
                'integer',
                'exists:processes,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'process_ids.required' => 'A lista de processos é obrigatória.',
            'process_ids.array' => 'Os processos devem ser enviados em formato de lista.',
            'process_ids.*.integer' => 'Cada processo deve ser um ID válido.',
            'process_ids.*.exists' => 'Um ou mais processos informados não existem.',
        ];
    }
}
