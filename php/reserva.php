<?php
session_start();
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$vehiculo = $_SESSION['vehiculo'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Kaixo <?php echo $nombre.' '.$apellido ?></h2>
    <img src="../img/<?php echo $vehiculo ?>.jpg" alt="">
</body>
</html>