<?php
$db = new SQLite3('BD.db');

$db->exec("DELETE FROM servicos");

$db->exec("DELETE FROM sqlite_sequence WHERE name='servicos';");

echo "Todos os serviços foram apagados.";
$db->close();
?>

