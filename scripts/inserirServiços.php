<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conecta ao banco de dados
$db = new SQLite3('BD.db');

// Dados possíveis
$tipos = ['voos', 'concertos', 'hoteis'];
$continentes = ['europa', 'america', 'asia', 'africa', 'oceania'];
$imagens = [
    'voos' => 'images/swiss.jpg',
    'concertos' => 'images/concertos.jpeg',
    'hoteis' => 'images/maldivas.jpg'
];
$aeroportos = [
    'Lisboa', 'Porto', 'Madrid', 'Paris', 'Londres',
    'Nova Iorque', 'São Paulo', 'Tóquio', 'Cidade do México', 'Johannesburg'
];

// Período das datas
$inicio = strtotime('01-01-2025');
$fim = strtotime('31-12-2026');

// Quantidade de serviços a inserir
$quantidade = 1000;

for ($i = 0; $i < $quantidade; $i++) {
    $tipo = $tipos[array_rand($tipos)];
    $continente = $continentes[array_rand($continentes)];
    $data = date('d-m-Y', rand($inicio, $fim));
    $imagem = $imagens[$tipo];

    // Gerar título
    if ($tipo === 'voos') {
        $titulo = "Voos para " . ucfirst($continente);
    } elseif ($tipo === 'concertos') {
        $titulo = "Concerto em " . ucfirst($continente);
    } elseif ($tipo === 'hoteis') {
        $titulo = "Hotel em " . ucfirst($continente);
    }

    // Gerar preço aleatório
    switch ($tipo) {
        case 'voos':
            $preco = rand(100, 1500); // €100 - €1500
            break;
        case 'concertos':
            $preco = rand(30, 300); // €30 - €300
            break;
        case 'hoteis':
            $preco = rand(80, 500); // €80 - €500
            break;
    }

    // Se for voo, incluir partida e destino
    if ($tipo === 'voos') {
        do {
            $partida = $aeroportos[array_rand($aeroportos)];
            $destino = $aeroportos[array_rand($aeroportos)];
        } while ($partida === $destino);

        $stmt = $db->prepare("INSERT INTO servicos (tipo, continente, data, titulo, imagem, partida, destino, preco)
                              VALUES (:tipo, :continente, :data, :titulo, :imagem, :partida, :destino, :preco)");
        $stmt->bindValue(':partida', $partida, SQLITE3_TEXT);
        $stmt->bindValue(':destino', $destino, SQLITE3_TEXT);
    } else {
        $stmt = $db->prepare("INSERT INTO servicos (tipo, continente, data, titulo, imagem, preco)
                              VALUES (:tipo, :continente, :data, :titulo, :imagem, :preco)");
    }

    // Bind comum a todos
    $stmt->bindValue(':tipo', $tipo, SQLITE3_TEXT);
    $stmt->bindValue(':continente', $continente, SQLITE3_TEXT);
    $stmt->bindValue(':data', $data, SQLITE3_TEXT);
    $stmt->bindValue(':titulo', $titulo, SQLITE3_TEXT);
    $stmt->bindValue(':imagem', $imagem, SQLITE3_TEXT);
    $stmt->bindValue(':preco', $preco, SQLITE3_FLOAT);

    $stmt->execute();
}

echo "$quantidade serviços inseridos com sucesso.";
?>

