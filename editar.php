<?php
require 'conectar.php';  // Conexão com o banco de dados

// Verifica se o formulário foi enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega os dados do formulário
    $id         = $_POST['id_peca'];
    $nome       = $_POST['nome_peca'];
    $quantidade = $_POST['quantidade'];
    $local      = $_POST['localizacao'];

    // SQL de atualização
    $sql = "UPDATE pecas 
            SET nome_peca = ?, quantidade = ?, localizacao = ? 
            WHERE id_peca = ?";

    // Prepara e executa a query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $quantidade, $local, $id]);

    // Redireciona para a página principal após o update
    header("Location: index.php");
    exit;
}

// Recebe o ID da peça via GET
$id = $_GET['id'];

if (!$id) {
    // Se não encontrar o ID, redireciona para a página principal
    header("Location: index.php");
    exit;
}

// Consulta para buscar os dados da peça
$sql = "SELECT * FROM pecas WHERE id_peca = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

// Verifica se a peça existe
$peca = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$peca) {
        echo "<script>
            alert('Peça não encontrada!!');
            window.location.href = 'index.php';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Peça</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3>Editar Peça</h3>

    <form method="POST">
        <!-- Campo oculto para o ID da peça -->
        <input type="hidden" name="id_peca" value="<?= $peca['id_peca']; ?>">

        <div class="mb-3">
            <label class="form-label">Nome da peça</label>
            <input type="text" name="nome_peca" class="form-control" value="<?= $peca['nome_peca']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantidade</label>
            <input type="number" name="quantidade" class="form-control" value="<?= $peca['quantidade']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Localização</label>
            <input type="text" name="localizacao" class="form-control" value="<?= $peca['localizacao']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

</body>
</html>
