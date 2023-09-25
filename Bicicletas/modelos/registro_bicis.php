<?php
include('../../Conexiones/conexion.php');

// Se obtienen los datos del formulario
$id = $_POST['txtcodbici'];
$color = $_POST['txtcolor'];
$modelo = $_POST['txtmod'];
$caract = $_POST['txtcaract'];

// Se prepara la consulta SQL
$sql = "INSERT INTO Bicicletas (Id, Color_bici, Modelo, Car_bici) VALUES ('$id', '$color', '$modelo', '$caract')";

$result = $con->query($sql);
if ($result === TRUE) {
    header("Location: ../pages/datos_guardados.html");
}else{
    echo "Error: " . $sql . "<br>" . $con->error;
}

// Se cierra la conexión a la BD
$con->close();

?>