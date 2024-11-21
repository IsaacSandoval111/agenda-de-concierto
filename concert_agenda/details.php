<?php
include 'load_data.php';

$filePath = 'ruta/a/tu/archivo.xlsx'; // Cambia esto a la ruta de tu archivo Excel
$conciertos = loadConcerts($filePath);
$id = $_GET['id'];
$concertDetails = null;

foreach ($conciertos as $concert) {
    if ($concert[0] == $id) {
        $concertDetails = $concert;
        break;
    }
}

if (!$concertDetails) {
    echo "Concierto no encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $concertDetails[1]; ?></title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
    <h1><?php echo $concertDetails[1]; ?></h1>
    <p>Fecha: <?php echo $concertDetails[2]; ?></p>
    <p>Descripción: <?php echo $concertDetails[3]; ?></p>
    <img src="<?php echo $concertDetails[4]; ?>" alt="<?php echo $concertDetails[1]; ?>">
    <a href="index.php">Volver a la lista de conciertos</a>
</body>
</html>
