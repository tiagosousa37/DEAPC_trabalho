<?php
session_start();

$db = new SQLite3('BD.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        die("Por favor, preencha todos os campos.");
    }

    echo "<pre>Dados recebidos:\n";
    echo "Username: " . htmlspecialchars($username) . "\n";
    echo "Password: ********\n";
    echo "</pre>";

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();

    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user['password'])) {

        $stmt = $db->prepare("UPDATE users SET ultimo_acesso = :acesso WHERE id = :id");
        $stmt->bindValue(':acesso', date('Y-m-d H:i:s'), SQLITE3_TEXT);
        $stmt->bindValue(':id', $user['id'], SQLITE3_INTEGER);
        $stmt->execute();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nome'] = $user['nome'];

        header("Location: ../HomeUser.html");
        exit;
    } else {
        die("<p style='text-align:center; color:red;'>Credenciais inválidas.</p>");
    }
} else {
    die("<p style='text-align:center;'>Acesso inválido. Use o formulário de login.</p>");
}
?>
