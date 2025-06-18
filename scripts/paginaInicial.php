<?php
session_start();

date_default_timezone_set('Europe/Lisbon');

ini_set('display_errors', 1);
error_reporting(E_ALL);

$db = new SQLite3('BD.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        die("<p style='color:red;'>❌ Por favor, preencha todos os campos.</p>");
    }

    $stmt = $db->prepare("SELECT * FROM registo WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        $dataHora = date('d-m-Y H:i:s');
        $stmt = $db->prepare("INSERT INTO ultimos_acessos (email, data_hora) VALUES (:email, :dataHora)");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':dataHora', $dataHora, SQLITE3_TEXT);
        $stmt->execute();

        if ($user['role'] === 'admin') {
            header("Location: ../HomeAdmin.html");
        } else {
            header("Location: ../HomeUser.html");
        }
        exit;
    } else {
        die("<p style='color:red;'>❌ Email ou palavra-passe incorretos.</p>");
    }
} else {
    die("<p>Acesso inválido. Use o formulário de login.</p>");
}
?>
