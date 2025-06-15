<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Adicionar Utilizador</title>
</head>
<body>
    <a href="registo.php">Voltar</a>
    <form method="POST">
        <p>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </p>
        <p>
            <label for="password">Palavra-passe:</label>
            <input type="password" id="password" name="password" required>
        </p>
        <input type="submit" name="save" value="Guardar">
    </form>

<?php
if(isset($_POST['save'])){
    include 'dbconfig.php';
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "INSERT INTO utilizadores (email, palavra_passe) VALUES ('$email', '$password')";
    $db->exec($sql);
    
    header('location: registo.php');
}
?>
</body>
</html>
