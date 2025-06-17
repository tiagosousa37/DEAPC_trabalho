<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$db = new SQLite3('BD.db');

$tipos = ['voos', 'concertos', 'hoteis'];
$continentes = ['europa', 'america', 'asia', 'africa', 'oceania'];
$imagens = [
    'voos' => 'images/swiss.jpg',
    'concertos' => 'images/concertos.jpeg',
    'hoteis' => 'images/maldivas.jpg'
];

// Exemplo de aeroportos para partidas e destinos (pode expandir ou melhorar)
$aeroportos = [
    'Lisboa', 'Porto', 'Madrid', 'Paris', 'Londres',
    'Nova Iorque', 'São Paulo', 'Tóquio', 'Cidade do México', 'Johannesburg'
];

$inicio = strtotime('01-01-2025');
$fim = strtotime('31-12-2026');

$quantidade = 1000;

for ($i = 0; $i < $quantidade; $i++) {
    $tipo = $tipos[array_rand($tipos)];
    $continente = $continentes[array_rand($continentes)];
    $data = date('d-m-Y', rand($inicio, $fim));
    if ($tipo === 'voos') {
    $titulo = "Voos para " . ucfirst($continente);
    } elseif ($tipo === 'concertos') {
    $titulo = "Concerto em " . ucfirst($continente);
    } elseif ($tipo === 'hoteis') {
    $titulo = "Hotel em " . ucfirst($continente);
    }

    $imagem = $imagens[$tipo];

    if ($tipo === 'voos') {
        // Escolher partida e destino aleatoriamente, evitando que sejam iguais
        do {
            $partida = $aeroportos[array_rand($aeroportos)];
            $destino = $aeroportos[array_rand($aeroportos)];
        } while ($partida === $destino);

        $stmt = $db->prepare("INSERT INTO servicos (tipo, continente, data, titulo, imagem, partida, destino)
                              VALUES (:tipo, :continente, :data, :titulo, :imagem, :partida, :destino)");
        $stmt->bindValue(':partida', $partida, SQLITE3_TEXT);
        $stmt->bindValue(':destino', $destino, SQLITE3_TEXT);
    } else {
        $stmt = $db->prepare("INSERT INTO servicos (tipo, continente, data, titulo, imagem)
                              VALUES (:tipo, :continente, :data, :titulo, :imagem)");
    }

    $stmt->bindValue(':tipo', $tipo, SQLITE3_TEXT);
    $stmt->bindValue(':continente', $continente, SQLITE3_TEXT);
    $stmt->bindValue(':data', $data, SQLITE3_TEXT);
    $stmt->bindValue(':titulo', $titulo, SQLITE3_TEXT);
    $stmt->bindValue(':imagem', $imagem, SQLITE3_TEXT);

    $stmt->execute();
}

echo "$quantidade serviços inseridos com sucesso.";
?>

