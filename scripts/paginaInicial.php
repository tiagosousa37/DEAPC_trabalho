<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$db = new SQLite3('BD.db');

echo "<pre>";
echo "Método: " . $_SERVER["REQUEST_METHOD"] . "\n";
print_r($_POST);
echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        die("⚠️ Preencha todos os campos.");
    }

    $stmt = $db->prepare("SELECT * FROM login WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if (!$user) {
    die("⚠️ Utilizador não encontrado na base de dados.");
    }


    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        header("Location: ../HomeUser.html");
        exit;
    } else {
        echo "❌ Email ou palavra-passe incorretos.";
    }
} else {
    echo "Acesso inválido.";
}
?>
