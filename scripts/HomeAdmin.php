<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Não autenticado']);
    exit;
}

$db = new SQLite3('BD.db');

$stmt = $db->prepare("SELECT nome FROM registo WHERE ID = :id");
$stmt->bindValue(':id', $_SESSION['user_id'], SQLITE3_INTEGER);
$result = $stmt->execute();
$user = $result->fetchArray(SQLITE3_ASSOC);

$reservas24h = $db->querySingle("SELECT COUNT(*) FROM reservas WHERE data_entrada >= date('now', '-1 da>$utilizadoresAtivos = $db->querySingle("SELECT COUNT(DISTINCT email) FROM ultimos_acessos WHERE data_ho>
$destinos = [];
$destinosQuery = $db->query("SELECT destino, COUNT(*) as total FROM reservas GROUP BY destino ORDER BY >while ($row = $destinosQuery->fetchArray(SQLITE3_ASSOC)) {
    $destinos[] = $row['destino'];
}

echo json_encode([
    'nome' => $user['nome'] ?? 'Administrador',
    'resumo' => [
        'reservas_24h' => $reservas24h,
        'utilizadores_ativos' => $utilizadoresAtivos,
        'destinos' => $destinos
    ]
]);
