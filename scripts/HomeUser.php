<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$db = new SQLite3('BD.db');

$tipo = $_GET['tipo'] ?? '';
$continente = $_GET['continente'] ?? '';
$data = $_GET['data'] ?? '';

echo "Filtros recebidos:\n";
echo "Tipo: $tipo\n";
echo "Continente: $continente\n";
echo "Data: $data\n\n";

$query = "SELECT * FROM servicos WHERE 1=1";
if ($tipo !== '') {
    $query .= " AND tipo = :tipo";
}
if ($continente !== '') {
    $query .= " AND continente = :continente";
}
if ($data !== '') {
    $query .= " AND data >= :data";
}

$stmt = $db->prepare($query);
if ($tipo !== '') $stmt->bindValue(':tipo', $tipo, SQLITE3_TEXT);
if ($continente !== '') $stmt->bindValue(':continente', $continente, SQLITE3_TEXT);
if ($data !== '') $stmt->bindValue(':data', $data, SQLITE3_TEXT);

$result = $stmt->execute();

$servicos = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $servicos[] = $row;
}

if (count($servicos) === 0) {
    echo "Nenhum serviço encontrado com esses filtros.\n";
} else {
    echo json_encode($servicos, JSON_PRETTY_PRINT);
}

$db->close();
?>

