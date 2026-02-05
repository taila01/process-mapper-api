<?php

namespace App\Http\Requests\Sector;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SectorUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('sectors')->ignore($this->sector),
            ],
            'description' => ['nullable', 'string'],
            'status' => ['sometimes', 'required', 'string', 'in:active,inactive'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do setor é obrigatório.',
            'name.string' => 'O nome do setor deve ser um texto.',
            'name.max' => 'O nome do setor não pode ter mais de 255 caracteres.',
            'name.unique' => 'Já existe um setor com este nome.',

            'status.in' => 'O status deve ser active ou inactive.',
        ];
    }
}
