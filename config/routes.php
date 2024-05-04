<?php

$router = new Framework\Router;

// Homepage example
$router->add("/", ["controller" => "credits", "action" => "index"]);

// Catch-all example
$router->add("/{controller}/{action}");

// Example with HTTP method
$router->add("/{controller}/{id:\d+}/destroy", ["action" => "destroy", "method" => "post"]);
$router->add("/{controller}/{id:\d+}/new_payment", ["action" => "new_payment", "method" => "get"]);
$router->add("/{controller}/{id:\d+}/payments/store", ["action" => "store_payment", "method" => "post"]);
$router->add("/{controller}/{id:\d+}/show", ["action" => "show", "method" => "get"]);
$router->add("/{controller}/{id:\d+}/delete", ["action" => "delete", "method" => "post"]);

return $router;