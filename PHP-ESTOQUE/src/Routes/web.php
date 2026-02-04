<?php

$router->map("GET", "/", "LoginController@index", "login");
$router->map("POST", "/logar", "LoginController@logar", "logar");
$router->map("GET", "/sair", "LoginController@sair", "logout");
$router->map("GET", "/registrar", "RegisterController@index", "cadastro");
$router->map("POST", "/registrar", "RegisterController@cadastrar", "cadastrar");

//ROTAS PROTEGIDAS

//DASHBOARD
$router->map("GET", "/dashboard", "DashboardController@index", "dashboard");
$router->map("GET", "/dashboard/cadastro-propriedade", "DashboardController@cadastroPropriedade", "cadastro-propriedade");
$router->map("GET", "/dashboard/cadastro-produto", "DashboardController@cadastroProduto", "cadastro-produto");
$router->map("GET", "/dashboard/atualizar-produtoForm/[i:produtoId]", "DashboardController@atualizarProdutoForm", "atualizar-produtoForm");
$router->map("GET", "/dashboard/produtos-excluidos", "DashboardController@produtosExcluidos", "produtos-excluidos");

//Cores
$router->map("POST", "/dashboard/cadastrar-cor", "CoresController@cadastrar", "cadastrar-cor");
$router->map("GET", "/dashboard/excluir-cor/[i:corId]", "CoresController@excluir", "excluir-cor");
$router->map("GET", "/dashboard/recuperar-cor/[i:corId]", "CoresController@recuperar", "recuperar-cor");

//Marcas
$router->map("POST", "/dashboard/cadastrar-marca", "MarcasController@cadastrar", "cadastrar-marca");
$router->map("GET", "/dashboard/excluir-marca/[i:marcaId]", "MarcasController@excluir", "excluir-marca");
$router->map("GET", "/dashboard/recuperar-marca/[i:marcaId]", "MarcasController@recuperar", "recuperar-marca");

//Tamanhos
$router->map("POST", "/dashboard/cadastrar-tamanho", "TamanhosController@cadastrar", "cadastrar-tamanho");
$router->map("GET", "/dashboard/excluir-tamanho/[i:tamanhoId]", "TamanhosController@excluir", "excluir-tamanho");
$router->map("GET", "/dashboard/recuperar-tamanho/[i:tamanhoId]", "TamanhosController@recuperar", "recuperar-tamanho");

//Categorias
$router->map("POST", "/dashboard/cadastrar-categoria", "CategoriasController@cadastrar", "cadastrar-categoria");
$router->map("GET", "/dashboard/excluir-categoria/[i:categoriaId]", "CategoriasController@excluir", "excluir-categoria");
$router->map("GET", "/dashboard/recuperar-categoria/[i:categoriaId]", "CategoriasController@recuperar", "recuperar-categoria");

//Gêneros
$router->map("POST", "/dashboard/cadastrar-genero", "GenerosController@cadastrar", "cadastrar-genero");
$router->map("GET", "/dashboard/excluir-genero/[i:generoId]", "GenerosController@excluir", "excluir-genero");
$router->map("GET", "/dashboard/recuperar-genero/[i:generoId]", "GenerosController@recuperar", "recuperar-genero");

//Segmentos
$router->map("POST", "/dashboard/cadastrar-segmento", "SegmentosController@cadastrar", "cadastrar-segmento");
$router->map("GET", "/dashboard/excluir-segmento/[i:segmentoId]", "SegmentosController@excluir", "excluir-segmento");
$router->map("GET", "/dashboard/recuperar-segmento/[i:segmentoId]", "SegmentosController@recuperar", "recuperar-segmento");

//Produtos
$router->map("POST", "/dashboard/cadastrar-produto", "ProdutosController@cadastrar", "cadastrar-produto");
$router->map("POST", "/dashboard/atualizar-produto", "ProdutosController@atualizarProduto", "atualizar-produto");
$router->map("GET", "/dashboard/deletar-produto/[i:produtoId]", "ProdutosController@deletarProduto", "deletar-produto");
$router->map("GET", "/dashboard/recuperar-produto/[i:produtoId]", "ProdutosController@recuperarProduto", "recuperar-produto");
