<?php
//include("../../mostrar.php");

// Función para generar el código
function trigger_code($length, $connection) {
    $characters = '0123456789';
    $input_length = strlen($characters);
    $random_string = '';

    do {
        $random_string = '';
        for ($i = 1; $i <= $length; $i++) {
            $random_character = $characters[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
    } while (code_exists($random_string, $connection)); // Verificar si el código ya existe en la base de datos

    return $random_string;
}

// Función para verificar si el código ya existe en la BD
function code_exists($code, $connection) {

    $query = "SELECT * FROM Aprendices WHERE Codigo = '$code'";
    $result = $connection->query($query);
    
    return $result->num_rows > 0; // Si hay filas, el código existe
}

include('../../Conexiones/conexion.php');

// Generar un código único y mostrarlo
$unique_code = trigger_code(3, $con);

$con->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registro_apren.css">
    <title>Registro Formulario</title>
</head>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" text="text/css" href="../../css/registro_apren.css">
    <title>Registro Formulario</title>
  </head>
  <body>
    <div class="signupSection">
      <div class="info">
        <h2>BICIPARKING</h2>
        <br>
        <img src="../../img/logo_robot.png" height="250px" class="icon" aria-hidden="true">
        <p>¡Bienvenido aprendiz SENA!
          <br>
          <br>
          <br>
          Para que tengas mayor seguridad
          <br>
          te daremos un código único,
          <br>
          el cual tendras que utilizar
          <br>
          siempre que vayas a utilizar el BICIPARKING.
        </p>
      </div>
      <form action="../../Conexiones/conexion_registro.php" method="POST" class="signupForm" name="signupform">
        <h2>REGISTRARSE</h2>
        <ul class="noBullet">
          <li>
            <input class="datos inputFields" type="text" name="txtdoc" value="" autocomplete="off" placeholder="N° Documento" required>
          </li>
          <li>
            <input class="datos inputFields" type="text" name="txtnom" autocomplete="off" placeholder="Nombres" required>
          </li>
          <li>
            <input class="datos inputFields" type="text" name="txtape" autocomplete="off" placeholder="Apellidos" required>
          </li>
          <li>
            <input class="datos inputFields" type="text" name="txtficha" autocomplete="off" placeholder="N° Ficha" required>
          </li>
          <li>
            <input class="datos inputFields" type="text" name="txtcel" autocomplete="off" placeholder="Celular" required>
          </li>
          <li>
            <input class="datos inputFields" type="password" name="txtcontra" autocomplete="off" placeholder="Contraseña" required>
          </li>
          <li>
            <input type="text" id="join-btn-cod" name="txtcod" value="<?php echo $unique_code; ?>" readonly>
          </li>
          <li id="center-btn">
            <input type="submit" id="join-btn" name="registrar" alt="Registrarme" value="REGISTRARME">
          </li>
        </ul>
        <br>
        <p><a href="../../Contenido/inicio.html">Volver al inicio</a></p>
      </form>
    </div>
  </body>
</html>