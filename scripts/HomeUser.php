<?php

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    echo "<h2>DEBUG: Parâmetros recebidos</h2><pre>";
    print_r($_GET);
    echo "</pre>";

    echo "<h3>Serviços disponíveis (exemplo)</h3>";
    echo "<ul>
            <li>Serviço 1 - Local: Lisboa - Tipo: Hotel</li>
            <li>Serviço 2 - Local: Porto - Tipo: Restaurante</li>
          </ul>";
} else {
    echo "<p style='color:red;'>Use filtros via GET para ver os serviços.</p>";
}
?>

