<?php
require 'conectar.php';

// Recebe o ID via GET
$id = $_GET['id'];


// SQL para excluir
$sql = "DELETE FROM pecas WHERE id_peca = ?";

// Prepara e executa
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

// Volta para a página principal
  echo "<script>
            alert('Produto com $id excluido com sucesso!!');
            window.location.href = 'index.php';
          </script>";
