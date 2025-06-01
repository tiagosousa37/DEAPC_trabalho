<?php
$db = new SQLite3('reservasonline.db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'] ?? '';
    $service_id = $_POST['service_id'] ?? '';
    $data_entrada = $_POST['data_entrada'] ?? '';
    $data_saida = $_POST['data_saida'] ?? '';
    $num_pessoas = $_POST['num_pessoas'] ?? 1;

    echo "<pre>Dados recebidos:\n";
    print_r($_POST);
    echo "</pre>";

    $stmt = $db->prepare('INSERT INTO reservations (user_id, service_id, data_entrada, data_saida, num_pessoas) VALUES (:user_id, :service_id, :data_entrada, :data_saida, :num_pessoas)');
    $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
    $stmt->bindValue(':service_id', $service_id, SQLITE3_INTEGER);
    $stmt->bindValue(':data_entrada', $data_entrada, SQLITE3_TEXT);
    $stmt->bindValue(':data_saida', $data_saida, SQLITE3_TEXT);
    $stmt->bindValue(':num_pessoas', $num_pessoas, SQLITE3_INTEGER);
    $result = $stmt->execute();

    if ($result) {
        echo "Reserva criada com sucesso!";
    } else {
        echo "Erro ao criar reserva.";
    }
} else {
    echo "Nenhum dado POST recebido.";
}
?>

