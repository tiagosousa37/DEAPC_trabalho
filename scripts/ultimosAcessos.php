<?php

date_default_timezone_set('Europe/Lisbon');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    exit; // Só regista acessos se o utilizador estiver autenticado
}

$db = new SQLite3('BD.db');

$email = $_SESSION['email'];
$dataHora = date('d-m-Y H:i:s');

// Registar o acesso
$stmt = $db->prepare("INSERT INTO ultimos_acessos (email, data_hora) VALUES (:email, :dataHora)");
$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$stmt->bindValue(':dataHora', $dataHora, SQLITE3_TEXT);
$stmt->execute();
?>
