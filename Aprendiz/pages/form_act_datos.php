<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" text="text/css" href="../../css/styles_act_apren.css">
      <title>Registro Formulario</title>
  </head>
  <body>
    <div class="signupSection">
      <div class="info">
        <h2>BICIPARKING</h2>
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
        <form action="../modelos/actualizar_datos.php" method="POST" class="signupForm" name="signupform">
          <h2>ACTUALIZAR DATOS</h2>
          <ul class="noBullet">
          <?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>
            <li>
              <input class="datos inputFields" type="text" name="txtcod" autocomplete="off" placeholder="Código" required>
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
            <li id="center-btn">
              <input type="submit" id="join-btn" name="actualizar" alt="Actualizar Datos" value="ACTUALIZAR DATOS">
            </li>
          </ul>
          <br>
          <p><a href="perfil.html">Volver al perfil</a></p>
        </form>
    </div>
  </body>
</html>