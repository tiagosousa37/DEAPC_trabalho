<?php
$db = new SQLite3('reservasonline.db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    echo "<pre>Dados recebidos:\n";
    print_r($_POST);
    echo "</pre>";

    $stmt = $db->prepare('SELECT id FROM users WHERE username = :username');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute()->fetchArray();

    if ($result) {
        echo "Erro: Username já existe.";
    } else {
        $stmt = $db->prepare('INSERT INTO users (nome, email, telefone, username, password, tipo) VALUES (:nome, :email, :telefone, :username, :password, "user")');
        $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':telefone', $telefone, SQLITE3_TEXT);
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), SQLITE3_TEXT);
        $result = $stmt->execute();

        if ($result) {
            echo "Registo efetuado com sucesso!";
        } else {
            echo "Erro ao inserir utilizador.";
        }
    }
} else {
    echo "Nenhum dado POST recebido.";
}
?>

