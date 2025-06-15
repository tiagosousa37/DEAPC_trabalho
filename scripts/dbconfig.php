<?php
$db = new SQLite3('BD.db');
$query = "CREATE TABLE IF NOT EXISTS utilizadores (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT NOT NULL UNIQUE,
    palavra_passe TEXT NOT NULL,
    data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tipo_utilizador TEXT NOT NULL DEFAULT 'cliente',
    ultimo_login NUMERIC,
    data_registo NUMERIC
)";
$db->exec($query);
?>
