<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario'])) exit("Acesso negado");

$produtos = [
    ["id" => 1, "nome" => "Teclado", "preco" => 150.00],
    ["id" => 2, "nome" => "PC", "preco" => 3500.00],
    ["id" => 3, "nome" => "Mouse", "preco" => 80.00],
    ["id" => 4, "nome" => "Monitor", "preco" => 900.00],
    ["id" => 5, "nome" => "Cadeira Gamer", "preco" => 1200.00]
];

$_SESSION['produtos'] = $produtos; 