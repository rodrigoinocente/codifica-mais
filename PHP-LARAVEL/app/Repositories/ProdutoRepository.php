<?php

namespace App\Repositories;

use App\Models\Produto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProdutoRepository
{
    public function all()
    {
        return Produto::latest()->get();
    }

    public function find($id): ?Produto
    {
        return Produto::find($id);
    }

    public function create(array $data): Produto
    {
        return Produto::create($data);
    }

    public function update(Produto $produto, array $data): Produto
    {
        $produto->update($data);

        return $produto;
    }

    public function delete(Produto $produto): void
    {
        $produto->delete();
    }
}
