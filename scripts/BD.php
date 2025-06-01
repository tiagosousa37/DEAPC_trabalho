<?php
$db = new SQLite3('reservasonline.db');
$query = "
CREATE TABLE IF NOT EXISTS utilizadores (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password_hash TEXT NOT NULL,
    ultimo_acesso TEXT
);
";

if ($db->exec($query)) {
    echo "Tabela 'utilizadores' criada com sucesso (ou já existia).";
} else {
    echo "Erro ao criar a tabela: " . $db->lastErrorMsg();
}
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    telefone TEXT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    tipo TEXT NOT NULL DEFAULT 'user',
    ultimo_acesso TEXT
)");

$db->exec("CREATE TABLE IF NOT EXISTS services (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    tipo TEXT NOT NULL,
    localizacao TEXT,
    descricao TEXT
)");

$db->exec("CREATE TABLE IF NOT EXISTS reservations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    service_id INTEGER NOT NULL,
    data_entrada TEXT,
    data_saida TEXT,
    num_pessoas INTEGER,
    estado TEXT DEFAULT 'pendente',
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(service_id) REFERENCES services(id)
)");

$db->exec("CREATE TABLE IF NOT EXISTS payments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    reservation_id INTEGER NOT NULL,
    metodo TEXT,
    data_pagamento TEXT,
    valor REAL,
    FOREIGN KEY(reservation_id) REFERENCES reservations(id)
)");

echo "Base de dados criada com sucesso!";
?>

