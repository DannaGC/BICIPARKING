<?php
require ('../../Conexiones/conexion.php');

function iniciarSesion($codigo, $password) {
  // Comprueba si el usuario y la contraseña son correctos
  $sql = "SELECT * FROM Aprendices WHERE Codigo = '{$codigo}' AND Contrasena = '{$password}'";
  $result = mysqli_query($con, $sql);

  // Si el usuario existe, inicia la sesión
  if (mysqli_num_rows($result) > 0) {
    $fila = mysqli_fetch_assoc($result);
    $_SESSION['Codigo'] = $fila['Codigo'];
    $_SESSION['Doc_usu'] = $fila['Doc_usu'];
    return true;
  } else {
    // El usuario o la contraseña no son correctos
    return false;
  }
}

function verificarInicioSesion() {
  // Si no hay una sesión iniciada, redirige al usuario a la página de inicio de sesión
  if (!isset($_SESSION['Codigo'])) {
    header('Location: ../pages/rol_aprendiz.html');
    exit;
  }
}

session_start();

if (iniciarSesion($_POST['codigo'], $_POST['password'])) {
  // El usuario está iniciado sesión
  header('Location: ../../Contenido/inicio.html');
} else {
  // El usuario no está iniciado sesión
  echo 'El código o la contraseña no son correctos.';
}
?>