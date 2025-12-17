<?php

// Configurações do banco
$host = "localhost";
$db   = "iot";
$user = "root";
$pass = "";
$charset = "utf8mb4";

try {
    // Conexão PDO
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

?>