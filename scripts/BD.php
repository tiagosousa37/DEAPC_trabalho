<?php
$db = new SQLite3('BD.php');

$db->exec("PRAGMA foreign_keys = ON;");

$query_utilizadores = "
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY,
        nome TEXT NOT NULL,
        email TEXT UNIQUE NOT NULL,
        telefone TEXT,
        username TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL,
        tipo TEXT NOT NULL DEFAULT 'user',
        ultimo_acesso TEXT
    );
";

if ($db->exec($query_utilizadores)) {
    echo "<div style='color:green;'>✅ Tabela 'users' criada ou já existente.</div>";
} else {
    echo "<div style='color:red;'>❌ Erro ao criar a tabela 'users': " . $db->lastErrorMsg() . "</div>";
}

$query_servicos = "
    CREATE TABLE IF NOT EXISTS services (
        id INTEGER PRIMARY KEY,
        nome TEXT NOT NULL,
        tipo TEXT NOT NULL,
        localizacao TEXT,
        descricao TEXT
    );
";

if ($db->exec($query_servicos)) {
    echo "<div style='color:green;'>✅ Tabela 'services' criada ou já existente.</div>";
} else {
    echo "<div style='color:red;'>❌ Erro ao criar a tabela 'services': " . $db->lastErrorMsg() . "</div>";
}

$query_reservas = "
    CREATE TABLE IF NOT EXISTS reservations (
        id INTEGER PRIMARY KEY,
        user_id INTEGER NOT NULL,
        service_id INTEGER NOT NULL,
        data_entrada TEXT,
        data_saida TEXT,
        num_pessoas INTEGER,
        estado TEXT DEFAULT 'pendente',
        FOREIGN KEY(user_id) REFERENCES users(id),
        FOREIGN KEY(service_id) REFERENCES services(id)
    );
";

if ($db->exec($query_reservas)) {
    echo "<div style='color:green;'>✅ Tabela 'reservations' criada ou já existente.</div>";
} else {
    echo "<div style='color:red;'>❌ Erro ao criar a tabela 'reservations': " . $db->lastErrorMsg() . "</div>";
}

$query_pagamentos = "
    CREATE TABLE IF NOT EXISTS payments (
        id INTEGER PRIMARY KEY,
        reservation_id INTEGER NOT NULL,
        metodo TEXT,
        data_pagamento TEXT,
        valor REAL,
        FOREIGN KEY(reservation_id) REFERENCES reservations(id)
    );
";

if ($db->exec($query_pagamentos)) {
    echo "<div style='color:green;'>✅ Tabela 'payments' criada ou já existente.</div>";
} else {
    echo "<div style='color:red;'>❌ Erro ao criar a tabela 'payments': " . $db->lastErrorMsg() . "</div>";
}

echo "<br><strong>Base de dados criada com sucesso!</strong>";
?>
