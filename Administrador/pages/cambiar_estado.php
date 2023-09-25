<?php
include('../../Conexiones/conexion.php');

$mensaje = ""; // Inicializa la variable del mensaje

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el ID del puesto, el estado actual y la cédula del formulario
    $puesto_id = $_POST["puesto_id"];
    $estado_actual = $_POST["estado_actual"];
    $cedula_estudiante = $_POST["cedula_estudiante"];

    // Verificar si el puesto ya está ocupado por otro estudiante
    $verificar_puesto_ocupado = "SELECT Estado, Doc_usu FROM PuestosEstacionamiento WHERE Id_puesto = $puesto_id";
    $result = $con->query($verificar_puesto_ocupado);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $estado_puesto = $row["Estado"];
        $doc_usu_puesto = $row["Doc_usu"];
        
        if ($estado_puesto === "Ocupado" && $doc_usu_puesto !== $cedula_estudiante) {
            $mensaje = "Este puesto ya está ocupado por otro estudiante.";
        } else {
            // Verifica si el estado cambia de "Ocupado" a "Disponible"
            if ($estado_actual === "Ocupado") {
                // Verifica si la cédula proporcionada coincide con la del puesto
                if ($doc_usu_puesto === $cedula_estudiante) {
                    $nuevo_estado = "Disponible";

                    // Borra la información del estudiante
                    $borrar_informacion_estudiante = "UPDATE PuestosEstacionamiento SET Doc_usu = NULL, Estado = '$nuevo_estado' WHERE Id_puesto = $puesto_id";
                    if ($con->query($borrar_informacion_estudiante) === FALSE) {
                        $mensaje = "Error al borrar la información del estudiante: " . $con->error;
                    } else {
                        $mensaje = "Soltaste el puesto correctamente.";
                    }
                } else {
                    $mensaje = "La cédula proporcionada no coincide con la del estudiante que ocupa el puesto.";
                }
            } else {
                // Verifica si la cédula del estudiante existe en la base de datos
                $verificar_cedula = "SELECT Doc_usu FROM Aprendices WHERE Doc_usu = '$cedula_estudiante'";
                $result = $con->query($verificar_cedula);

                if ($result->num_rows === 0) {
                    $mensaje = "La cédula proporcionada no existe";
                } else {
                    // Verifica si la cédula ya está asociada a otro puesto
                    $verificar_cedula_puesto = "SELECT Id_puesto FROM PuestosEstacionamiento WHERE Doc_usu = '$cedula_estudiante'";
                    $result = $con->query($verificar_cedula_puesto);

                    if ($result->num_rows > 0) {
                        $mensaje = "Esta cédula ya está asociada a otro puesto.";
                    } else {
                        // Actualiza el estado y asigna la cédula al estudiante
                        $sql = "UPDATE PuestosEstacionamiento SET Estado = 'Ocupado', Doc_usu = '$cedula_estudiante' WHERE Id_puesto = $puesto_id";

                        if ($con->query($sql) === TRUE) {
                            $mensaje = "Tomaste el puesto correctamente.";
                        } else {
                            $mensaje = "Error al cambiar el estado: " . $con->error;
                        }
                    }
                }
            }
        }
    }
}

// Consulta SQL para obtener todos los puestos de estacionamiento
$sql = "SELECT Id_puesto, Estado, Doc_usu FROM PuestosEstacionamiento";
$result = $con->query($sql);

if ($result === false) {
    // Manejo de errores si la consulta falla
    $mensaje = "Error en la consulta: " . $con->error;
}
?>

<!-- Agrega JavaScript para mostrar el mensaje y redireccionar -->
<script>
    var mensaje = "<?php echo $mensaje; ?>";
    if (mensaje !== "") {
        alert(mensaje);
        window.location.href = "../../Administrador/pages/listado.php"; // Redirige al listado
    }
</script>