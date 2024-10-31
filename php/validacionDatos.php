<?php
//importarmos usuarios_y_coche.php
include 'usuarios_y_coche.php';
//vamos recoger la informacion del formulario y a declarar las variables
$vehiculo = $_POST['vehiculo'];
$fecha = $_POST['fecha'];
$dias = $_POST['dias'];
//guardamos el dni en mayusculas
$dni = strtoupper($_POST['dni']);
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];

//ahora vamos a proceder a las comprobaciones pedidas: 
//-------------------------------COMPROBAMOS-------------------------------//
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //si el formulario está vacio lo volvemos a mandar a formulario.html
    if(empty($nombre) && empty($apellido) && empty($dni) && empty($vehiculo) && empty($fecha) && empty($dias) == true){
        header("Location: ../html/formulario.html");
        exit;
    }
    //empezamos una sesion
    session_start();
    //guardamos las variables de session
    $_SESSION['nombre'] = $nombre;
    $_SESSION['apellido'] = $apellido;
    $_SESSION['dni'] = $dni;
    $_SESSION['fecha'] = $fecha;  
    $_SESSION['dias'] = $dias;
    $_SESSION['vehiculo'] = $vehiculo;
    //hacemos las comprobaciones y guardamos los colores para mostrar los campos correcto e incorrectos
    if(nombreVacio($nombre)==true){
        $_SESSION['colorNombre'] = "verde";
    }else{    
        $_SESSION['colorNombre'] = "rojo";
    }
    if(apellidoVacio( $apellido) == true){
        $_SESSION['colorApellido'] = "verde";
    }else{    
        $_SESSION['colorApellido'] = "rojo";
    }
    if(validarDni($dni) == true){
        $_SESSION['colorDNI'] = "verde";
        if (validarUsuario($dni, $nombre, $apellido) == false){
            $_SESSION['errorLog'] = "Usuario no registrado en la BBDD";
            $_SESSION['colorDNI'] = "rojo";
        }else{
            $_SESSION['colorDNI'] = "verde";
        }
    }else{
        $_SESSION['colorDNI'] = "rojo";
        $_SESSION['incorrectoDni'] = "El formato del DNI es incorrecto";
    }
    if(validarFecha($fecha) == true){
        $_SESSION['colorFecha'] = "verde";
                 
    }else{
        $_SESSION['colorFecha'] = "rojo";
    }
    if(duracionReserva($dias) == true){
        $_SESSION['colorDias'] = "verde";
        
    }else{
        $_SESSION['colorDias'] = "rojo";
    }
    if(cocheDisponible($coches, $vehiculo) == true){
        $_SESSION['colorV'] = 'verde';
    }else{
        $_SESSION['colorV'] = "rojo";  
    }
    //si el usuario no esta en el sistema guardamo un mensaje de error y marcamo el dni en rojo
    
    //validamos que el usuario esta en el sistema y que las fechas de alquiler son corectas y que el coche esté disponible
    if((validarUsuario($dni, $nombre, $apellido) && validarFecha($fecha) && duracionReserva($dias) && cocheDisponible($coches, $vehiculo)) == true){
        header('Location: ./reserva.php');
        exit;
    }else{
        header('Location: ./error.php');
        exit;
    }
}
//--------------------------FUNCIONES-----------------------------------//
//funciones para comprobar que nombre y apellido no pueden estar vacios
function nombreVacio($nombre){
    if (!empty($nombre)){        
        return true;
    } else {
        return false;
    }
}
function apellidoVacio($apellido){
    if (!empty($apellido)){
        return true;
    } else {
        return false;
    }
}
//funcion para calcular la letra del dni a partir del numero con el modulo23
function letra_nif($dniNumero) {
    if(!empty($dniNumero)){
        return substr("TRWAGMYFPDXBNJZSQVHLCKE",strtr($dniNumero,"XYZ","012")%23,1);
    }
}
//funcion para validar el dni
function validarDni($dni){
    //pillamos el numero del dni
    $dniNumero = substr($dni, 0, 8);
    //pasamos por la funcion el numero para saber si la letra es correcta
    $letraCorrecta = letra_nif( $dniNumero);
    //si el dni pasado es el mismo que los numeros y la letra correcta VALIDAMOS
    if($dni == $dniNumero.$letraCorrecta ){        
        return true;
    } else {        
        return false;
    }
}
//Funcion que validará si el usuario existe en la estructura de datos.
function validarUsuario($dni, $nombre, $apellido){
    //usamos un foreach para iterar en USUARIOS
    foreach (USUARIOS as $usuario){
        //comprobamos si el dni ya lo tenemos, de ser asi, el usuario está en el sistema
        if($dni == $usuario['dni'] && $nombre == $usuario['nombre'] && $apellido == $usuario['apellido']){            
            return true;  
        }else{            
            return false;
        }
    }
}
//funcion para comprobar fecha
function validarFecha($fecha): bool{
    if($fecha < date('Y-m-d')){        
        return false;
    }else{        
        return true;
    }
}
//funcion para comprobar los dias de la reserva
function duracionReserva($dias): bool{
    //casteamos a entero
    $diasEntero = (int) $dias;
    // comprobamos que el numero pasado y el entero coinciden
    if($dias == $diasEntero){
        //Ahora comprobamos que esté en el rango
        if ($dias >= 1 && $dias <= 30) {
            return true;
        } else {
            return false;
        }

    }else{
        return false;
    }
}
//funcion para comprobar la disponibilidad del coche
function cocheDisponible($coches, $vehiculo){
    //foreach para iterar el array coches 
    foreach($coches as $coche){
        if($vehiculo == $coche['modelo']){
            if($coche['disponible'] == true){                
                return true;
            }else{                
                return false;
            }
        }
    }
}



