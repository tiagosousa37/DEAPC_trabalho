<?php
session_start();
$db = new SQLite3('BD.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    echo "<pre>Dados recebidos:\n";
    print_r($_POST);
    echo "</pre>";

    if (empty($nome) || empty($email) || empty($telefone) || empty($username) || empty($password)) {
        die("<p style='color:red;'>Por favor, preencha todos os campos.</p>");
    }

    $stmt = $db->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    if ($user = $result->fetchArray(SQLITE3_ASSOC)) {
        die("<p style='color:red;'>Erro: Nome de utilizador ou email já existente.</p>");
    }

    $stmt = $db->prepare("INSERT INTO users (nome, email, telefone, username, password, tipo) VALUES (:nome, :email, :telefone, :username, :password, 'user')");
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':telefone', $telefone, SQLITE3_TEXT);
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>✅ Registo efetuado com sucesso!</p>";
        echo "<p>Bem-vindo(a), " . htmlspecialchars($nome) . ".</p>";
    } else {
        echo "<p style='color:red;'>❌ Erro ao registar. Tente novamente.</p>";
    }
} else {
    die("<p>Acesso inválido. Por favor, use o formulário de registo.</p>");
}
?>
