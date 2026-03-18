<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Repositories\ProdutoRepository;

class ProdutoController extends Controller
{
    public function __construct(private ProdutoRepository $repository) {}

    public function index()
    {
        $produtos = $this->repository->all();

        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(ProdutoRequest $request)
    {
        $this->repository->create($request->except(['_token', '_method']));

        return to_route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso.');
    }

    public function show($id)
    {
        $produto = $this->repository->find($id);

        if (! $produto) {
            return redirect()->route('produtos.index')
                ->with('error', 'Produto não encontrado.');
        }

        return view('produtos.show', ['produto' => $produto]);
    }

    public function edit(int $id)
    {
        $produto = $this->repository->find($id);
        if (! $produto) {
            return redirect()->route('produtos.index')
                ->with('error', 'Produto não encontrado.');
        }

        return view('produtos.edit', ['produto' => $produto]);
    }

    public function update(ProdutoRequest $request, int $id)
    {
        $produto = $this->repository->find($id);
        if (! $produto) {
            return redirect()->route('produtos.index');
        }

        $this->repository->update($produto, $request->except(['_token', '_method']));

        return to_route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $produto = $this->repository->find($id);

        if (! $produto) {
            return to_route('produtos.index')
                ->with('error', 'Produto não encontrado.');
        }

        $this->repository->delete($produto);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto removido com sucesso.');
    }
}
