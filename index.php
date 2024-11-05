<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";  // Cambia si tu contraseña de MySQL es diferente
$dbname = "agenda_eventos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Variables para filtros
$genero = isset($_GET['genero']) ? $_GET['genero'] : '';
$ciudad = isset($_GET['ciudad']) ? $_GET['ciudad'] : '';

// Construye la consulta con filtros
$sql = "SELECT * FROM eventos WHERE 1=1";
if ($genero != '') {
    $sql .= " AND genero = '" . $conn->real_escape_string($genero) . "'";
}
if ($ciudad != '') {
    $sql .= " AND ciudad = '" . $conn->real_escape_string($ciudad) . "'";
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Conciertos</title>
</head>
<body>

<h1>Próximos Conciertos</h1>

<form method="GET" action="">
    <label for="genero">Género:</label>
    <select name="genero" id="genero">
        <option value="">Todos</option>
        <option value="rock" <?php if ($genero == 'rock') echo 'selected'; ?>>Rock</option>
        <option value="jazz" <?php if ($genero == 'jazz') echo 'selected'; ?>>Jazz</option>
        <option value="pop" <?php if ($genero == 'pop') echo 'selected'; ?>>Pop</option>
    </select>

    <label for="ciudad">Ciudad:</label>
    <select name="ciudad" id="ciudad">
        <option value="">Todas</option>
        <option value="Buenos Aires" <?php if ($ciudad == 'Buenos Aires') echo 'selected'; ?>>Buenos Aires</option>
        <option value="Rosario" <?php if ($ciudad == 'Rosario') echo 'selected'; ?>>Rosario</option>
    </select>

    <button type="submit">Filtrar</button>
</form>

<?php
// Muestra los resultados
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px;'>";
        echo "<h2>" . $row["artista"] . "</h2>";
        echo "<p><strong>Fecha:</strong> " . $row["fecha"] . "</p>";
        echo "<p><strong>Ciudad:</strong> " . $row["ciudad"] . "</p>";
        echo "<p><strong>Lugar:</strong> " . $row["lugar"] . "</p>";
        echo "<p><strong>Género:</strong> " . $row["genero"] . "</p>";
        
        // Mostrar la imagen de portada
        if (!empty($row["portada"])) {
            echo "<img src='imagenes/" . $row["portada"] . "' alt='" . $row["artista"] . "' style='width:200px; height:auto;'>";
        }
        
        echo "</div>";
    }
} else {
    echo "<p>No se encontraron conciertos para los filtros seleccionados.</p>";
}

$conn->close();
?>

</body>
</html>
