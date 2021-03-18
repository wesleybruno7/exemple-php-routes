<?php 

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

/* CONTROLLERS */
$router->namespace("Source\Controllers"); // define o nome da pasta "controller" para o projeto

/* ROTAS WEB */
/* home */
$router->group(null); // não permite agrupamento para as rotas começadas com "/" (null = reseta se tiver definido algum agrupamento)
$router->get("/", "Web:home"); // Web = controller // home = metodo/funcao na classe Web
$router->get("/{filter}", "Web:home");

/* blog */
$router->group("blog"); // agrupa todas as rotas começadas com "/blog" daqui para baixo
$router->get("/", "Web:blog");
$router->get("/{post_uri}", "Web:post");
$router->get("/categoria/{cat_uri}", "Web:category");

/* contato */
$router->group("contato"); // agrupa todas as rotas começadas com "/blog" daqui para baixo
$router->get("/", "Web:contact"); // executa o get
$router->post("/", "Web:contact"); // executa um post
$router->delete("/", "Web:contact"); // executa um delete
$router->get("/{sector}", "Web:contactSector"); // regras dinamicas devem sempre ficar acima da regra fixa de rota
$router->get("/suporte", "Web:support");// regras fixas devem sempre ficar abaixo da regra dinamica de rota

/* ADMIN << novo controller para regras diferentes para usuario admin */
/* home */
$router->group("admin"); // agrupa todas as rotas começadas com "/blog" daqui para baixo
$router->get("/", "Admin:home");

/* ERROS */
$router->group("ooops"); // agrupa todas as rotas que começam com "/ops"
$router->get("/{ercode}", "Web:error");

$router->dispatch();// Ativa o gerenciamento das rotas

if($router->error()){
    $router->redirect("/ooops/{$router->error()}");
}