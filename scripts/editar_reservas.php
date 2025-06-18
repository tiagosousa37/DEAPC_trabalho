<?php
header('Content-Type: application/json');
$db = new SQLite3('BD.db');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['erro' => 'Método não permitido']);
    exit;
}

$id = intval($_POST['id'] ?? 0);
$data_entrada = trim($_POST['data_entrada'] ?? '');
$data_saida = trim($_POST['data_saida'] ?? '');
$estado = trim($_POST['estado'] ?? '');

if (!$id || !$data_entrada || !$estado) {
    http_response_code(400);
    echo json_encode(['erro' => 'Parâmetros inválidos']);
    exit;
}

$stmt = $db->prepare('UPDATE reservas SET data_entrada = :entrada, data_saida = :saida, estado = :estado WHERE id = :id');
$stmt->bindValue(':entrada', $data_entrada, SQLITE3_TEXT);
$stmt->bindValue(':saida', $data_saida, SQLITE3_TEXT);
$stmt->bindValue(':estado', $estado, SQLITE3_TEXT);
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);

$result = $stmt->execute();

if ($result) {
    echo json_encode(['sucesso' => true]);
} else {
    http_response_code(500);
    echo json_encode(['erro' => 'Falha ao atualizar']);
}
?>
