<?php

$router->map("GET", "/", "LoginController@index", "login");
$router->map("POST", "/logar", "LoginController@logar", "logar");
$router->map("GET", "/sair", "LoginController@sair", "logout");
$router->map("GET", "/registrar", "RegisterController@index", "cadastro");
$router->map("POST", "/registrar", "RegisterController@cadastrar", "cadastrar");

//ROTAS PROTEGIDAS
$router->map("GET", "/dashboard", "DashboardController@index", "dashboard");
