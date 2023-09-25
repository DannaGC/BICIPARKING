<?php
if (isset($_POST['restablecer'])) {
  $codigo = $_POST['numcod'];
  $nuevaContraseña = $_POST['nueva_contra'];

  // Verificar si el código proporcionado es válido
  $documento = $_POST['numdoc'];
  $sql = "SELECT * FROM Aprendices WHERE Doc_usu = '$documento' AND Codigo = '$codigo'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 1) {
      // El código es válido, actualiza la contraseña
      $hashedPassword = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
      $updateSql = "UPDATE Aprendices SET Contraseña = '$hashedPassword', Codigo = NULL WHERE Doc_usu = '$documento'";
      $updateResult = mysqli_query($conn, $updateSql);

      if ($updateResult) {
          echo "Contraseña actualizada con éxito. Ahora puedes iniciar sesión con tu nueva contraseña.";
      } else {
          echo "Hubo un error al actualizar la contraseña.";
      }
  } else {
      echo "El código proporcionado no es válido.";
  }
}
?>
