<?php
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

session_start();
$_SESSION['usuario'] = $usuario;

include('../../Conexiones/conexion.php');

$sql = "SELECT * FROM Aprendices WHERE Codigo = '$usuario' AND Contraseña = '$contraseña'";
$result = mysqli_query($con, $sql);

$filas = mysqli_num_rows($result);
if ($filas) {
  header("Location: ../pages/perfil.php");
}else{
  echo "El código o la contraseña son incorrectos.";
}
mysqli_free_result($result);
mysqli_close($con);
?>