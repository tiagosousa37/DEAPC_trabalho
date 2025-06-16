<?php
$db = new SQLite3('BD.db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_utilizador = $_POST['id_utilizador'] ?? '';
    $id_servico = $_POST['id_servico'] ?? '';
    $data_entrada = $_POST['data_entrada'] ?? '';
    $data_saida = $_POST['data_saida'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $num_pessoas = $_POST['num_pessoas'] ?? 1;
    $telefone = $_POST['telefone'] ?? '';

    echo "<pre>Dados recebidos:\n";
    print_r($_POST);
    echo "</pre>";

    $stmt = $db->prepare('
        INSERT INTO reservas (
            id_utilizador, id_servico, data_entrada, data_saida,
            nome, num_pessoas, telefone, local, pagamento
        ) VALUES (
            :id_utilizador, :id_servico, :data_entrada, :data_saida,
            :nome, :num_pessoas, :telefone, :local, :pagamento
        )
    ');

    $stmt->bindValue(':id_utilizador', $id_utilizador, SQLITE3_INTEGER);
    $stmt->bindValue(':id_servico', $id_servico, SQLITE3_INTEGER);
    $stmt->bindValue(':data_entrada', $data_entrada, SQLITE3_TEXT);
    $stmt->bindValue(':data_saida', $data_saida, SQLITE3_TEXT);
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':num_pessoas', $num_pessoas, SQLITE3_INTEGER);
    $stmt->bindValue(':telefone', $telefone, SQLITE3_TEXT); // use TEXT, não INTEGER
    $stmt->bindValue(':local', $_POST['local'] ?? 'Desconhecido', SQLITE3_TEXT);
    $stmt->bindValue(':pagamento', $_POST['pagamento'] ?? 'MBWAY', SQLITE3_TEXT);

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

