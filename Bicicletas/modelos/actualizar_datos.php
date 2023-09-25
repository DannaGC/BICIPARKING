<?php
session_start();

if (isset($_SESSION['usuario'])) {
  // Se verificar que el usuario haya iniciado sesión

  $codigo = $_POST['txtcodbici'];
  $new_color = $_POST['txtcolor'];
  $new_mod = $_POST['txtmod'];
  $new_caract = $_POST['txtcaract'];

  // Se realiza la conexión a la base de datos
  include("../../Conexiones/conexion.php");

  // Escapar los datos para evitar SQL Injection
  $codigo = mysqli_real_escape_string($con, $codigo);
  $new_color = mysqli_real_escape_string($con, $new_color);
  $new_mod = mysqli_real_escape_string($con, $new_mod);
  $new_caract = mysqli_real_escape_string($con, $new_caract);

  // Se ctualizan los datos en la base de datos
  $actualizar = "UPDATE Bicicletas SET 
    Color_bici = '$new_color',
    Modelo = '$new_mod',
    Car_bici = '$new_caract'
    WHERE Id = '$codigo'";

  if (mysqli_query($con, $actualizar)) {
      echo '<script>alert("Datos actualizados correctamente.");</script>';
  } else {
      echo "Error al actualizar los datos: " . mysqli_error($con);
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($con);
} else {
  echo "No has iniciado sesión.";
}
?>