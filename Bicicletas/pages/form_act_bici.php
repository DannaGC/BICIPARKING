<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" text="text/css" href="../../css/registro_bici.css">
  <title>Registro Datos Bicicleta</title>
</head>
<body>
<div class="signupSection">
    <div class="info">
        <h2>BICIPARKING</h2>
        <img src="../../img/logo_robot.png" height="250px" class="icon" aria-hidden="true">
        <p>¡Hola, aprendiz SENA!
            <br>
            <br>
            <br>
            Aqui podras ingresar los
            <br>
            datos de tu bicicleta.
        </p>
    </div>
    <form action="../modelos/actualizar_datos.php" method="POST" class="signupForm" name="signupform">
        <h2>ACTUALIZAR DATOS DE MI BICI</h2>
        <ul class="noBullet">
        <?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>
            <li>
                  <input class="datos inputFields" type="text" name="txtcodbici" autocomplete="off" placeholder="Código único" required>
            </li>
            <li>
                <input class="datos inputFields" type="text" name="txtcolor" autocomplete="off" placeholder="Color" required>
            </li>
            <li>
                <input class="datos inputFields" type="text" name="txtmod" autocomplete="off" placeholder="Modelo" required>
            </li>
            <li>
                <input class="datos inputFields" type="text" name="txtcaract" autocomplete="off" placeholder="Características" required>
            </li>
            <li id="center-btn">
              <input type="submit" id="join-btn" name="actualizar" alt="Actualizar Datos" value="ACTUALIZAR DATOS">
            </li>
        </ul>
        <br>
        <p><a href="../../Aprendiz/pages/perfil.html">Volver al perfil</a></p>
    </form>
</div>
</body>
</html>