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

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recebe os dados
    $nome_peca   = $_POST['nome_peca'];
    $quantidade  = $_POST['quantidade'];
    $localizacao = $_POST['localizacao'];

    // SQL com placeholders
    $sql = "INSERT INTO pecas (nome_peca, quantidade, localizacao)
            VALUES (:nome_peca, :quantidade, :localizacao)";

    // Prepara a query
    $stmt = $pdo->prepare($sql);

    // Associa os valores
    $stmt->bindParam(':nome_peca', $nome_peca);
    $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
    $stmt->bindParam(':localizacao', $localizacao);

    // Executa
    if ($stmt->execute()) {
        echo "<h3>Peça cadastrada com sucesso!</h3>";
        echo "<a href='index.html'>Voltar</a>";
    } else {
        echo "Erro ao cadastrar.";
    }
}
?>
