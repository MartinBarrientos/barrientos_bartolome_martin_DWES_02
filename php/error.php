<?php
session_start();
//variables de colores para mostrar campos correctos e incorrectos
$colorNombre = $_SESSION['colorNombre'];
$colorApellido = $_SESSION['colorApellido'];
$colorDNI = $_SESSION['colorDNI'];
$colorV = $_SESSION['colorV'];
$colorFecha = $_SESSION['colorFecha'];
$colorDias = $_SESSION['colorDias'];

if (!empty($_SESSION['incorrectoDni'])) {
    $incorrectoDni = $_SESSION['incorrectoDni'];
   
}
if (!empty($_SESSION['errorLog'])) {
    $error = $_SESSION['errorLog'];
    
}
//variables del formulario
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$dni = $_SESSION['dni'];
$vehiculo = $_SESSION['vehiculo'];
$fecha = $_SESSION['fecha'];
$dias = $_SESSION['dias'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
    <label class="<?php echo $colorNombre ?>" for="nombre">Nombre </label>
    <input class="<?php echo $colorNombre ?>" type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>">
    <br>
    <label class="<?php echo $colorApellido ?>" for="apellido">Apellido </label>
    <input class="<?php echo $colorApellido ?>" type="text" name="apellido" id="apellido" value="<?php echo $apellido ?>">
    <br>
    <label class="<?php echo $colorDNI ?>" for="dni">DNI </label>
    <input class="<?php echo $colorDNI ?>" type="text" name="dni" id="dni" value="<?php echo $dni ?>">
    <?php if(!empty($error)){
        echo $error;
    }else if(!empty($incorrectoDni)){
        echo $incorrectoDni;
    }; ?>
    <br>
    <label class="<?php echo $colorV ?>" for="tipoVehiculo">Tipo de vehículo </label>
    <select class="<?php echo $colorV ?>" name="vehiculo" id="vehiculo">
        <option value=""><?php echo $vehiculo ?></option>
    </select>
    <br>
    <label class="<?php echo $colorFecha ?>" for="fechaReserva">Fecha de inicio de la Reserva</label>
    <input class="<?php echo $colorFecha ?>" type="date" name="fecha" id="fecha" value="<?php echo $fecha ?>">
    <br>
    <label class="<?php echo $colorDias ?>" for="dias">Duracion de la reserva </label>
    <input class="<?php echo $colorDias ?>" type="number" name="dias" id="dias" value="<?php echo $dias ?>">
    <br>
    <a href="../html/formulario.html">Volver al inicio</a>
</body>

</html>