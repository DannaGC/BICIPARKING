<?php
// ...
if (isset($_POST['forget_code'])) {
    // Recuperar el número de documento proporcionado por el usuario
    $documento = $_POST['txtdoc_forget'];

    // Realizar una consulta para obtener el código del usuario
    $sql = "SELECT Codigo FROM Aprendices WHERE Doc_usu = '$documento'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $codigo = $row['Codigo'];

        // Mostrar el código al usuario
        echo "Su código actual es: $codigo";
    } else {
        // Mostrar un mensaje de error si no se encuentra el código en la base de datos
        echo "No se encontró un código asociado a ese número de documento.";
    }
}
// ...
?>
