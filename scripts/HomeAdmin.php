<?php
echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Área Principal</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        nav a { margin-right: 15px; text-decoration: none; color: blue; }
        nav a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Área Administrativa - Bem-vindo</h1>
    <nav>
        <a href="ReservasAdmin.php">Gestão de Reservas</a>
        <a href="ClientesAdmin.php">Gestão de Clientes</a>
        <a href="HotelesAdmin.php">Gestão de Hotéis</a>
        <a href="DefinicoesAdmin.php">Definições</a>
        <a href="logout.php">Sair</a>
    </nav>
    <p>Escolha uma secção para começar a gerir.</p>
</body>
</html>
HTML;
?>

