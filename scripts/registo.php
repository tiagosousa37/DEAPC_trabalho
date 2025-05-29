<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    echo "<h2>Debug Registo</h2>";
    echo "Nome: " . htmlspecialchars($nome) . "<br>";
    echo "Email: " . htmlspecialchars($email) . "<br>";
    echo "Password (crua): " . htmlspecialchars($password) . "<br>";

    $password_encriptada = password_hash($password, PASSWORD_DEFAULT);
    echo "Password encriptada: " . htmlspecialchars($password_encriptada) . "<br>";

    echo "<p>Simulação: Email ainda não existe. Conta criada com sucesso!</p>";
} else {
    echo "Acesso inválido.";
}
?>

