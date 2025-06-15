<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Ligação à base de dados SQLite
$db = new SQLite3('BD.db'); // Ajusta o caminho conforme a estrutura

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entrada = trim($_POST['data_entrada'] ?? '');
    $saida   = trim($_POST['data_saida'] ?? '');

    if (empty($entrada) || empty($saida)) {
        die("<p style='color:red;'>❌ Preencha ambas as datas.</p>");
    }

    if ($entrada > $saida) {
        die("<p style='color:red;'>⚠️ A data de entrada não pode ser depois da saída.</p>");
    }

    $stmt = $db->prepare("INSERT INTO bloqueios (data_entrada, data_saida) VALUES (:entrada, :saida)");
    $stmt->bindValue(':entrada', $entrada, SQLITE3_TEXT);
    $stmt->bindValue(':saida', $saida, SQLITE3_TEXT);

    if ($stmt->execute()) {
        header("Location: ../reservasAdmin.html");
        exit;
    } else {
        die("<p style='color:red;'>❌ Erro ao guardar as datas.</p>");
    }
} else {
    die("<p>Acesso inválido.</p>");
}
?>
