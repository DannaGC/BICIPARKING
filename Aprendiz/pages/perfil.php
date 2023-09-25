<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title> BICIPARKING - Mi Perfil </title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./css/redes.css/redes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" text="text/css" href="../../css/styles_perfil.css">
</head>
<body>
  <div class="w3-top">
    <div class="w3-bar w3-left-align w3-large">
        <a href="#" class="fa-beat-fade w3-bar-item w3-button w3-text-aqua w3-xlarge" style="--fa-animation-duration: 2s;"><i class="fa fa-bicycle w3-margin-right"></i>BICIPARKING</a>
        <a href="../../Bicicletas/pages/registro_bici.php" class="w3-bar-item w3-button w3-large" title="Actualizar Datos"><i class="fa fa-pencil"></i> Registrar los datos de mi bicicleta</a>
        <a href="form_act_datos.php" class="w3-bar-item w3-button w3-large" title="Actualizar Datos"><i class="fa fa-pencil w3-large"></i>Actualizar mis datos</a>
        <a href="../../Bicicletas/pages/form_act_bici.php" class="w3-bar-item w3-button w3-large" title="Actualizar Datos"><i class="fa fa-pencil"></i> Actualizar los datos de mi bicicleta</a>
        <a href="../../Contenido/inicio.html" class="w3-right-align w3-bar-item w3-button w3-text-red w3-large" title="Cerrar Sesión"><i class="fa fa-sign-out"></i> Cerrar Sesión</a>
    </div>
  </div>
  <div class="wrapper">    
    <div class="container">
        <div class="wrapper">
            <h3 class="fa-beat-fade" style="--fa-animation-duration: 2s;">MI PERFIL</h3>
            <label for="foto_propietario" style="cursor: pointer;">
                <i class="fa-solid fa fa-user fa-flip fa-3x" style="--fa-animation-duration: 4s; color: aqua;"></i>
                <input type="file" id="foto_propietario" accept="image/*" style="display: none;">
            </label>
            <img id="imagen_propietario" src="" alt="Foto del Propietario" style="width:150px;height:150px">
            <button class="w3-button w3-circle w3-red x-button" onclick="eliminarImagen('imagen_propietario')"><i class="fa fa-times"></i></button>

            <label for="foto_bicicleta" style="cursor: pointer;">
                <i class="fa-solid fa fa-bicycle fa-flip fa-3x" style="--fa-animation-duration: 4s; color: aqua;"></i>
                <input type="file" id="foto_bicicleta" accept="image/*" style="display: none;">
            </label>
            <img id="imagen_bicicleta" src="" alt="Foto de la Bicicleta" style="width:150px;height:150px">
            <button class="w3-button w3-circle w3-red x-button" onclick="eliminarImagen('imagen_bicicleta')"><i class="fa fa-times"></i></button>
            <br>
            <div class="contenedor">
            <div class="columna1">
              <h4><strong>Información del Parqueadero</strong></h4>
              <p><strong>Ubicación:</strong> Calle Principal, Ciudad</p>
              <p><strong>Horario de Operación:</strong> 6:00 AM - 10:00 PM</p>
              <p><strong>Estado Actual:</strong> <span id="estadoParqueadero"></span></p>
              <p><strong>Espacios Disponibles:</strong> 80</p>
              <p><strong>Reloj:</strong> <span id="reloj"></span></p>
            </div>
            <div class="columna2">
            <?php
              include("../../Conexiones/conexion.php");

              if(isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
                $usuario = mysqli_real_escape_string($con, $_SESSION['usuario']);

                $sql = "SELECT Color_bici, Modelo, Car_bici FROM Bicicletas WHERE Id = '$usuario'";

                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
          
                  $color = htmlspecialchars($row["Color_bici"]);
                  $modelo = htmlspecialchars($row["Modelo"]);
                  $caract = htmlspecialchars($row["Car_bici"]);
                } else {
                  echo "No se encontraron datos de bicicleta para este usuario.";
                }
              }else{
                echo "No se ha iniciado sesión o el código de bicicleta no es válido.";
              }
            ?>
              <h4><strong>Informacion de mi Bicicleta</strong></h4>
              <p><strong>Código:</strong> <?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?></p>
              <?php if (isset($color)) : ?>
                <p><strong>Color: <?php echo $color; ?></strong></p>
              <?php endif; ?>
              <?php if (isset($modelo)) : ?>
                <p><strong>Modelo: <?php echo $modelo; ?></strong></p>
              <?php endif; ?>
              <?php if (isset($caract)) : ?>
                <p><strong>Caracteristicas: <?php echo $caract; ?></strong></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../../js/perfil.js"></script>
</body>
</html>