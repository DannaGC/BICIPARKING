<?php
// Verifica si se ha enviado el formulario
if (isset($_POST['registrar'])) {
  // Datos de conexión a la BD
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "BICIPARKING";

  // Crear la conexión
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Verificar la conexión
  if ($conn->connect_error) {
      die("Conexión fallida: " . $conn->connect_error);
  }

  // Se obtienen los datos del formulario
  $doc = $_POST['txtdoc'];
  $nom = $_POST['txtnom'];
  $ape = $_POST['txtape'];
  $ficha = $_POST['txtficha'];
  $cel = $_POST['txtcel'];
  $contra = $_POST['txtcontra'];
  $cod = $_POST['txtcod'];
  $fecha_registro = date("Y-m-d H:i:s");

  // Verificar si ya existe un usuario con el mismo número de documento en la BD
  $sql_doc = "SELECT * FROM Aprendices WHERE Doc_usu = '$doc'";
  $result_doc = $conn->query($sql_doc);

  // Se prepara la consulta SQL
  $sql = "INSERT INTO Aprendices (Doc_usu, Nom_usu, Ape_usu, Ficha, Cel, Contraseña, Codigo, Fecha_generación) 
  VALUES ('$doc', '$nom', '$ape', '$ficha', '$cel', '$contra', '$cod', '$fecha_registro')";

  if ($result_doc->num_rows > 0) {
      echo "Ya existe un usuario con este número de documento.";
  }else{
    // Se ejecuta la consulta
    $result = $conn->query($sql);
    if ($result === TRUE) {
      header("Location: ../Aprendiz/pages/datos_guardados.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  // Se cierra la conexión a la BD
  $conn->close();
}
?>