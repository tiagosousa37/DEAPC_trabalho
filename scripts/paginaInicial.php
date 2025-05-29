<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    echo "<h2>Debug Login</h2>";
    echo "Email recebido: " . htmlspecialchars($email) . "<br>";
    echo "Password recebido: " . htmlspecialchars($password) . "<br>";


    if ($email === "teste@exemplo.com" && $password === "1234") {
        echo "<p>Login válido! Redirecionar para HomeUser.php...</p>";
    } else {
        echo "<p>Credenciais inválidas. Tenta novamente.</p>";
    }
} else {
    echo "Acesso inválido.";
}
?>

