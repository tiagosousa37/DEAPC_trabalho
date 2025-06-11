<?php
$db = new SQLite3(__DIR__ . '/BD.db');

$query = "SELECT r.id, c.nome AS cliente, r.tipo_servico, r.data_entrada, r.data_saida, r.estado 
          FROM reservas r
          JOIN clientes c ON r.cliente_id = c.id
          ORDER BY r.data_entrada DESC";

$result = $db->query($query);

echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Reservas</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 8px 12px; border: 1px solid #ccc; }
        th { background-color: #eee; }
        .status-confirmed { color: green; }
        .status-pending { color: orange; }
        .status-canceled { color: red; }
    </style>
</head>
<body>
    <h1>Gestão de Reservas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Tipo de Serviço</th>
                <th>Data Entrada</th>
                <th>Data Saída</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
HTML;

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $statusClass = '';
    switch (strtolower($row['estado'])) {
        case 'confirmada': $statusClass = 'status-confirmed'; break;
        case 'pendente': $statusClass = 'status-pending'; break;
        case 'cancelada': $statusClass = 'status-canceled'; break;
    }
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['cliente']}</td>
        <td>{$row['tipo_servico']}</td>
        <td>{$row['data_entrada']}</td>
        <td>{$row['data_saida']}</td>
        <td class=\"$statusClass\">{$row['estado']}</td>
    </tr>";
}

echo <<<HTML
        </tbody>
    </table>
</body>
</html>
HTML;

$db->close();
?>

