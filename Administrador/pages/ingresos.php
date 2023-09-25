<?php
include('../../Conexiones/conexion.php');

// Consulta SQL para obtener todos los puestos de estacionamiento
$sql = "SELECT Id_puesto, Estado, doc_usu FROM PuestosEstacionamiento";
$result = $con->query($sql);

if ($result === false) {
  // Manejo de errores si la consulta falla
  echo "Error en la consulta: " . $con->error;
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Black+Ops+One&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Cabin+Condensed&family=PT+Serif:wght@700&display=swap">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" text="text/css" href="../../css/styles_ingresos.css">
    <title>Inicio Administrador</title>
    <style>
      .w3-theme-l1 { !important;background-color:#33ffff !important}
      .w3-theme-d3 {color:#fff !important; background-color:#006868 !important}
    </style>
  </head>
  <body>
    <!-- NavBar -->
    <div class="w3-bar w3-black w3-border">
      <a href="#" class="w3-bar-item w3-button w3-theme-l1" style="font-size:30px; color:black;"><i class="fa fa-home"></i></a>
      <a href="#" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-address-book"></i></a>
      <a href="#" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-calendar"></i></a>
      <a href="#" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-map-o"></i></a>
      <a href="../modelos/cerrar_sesion.php" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-sign-in"></i></a>
    </div>
    <div class="container">
      <h1>Registrar un ingreso</h1>
      <form action="ingresos.php" method="POST">
          <input type="text" class="inputFields" name="codigo" autocomplete="off" placeholder="Digite el código" required>
          <input type="submit" class="btn-buscar" value="Buscar">
      </form>
      <div id="resultado"></div>
    </div>

    <!-- Tabla -->
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Ficha</th>
                <th>Documento</th>
                <th>Celular</th>
                <th>Cicla</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php
          include("../../Conexiones/conexion.php");

          // Se obtiene el código ingresado por el administrador
          $cod_ingreso = $_POST['codigo'];

          // Se realiza la consulta SQL para buscar los datos
          $sql = "SELECT * FROM Aprendices a JOIN Bicicletas b ON a.Codigo = b.Id WHERE codigo = '$cod_ingreso'";
          $result = $con->query($sql);

          if ($result->num_rows > 0) {
              // Mostrar los datos en la tabla existente
              $row = $result->fetch_assoc();
              echo "<tr>";
              echo "<td>" . $row["Codigo"] . "</td>";
              echo "<td>" . $row["Nom_usu"] . "</td>";
              echo "<td>" . $row["Ape_usu"] . "</td>";
              echo "<td>" . $row["Ficha"] . "</td>";
              echo "<td>" . $row["Doc_usu"] . "</td>";
              echo "<td>" . $row["Cel"] . "</td>";
              echo "<td>" . $row["Color_bici"]." ".$row['Modelo'] . "</td>";
        ?>
              <td><button class="btn" onclick="inicializar(this)">Iniciar</button></td>
        <?php
              echo "</tr>";
          } else {
              echo "No se encontraron datos para el código proporcionado.";
          }

          // Se cierrar la conexión a la BD
          $con->close();
        ?>
        </tbody>
    </table>
    <script>
      function inicializar(boton) {
        if (boton.innerHTML === "Iniciar") {
          boton.innerHTML = "Finalizar";
        }else{
          boton.innerHTML = "Iniciar";
        }
      }
    </script>
  </body>
</html>