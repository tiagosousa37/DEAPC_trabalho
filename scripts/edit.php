<?php
// Incluir configuração da base de dados
include 'dbconfig.php';

// Obter o ID do utilizador a editar
$id = $_GET['id'];

// Buscar os dados do utilizador
$sql = "SELECT * FROM utilizadores WHERE id = '$id'";
$query = $db->query($sql);
$row = $query->fetchArray();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Utilizador</title>
</head>
<body>
    <form method="POST">
        <a href="registo.php">Voltar</a>
        <p>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
        </p>
        <p>
            <label for="palavra_passe">Palavra-passe (deixe em branco para manter a atual):</label>
            <input type="password" id="palavra_passe" name="palavra_passe">
        </p>
        <p>
            <label for="tipo_utilizador">Tipo de Utilizador:</label>
            <select id="tipo_utilizador" name="tipo_utilizador">
                <option value="cliente" <?php echo ($row['tipo_utilizador'] == 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                <option value="admin" <?php echo ($row['tipo_utilizador'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
            </select>
        </p>
        <input type="submit" name="save" value="Guardar">
    </form>

<?php
if(isset($_POST['save'])){
    $email = $_POST['email'];
    $tipo_utilizador = $_POST['tipo_utilizador'];
    
    // Se a password foi alterada
    if(!empty($_POST['palavra_passe'])){
        $palavra_passe = password_hash($_POST['palavra_passe'], PASSWORD_DEFAULT);
        $sql = "UPDATE utilizadores SET email = '$email', palavra_passe = '$palavra_passe', tipo_utilizador = '$tipo_utilizador' WHERE id = '$id'";
    } else {
        $sql = "UPDATE utilizadores SET email = '$email', tipo_utilizador = '$tipo_utilizador' WHERE id = '$id'";
    }
    
    $db->exec($sql);
    header('location: registo.php');
}
?>
</body>
</html>
