<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conectar à base de dados
$db = new SQLite3('BD.db');

// Verificar se o pedido é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        die("<p style='color:red;'>❌ Por favor, preencha todos os campos.</p>");
    }

    // Buscar o utilizador com o email fornecido
    $stmt = $db->prepare("SELECT * FROM registo WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    // Verificar se utilizador existe e se a password está correta
    if ($user && password_verify($password, $user['password'])) {
        // Guardar info na sessão se necessário
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        // Redirecionar para a página do utilizador
        header("Location: ../HomeUser.html");
        exit;
    } else {
        die("<p style='color:red;'>❌ Email ou palavra-passe incorretos.</p>");
    }
} else {
    die("<p>Acesso inválido. Use o formulário de login.</p>");
}
?>
