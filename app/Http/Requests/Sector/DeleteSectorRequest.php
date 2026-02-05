<?php

namespace App\Http\Requests\Sector;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSectorsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sector_ids' => ['required', 'array'],
            'sector_ids.*' => ['integer', 'exists:sectors,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'sector_ids.required' => 'A lista de setores é obrigatória.',
            'sector_ids.array' => 'Os setores devem ser enviados em formato de lista.',
            'sector_ids.*.integer' => 'Cada setor deve ser um ID válido.',
            'sector_ids.*.exists' => 'Um ou mais setores informados não existem.',
        ];
    }
}
