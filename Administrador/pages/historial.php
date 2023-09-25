<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Inicio Administrador</title>
  </head>
  <body>
    <!-- NavBar -->
    <div class="w3-bar w3-light-grey w3-border">
      <a href="#" class="w3-bar-item w3-button w3-teal" style="font-size:30px"><i class="fa fa-home"></i></a>
      <a href="#" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-calendar"></i></a>
      <a href="#" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-refresh"></i></a>
      <a href="#" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-map-o"></i></a>
      <a href="#" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-sign-in"></i></a>
    </div>

    <!-- Tabla -->
    <table class=" w3-table-all w3-centered w3-striped w3-bordered w3-hoverable">
      <thead>
        <tr class="w3-light-grey">
          <th>Código</th>
          <th>Documento</th>
          <th>Nombre</th>
          <th>Ficha</th>
          <th>Celular</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include('../../Conexiones/conexion.php');

        $consultaAprendices = "SELECT * FROM Aprendices";
        $resultadoAprendices = $con->query($consultaAprendices);

        $consultaBicicletas = "SELECT * FROM Bicicletas";
        $resultadoBicicletas = $con->query($consultaBicicletas);

        if ($resultadoAprendices && $resultadoBicicletas) {
          while($row = $resultadoAprendices->fetch_assoc()) {
            $cod_usu = $row['Codigo'];
            $doc_usu = $row['Doc_usu'];
            $nom_usu = $row['Nom_usu'];
            $ape_usu = $row['Ape_usu'];
            $ficha = $row['Ficha'];
            $cel = $row['Cel'];
            $fecha_generacion = $row['Fecha_generación'];
        ?>
          <tr>
            <td><?php echo $cod_usu; ?></td>
            <td><?php echo $doc_usu; ?></td>
            <td><?php echo $nom_usu . " " . $ape_usu; ?></td>
            <td><?php echo $ficha; ?></td>
          </tr>

        <?php
          }
        ?>

        <?php
          while ($row = $resultadoBicicletas->fetch_assoc()) {
            $color_bici = $row['Color_bici'];
            $modelo_bici = $row['Modelo'];
            $car_bici = $row['Car_bici'];
        ?>
          <tr>
            <td><?php echo $color_bici; ?></td>
            <td><?php echo $modelo_bici; ?></td>
            <td><?php echo $car_bici; ?></td>
          </tr>

        <?php
          }
        } else {
            echo "Error en la consulta: " . $con->error;
        }
        ?>
      </tbody>
    </table>
  </body>
</html>