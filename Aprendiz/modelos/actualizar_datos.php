<?php
session_start();

if (isset($_SESSION['usuario'])) {
  // Se verificar que el usuario haya iniciado sesión

  $codigo = $_POST['txtcod'];
  $new_ficha = $_POST['txtficha'];
  $new_cel = $_POST['txtcel'];
  $new_contraseña = $_POST['txtcontra'];

  // Se realiza la conexión a la base de datos
  include("../../Conexiones/conexion.php");

  // Escapar los datos para evitar SQL Injection
  $codigo = mysqli_real_escape_string($con, $codigo);
  $new_ficha = mysqli_real_escape_string($con, $new_ficha);
  $new_cel = mysqli_real_escape_string($con, $new_cel);
  $new_contraseña = mysqli_real_escape_string($con, $new_contraseña);

  // Se ctualizan los datos en la base de datos
  $actualizar = "UPDATE Aprendices SET 
    Ficha = '$new_ficha',
    Cel = '$new_cel',
    Contraseña = '$new_contraseña'
    WHERE Codigo = '$codigo'";

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