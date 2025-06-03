<?php
session_start();

$db = new SQLite3('reservasonline.db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    echo "<pre>Dados recebidos:\n";
    print_r($_POST);
    echo "</pre>";

    $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $user = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        echo "Login bem-sucedido para o utilizador: " . htmlspecialchars($user['nome']);

        $stmt = $db->prepare('UPDATE users SET ultimo_acesso = :acesso WHERE id = :id');
        $stmt->bindValue(':acesso', date('Y-m-d H:i:s'), SQLITE3_TEXT);
        $stmt->bindValue(':id', $user['id'], SQLITE3_INTEGER);
        $stmt->execute();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nome'] = $user['nome'];

        header('Location: dashboard.php');
        exit;
    } else {
        echo "Credenciais inválidas.";
    }
} else {
    if (isset($_SESSION['user_id'])) {
        echo "Bem-vindo de volta, " . htmlspecialchars($_SESSION['nome']) . "!";
    } else {
        echo "Nenhum dado POST recebido. Por favor, faça login.";
    }
}
?>

