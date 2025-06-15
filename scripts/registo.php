<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conectar à base de dados SQLite
$db = new SQLite3('BD.db');

// Verificar se o pedido é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Verificar se os campos estão preenchidos
    if (empty($email) || empty($password)) {
        die("<p style='color:red;'>❌ Por favor, preencha todos os campos.</p>");
    }

    // Verificar se o email já está registado
    $stmt = $db->prepare("SELECT id FROM registo WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    if ($result->fetchArray(SQLITE3_ASSOC)) {
        die("<p style='color:red;'>⚠️ Email já está registado. Tente outro.</p>");
    }

    // Inserir novo utilizador
    $stmt = $db->prepare("INSERT INTO registo (email, password) VALUES (:email, :password)");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), SQLITE3_TEXT);

    if ($stmt->execute()) {
        header("Location: ../paginaInicial.html");
        exit;
    } else {
        die("<p style='color:red;'>❌ Erro ao registar. Tente novamente mais tarde.</p>");
    }
} else {
    die("<p>Acesso inválido. Use o formulário de registo.</p>");
}
?>
