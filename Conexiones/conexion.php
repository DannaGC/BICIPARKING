<?php
// Datos de conexión a la BD
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BICIPARKING";

 // Crear la conexión
 $con = new mysqli($servername,$username,$password,$dbname);

 if($con->connect_error)
    echo "Conexión fallida";

?>