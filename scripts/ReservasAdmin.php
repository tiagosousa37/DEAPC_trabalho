<?php

echo "<h1>Lista de Reservas</h1>";

$reservas = [
    ['nome' => 'João Silva', 'servico' => 'Hotel', 'data_inicio' => '2025-06-01', 'data_fim' => '2025-06-05', 'estado' => 'Confirmada'],
    ['nome' => 'Maria Santos', 'servico' => 'Restaurante', 'data_inicio' => '2025-06-03', 'data_fim' => '2025-06-03', 'estado' => 'Pendente'],
    ['nome' => 'Carlos Sousa', 'servico' => 'Passeio', 'data_inicio' => '2025-06-10', 'data_fim' => '2025-06-10', 'estado' => 'Cancelada'],
];

echo "<table border='1' cellpadding='5' cellspacing='0'>
        <thead>
            <tr>
                <th>Nome do Cliente</th>
                <th>Tipo de Serviço</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>";

foreach ($reservas as $reserva) {
    echo "<tr>
            <td>" . htmlspecialchars($reserva['nome']) . "</td>
            <td>" . htmlspecialchars($reserva['servico']) . "</td>
            <td>" . htmlspecialchars($reserva['data_inicio']) . "</td>
            <td>" . htmlspecialchars($reserva['data_fim']) . "</td>
            <td>" . htmlspecialchars($reserva['estado']) . "</td>
          </tr>";
}

echo "</tbody></table>";

echo "<p>Nota: Esta tabela está com dados simulados para debug.</p>";
?>

