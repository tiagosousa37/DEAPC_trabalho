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

// Aeroportos organizados por continente
$aeroportosPorContinente = [
    'europa' => ['Lisboa', 'Porto', 'Madrid', 'Paris', 'Londres', 'Berlim'],
    'america' => ['Nova Iorque', 'São Paulo', 'Buenos Aires', 'Cidade do México', 'Toronto'],
    'asia' => ['Tóquio', 'Pequim', 'Bangkok', 'Seul', 'Singapura'],
    'africa' => ['Cairo', 'Casablanca', 'Johannesburg', 'Nairobi'],
    'oceania' => ['Sydney', 'Melbourne', 'Auckland']
];

// Juntar todos aeroportos numa só lista para partidas aleatórias
$aeroportosTodos = array_merge(...array_values($aeroportosPorContinente));

$inicio = strtotime('01-01-2025');
$fim = strtotime('31-12-2026');

$quantidade = 1000;

for ($i = 0; $i < $quantidade; $i++) {
    $tipo = $tipos[array_rand($tipos)];
    $continente = $continentes[array_rand($continentes)];
    $data = date('d-m-Y', rand($inicio, $fim));
    $imagem = $imagens[$tipo];

    // Título por tipo
    $titulo = match($tipo) {
        'voos' => "Voos para " . ucfirst($continente),
        'concertos' => "Concerto na " . ucfirst($continente),
        'hoteis' => "Hotel na " . ucfirst($continente),
    };

    // Preço aleatório
    $preco = match($tipo) {
        'voos' => rand(100, 1500),
        'concertos' => rand(30, 300),
        'hoteis' => rand(80, 500),
    };

    // Inserção diferenciada se for voo
    if ($tipo === 'voos') {
        // Partida aleatória de qualquer lugar
        $partida = $aeroportosTodos[array_rand($aeroportosTodos)];
        // Destino dentro do continente escolhido
        $destinosPossiveis = $aeroportosPorContinente[$continente];

        do {
            $destino = $destinosPossiveis[array_rand($destinosPossiveis)];
        } while ($destino === $partida); // evita partida igual ao destino

        $stmt = $db->prepare("INSERT INTO servicos (tipo, continente, data, titulo, imagem, partida, destino, preco)
                              VALUES (:tipo, :continente, :data, :titulo, :imagem, :partida, :destino, :preco)");
        $stmt->bindValue(':partida', $partida, SQLITE3_TEXT);
        $stmt->bindValue(':destino', $destino, SQLITE3_TEXT);
    } else {
        $stmt = $db->prepare("INSERT INTO servicos (tipo, continente, data, titulo, imagem, preco)
                              VALUES (:tipo, :continente, :data, :titulo, :imagem, :preco)");
    }

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

