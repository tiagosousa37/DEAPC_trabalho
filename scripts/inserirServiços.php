<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Liga à base de dados
$db = new SQLite3('BD.db');

// Listas possíveis
$tipos = ['voos', 'concertos', 'hoteis'];
$continentes = ['europa', 'america', 'asia', 'africa', 'oceania'];

// Datas entre 2025-01-01 e 2026-12-31
$inicio = strtotime('2025-01-01');
$fim = strtotime('2026-12-31');

// Quantidade de registos a inserir (AJUSTA aqui se necessário!)
$quantidade = 100;

// Loop de inserção
for ($i = 0; $i < $quantidade; $i++) {
    $tipo = $tipos[array_rand($tipos)];
    $continente = $continentes[array_rand($continentes)];
    $data = date('Y-m-d', rand($inicio, $fim));
    $titulo = ucfirst($tipo) . " em " . ucfirst($continente); // Título gerado

    // Preparar e executar o INSERT corretamente
    $stmt = $db->prepare("INSERT INTO servicos (tipo, continente, data, titulo) 
                          VALUES (:tipo, :continente, :data, :titulo)");
    $stmt->bindValue(':tipo', $tipo, SQLITE3_TEXT);
    $stmt->bindValue(':continente', $continente, SQLITE3_TEXT);
    $stmt->bindValue(':data', $data, SQLITE3_TEXT);
    $stmt->bindValue(':titulo', $titulo, SQLITE3_TEXT);
    $stmt->execute();
}

echo "$quantidade serviços inseridos com sucesso.";
?>

