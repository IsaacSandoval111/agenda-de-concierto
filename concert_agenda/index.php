<?php
include 'load_data.php';

$filePath = 'ruta/a/tu/archivo.xlsx'; // Cambia esto a la ruta de tu archivo Excel
$conciertos = loadConcerts($filePath);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Conciertos</title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
</head>
<body>
    <h1>Agenda de Conciertos</h1>
    <div class="concerts">
        <?php foreach ($conciertos as $concert): ?>
            <div class="concert">
                <h2><?php echo $concert[1]; // Nombre del concierto ?></h2>
                <p><?php echo $concert[2]; // Fecha ?></p>
                <a href="details.php?id=<?php echo $concert[0]; ?>">Ver Detalles</a>
                <img src="<?php echo $concert[4]; // Ruta de la imagen ?>" alt="<?php echo $concert[1]; ?>">
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
