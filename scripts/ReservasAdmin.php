<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$db = new SQLite3('BD.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entrada = trim(filter_input(INPUT_POST, 'data_entrada', FILTER_SANITIZE_STRING) ?? '');
    $saida   = trim(filter_input(INPUT_POST, 'data_saida', FILTER_SANITIZE_STRING) ?? '');

    if (empty($entrada) || empty($saida)) {
        die("<p style='color:red;'>❌ Por favor, preencha ambas as datas.</p>");
    }

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $entrada) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $saida)) {
        die("<p style='color:red;'>⚠️ Formato de data inválido. Use YYYY-MM-DD.</p>");
    }

    if ($entrada > $saida) {
        die("<p style='color:red;'>⚠️ A data de entrada não pode ser depois da data de saída.</p>");
    }

    $stmt = $db->prepare("INSERT INTO bloqueios (data_entrada, data_saida) VALUES (:entrada, :saida)");
    $stmt->bindValue(':entrada', $entrada, SQLITE3_TEXT);
    $stmt->bindValue(':saida', $saida, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
        header("Location: ../reservasAdmin.html");
        exit;
    } else {
        die("<p style='color:red;'>❌ Erro ao guardar as datas na base de dados.</p>");
    }
} else {
    die("<p style='color:red;'>Acesso inválido.</p>");
}
?>
