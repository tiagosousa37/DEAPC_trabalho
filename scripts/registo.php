<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$db = new SQLite3('BD.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($nome) || empty($email) || empty($password)) {
    die("<p style='color:red;'>❌ Por favor, preencha todos os campos.</p>");
    }

    $stmt = $db->prepare("SELECT id FROM registo WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    if ($result->fetchArray(SQLITE3_ASSOC)) {
        die("<p style='color:red;'>⚠️ Email já está registado. Tente outro.</p>");
    }

    $stmt = $db->prepare("INSERT INTO registo (nome, email, password) VALUES (:nome, :email, :password)");
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), SQLITE3_TEXT);

    if ($stmt->execute()) {
        header("Location: ../paginaInicial.html");
        exit;
    } else {
        die("<p style='color:red;'>❌ Erro ao registar. Tente novamente mais tarde.</p>");
    }
} else {
    $db->close();
    die("<p>Acesso inválido. Use o formulário de registo.</p>");
}
?>

