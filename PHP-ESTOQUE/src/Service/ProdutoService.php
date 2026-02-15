<?php

namespace App\Service;

use App\Models\Produtos;
use App\Repositories\CategoriasRepository;
use App\Repositories\CoresRepository;
use App\Repositories\GenerosRepository;
use App\Repositories\MarcasRepository;
use App\Repositories\ProdutosRepository;
use App\Repositories\SegmentosRepository;
use App\Repositories\TamanhosRepository;
use DomainException;

class ProdutoService
{
  private ProdutosRepository $repoProduto;
  private CategoriasRepository $repoCategorias;
  private MarcasRepository $repoMarcas;
  private CoresRepository $repoCores;
  private TamanhosRepository $repoTamanhos;
  private GenerosRepository $repoGenero;
  private SegmentosRepository $repoSegmentos;
  public function __construct() {
    $this->repoCategorias = new CategoriasRepository();
    $this->repoMarcas = new MarcasRepository();
    $this->repoCores = new CoresRepository();
    $this->repoTamanhos = new TamanhosRepository();
    $this->repoGenero = new GenerosRepository();
    $this->repoSegmentos = new SegmentosRepository();
    $this->repoProduto = new ProdutosRepository();
  }

  public function verificarDominioPropriedades(Produtos $produto, int $usuarioId): array
  {
    $categoria = $this->repoCategorias->existeIdCategoria($produto->categoria_id, $usuarioId);
    $marca = $this->repoMarcas->existeIdMarca($produto->marca_id, $usuarioId);
    $cor = $this->repoCores->existeIdCor($produto->cor_id,$usuarioId);
    $tamanho = $this->repoTamanhos->existeIdTamanho($produto->tamanho_id, $usuarioId);
    $genero = $this->repoGenero->existeIdGenero($produto->genero_id, $usuarioId);
    $segmentos = $this->repoSegmentos->existeIdSegmento($produto->segmento_id, $usuarioId);

    if (!$categoria || !$marca || !$cor || !$tamanho || !$genero || !$segmentos) {
      return ['erro' => true, 'mensagem' => 'Tivemos erros ao tentar localizar as propriedades.'];
    }

    return ['erro' => false, 'mensagem' => null];
  }

  public function verificarDominioProduto(int $produtoId, int $usuarioId): array
  {
    $produto = $this->repoProduto->buscarPorId($produtoId, $usuarioId);
    if (!$produto) {
      return ['erro' => true, 'mensagem' => 'Produto não localizado.'];
    }

    return ['erro' => false, 'mensagem' => null];
  }

    public function getPropriedadesDisponiveis($usuarioId): array
    {
      $categorias = $this->repoCategorias->buscarTodasPorUsuario($usuarioId);
      $marcas = $this->repoMarcas->buscarTodasPorUsuario($usuarioId);

      if (empty($marcas) || empty($categorias)) {
        return ['erro' => true, 'mensagem' => 'Para realizar um cadastro, é necessário ter pelo menos uma categoria
         e uma marca registradas. Acesse Propriedades e faça o registro.'];
      }

      $cores = $this->repoCores->buscarTodasPorUsuario($usuarioId);
      $generos = $this->repoGenero->buscarTodasPorUsuario($usuarioId);
      $segmentos = $this->repoSegmentos->buscarTodasPorUsuario($usuarioId);
      $tamanhos = $this->repoTamanhos->buscarTodasPorUsuario($usuarioId);

      if (empty($cores) || empty($tamanhos) || empty($generos) || empty($segmentos)) {
        return ['erro' => true, 'mensagem' => 'Alguns dados essenciais (Cores, Tamanhos, Gêneros ou Segmentos) não foram localizados.'];
      }

      $tamanhosNumericos = [];
      $tamanhosLetras = [];
      foreach ($tamanhos as $tamanho) {
        if (is_numeric($tamanho['nome'])) {
          $tamanhosNumericos[] = $tamanho;
        } else {
          $tamanhosLetras[] = $tamanho;
        }
      }

      return compact(
        'categorias',
        'marcas',
        'cores',
        'tamanhosNumericos',
        'tamanhosLetras',
        'tamanhos',
        'generos',
        'segmentos'
      );
    }

  public function getTodasPropriedades($usuarioId): array
  {
    $categorias = $this->repoCategorias->getTodasPorUsuario($usuarioId);
    $marcas = $this->repoMarcas->getTodasPorUsuario($usuarioId);
    $cores = $this->repoCores->getTodasPorUsuario($usuarioId);
    $tamanhos = $this->repoTamanhos->getTodasPorUsuario($usuarioId);
    $generos = $this->repoGenero->getTodasPorUsuario($usuarioId);
    $segmentos = $this->repoSegmentos->getTodasPorUsuario($usuarioId);
    if (empty($cores) || empty($tamanhos) || empty($generos) || empty($segmentos)) {
      return ['erro' => true, 'mensagem' => 'Alguns dados essenciais (Cores, Tamanhos, Gêneros ou Segmentos) não foram localizados.'];
    }
  
    return compact('categorias', 'marcas', 'cores', 'tamanhos', 'generos', 'segmentos');
  }

    public function validarPropriedades(Produtos $produto, int $usuarioId): array
    {
        $repoCategoria = new CategoriasRepository();
        if (!$repoCategoria->existeIdCategoria($produto->categoria_id, $usuarioId)) {
            return ['erro' => true, 'mensagem' => 'Categoria não localizada.'];
        }

        $repoMarca = new MarcasRepository();
        if (!$repoMarca->existeIdMarca($produto->marca_id, $usuarioId)) {
            return ['erro' => true, 'mensagem' => 'Marca não localizada.'];
        }

        $repoCor = new CoresRepository();
        if (!$repoCor->existeIdCor($produto->cor_id, $usuarioId)) {
            return ['erro' => true, 'mensagem' => 'Cor não localizada.'];
        }

        $repoTamanho = new TamanhosRepository();
        if (!$repoTamanho->existeIdTamanho($produto->tamanho_id, $usuarioId)) {
            return ['erro' => true, 'mensagem' => 'Tamanho não localizado.'];
        }

        $repoGenero = new GenerosRepository();
        if (!$repoGenero->existeIdGenero($produto->genero_id, $usuarioId)) {
            return ['erro' => true, 'mensagem' => 'Gênero não localizado.'];
        }

        $repoSegmento = new SegmentosRepository();
        if (!$repoSegmento->existeIdSegmento($produto->segmento_id, $usuarioId)) {
            return ['erro' => true, 'mensagem' => 'Segmento não localizado.'];
        }

        return ['erro' => false, 'mensagem' => null];
    }
}
