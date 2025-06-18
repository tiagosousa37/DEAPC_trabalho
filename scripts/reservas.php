<?php
header('Content-Type: application/json');
$db = new SQLite3('BD.db');

$result = $db->query('SELECT id, cliente, servico, data_entrada, data_saida, estado FROM reservas ORDER BY data_entrada');

$reservas = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $reservas[] = $row;
}

echo json_encode($reservas);
?>
