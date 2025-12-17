<?php
require 'conectar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome       = $_POST['nome_peca'];
    $quantidade = $_POST['quantidade'];
    $local      = $_POST['localizacao'];

    $sql = "INSERT INTO pecas (nome_peca, quantidade, localizacao)
            VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $quantidade, $local]);

    // Aviso + redirecionamento
    echo "<script>
            alert('Cadastro realizado com sucesso!');
            window.location.href = 'index.php';
          </script>";
    exit;
}
