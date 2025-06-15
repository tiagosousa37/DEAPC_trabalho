<?php
$db = new SQLite3('BD.db');

$results = $db->query('SELECT username, ultimo_acesso FROM utilizadores ORDER BY ultimo_acesso DESC');

echo "<h1>Últimos Acessos</h1>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Username</th><th>Último Acesso</th></tr>";

while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
    echo "<td>" . htmlspecialchars($row['ultimo_acesso'] ?? 'Nunca') . "</td>";
    echo "</tr>";
}

echo "</table>";
?>

