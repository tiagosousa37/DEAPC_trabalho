<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<h2>DEBUG: Dados recebidos para reserva</h2><pre>";
    print_r($_POST);
    echo "</pre>";

    echo "<p>Reserva processada (simulação).</p>";
} else {
    echo "<p style='color:red;'>Acesso inválido. Use o formulário de reserva.</p>";
}
?>

