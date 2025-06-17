<?php
$db = new SQLite3('BD.db');

// Apagar todos os registros da tabela 'servicos'
$db->exec("DELETE FROM servicos");

// (Opcional) Resetar o contador de IDs (se necessário, depende do uso)
$db->exec("DELETE FROM sqlite_sequence WHERE name='servicos';");

echo "Todos os serviços foram apagados.";
$db->close();
?>

