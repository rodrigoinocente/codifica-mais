<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255', 'min:3'],
            'descricao' => ['nullable', 'string', 'min:3'],
            'preco' => ['required', 'numeric', 'min:0.01'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.string' => 'O nome não pode ser números.',
            'nome.max' => 'O nome não pode ter mais de :max caracteres.',
            'nome.min' => 'O nome deve ter pelo menos :min caracteres.',
            'descricao.string' => 'A descrição não pode ser números.',
            'descricao.min' => 'A descrição deve ter pelo menos :min caracteres.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.numeric' => 'O preço deve ser um número.',
            'preco.min' => 'O preço deve ser pelo menos R$ 0,01.',
        ];
    }
}
