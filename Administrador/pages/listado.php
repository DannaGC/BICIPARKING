<?php
include('../../Conexiones/conexion.php');

// Consulta SQL para obtener todos los puestos de estacionamiento
$sql = "SELECT Id_puesto, Estado, Doc_usu FROM PuestosEstacionamiento";
$result = $con->query($sql);

if ($result === false) {
    // Manejo de errores si la consulta falla
    echo "Error en la consulta: " . $con->error;
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="../../css/styles_listado.css">
    <title>Puestos - BICIPARKING</title>
</head>
<body>
<!-- NavBar -->
<div class="w3-bar w3-black w3-border">
      <a href="#" class="w3-bar-item w3-button w3-aqua" style="font-size:30px; color:black;"><i class="fa fa-home"></i></a>
      <a href="listado.php" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-address-book"></i></a>
      <a href="#" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-calendar"></i></a>
      <a href="mapa.php" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-map-o"></i></a>
      <a href="../../Contenido/inicio.html" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-sign-in"></i></a>
    </div>
    <div class="l">
    <div class="intro">
        <h1>¡BIENVENIDO ADMINISTRADOR!</h1>
    </div>
    </div>
    <div class="tabla">
<table>
    <thead>
        <tr>
            <th>ID Puesto</th>
            <th>Estado</th>
            <th>Documento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Verifica si la consulta se realizó con éxito
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Id_puesto"] . "</td>";
                echo "<td>" . $row["Estado"] . "</td>";

                // Muestra el documento del estudiante
                echo "<td>" . $row["Doc_usu"] . "</td>";

                // Agrega el botón para cambiar el estado y abrir la ventana modal
                echo '<td>';
                echo '<button onclick="abrirModal(' . $row["Id_puesto"] . ', \'' . $row["Estado"] . '\')">Cambiar Estado</button>';
                echo '</td>';
                echo "</tr>";
            }
        } else {
            // Manejo de errores si $result no es válido
            echo "Error en la consulta: " . $con->error;
        }
        ?>
    </tbody>
</table>
</div>
<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="cerrarModal()">&times;</span>
    <h2>Cambiar Estado del Puesto</h2>
    <form method="post" action="cambiar_estado.php">
      <input type="hidden" id="modal_puesto_id" name="puesto_id" value="">
      <input type="hidden" id="modal_estado_actual" name="estado_actual" value="">
      <input class="letra"type="text" id="modal_cedula_estudiante" name="cedula_estudiante" placeholder="Documento">
      <button type="submit">Guardar Cambio</button>
    </form>
</div>
</div>
<script src="../../js/modal.js"></script>
<script src="../../js/inicio.js"></script>
</body>
</html>