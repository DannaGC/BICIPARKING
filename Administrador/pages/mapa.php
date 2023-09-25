<?php
include('../../Conexiones/conexion.php');

$mensaje = ""; // Inicializa la variable del mensaje

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['soltar'])) {
    $doc_usu = $_POST['documento'];

    // Busca el puesto ocupado por el estudiante
    $consulta = "SELECT Id_puesto FROM PuestosEstacionamiento WHERE Estado = 'Ocupado' AND doc_usu = ?";
    $stmt = $con->prepare($consulta);
    $stmt->bind_param("s", $doc_usu);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Encuentra el puesto ocupado por el estudiante y lo marca como disponible
        $stmt->bind_result($puesto_id);
        $stmt->fetch();

        // Actualiza el estado del puesto a "Disponible" y elimina el documento del estudiante
        $updateSql = "UPDATE PuestosEstacionamiento SET Estado = 'Disponible', doc_usu = NULL WHERE Id_puesto = ?";
        $stmt = $con->prepare($updateSql);
        if ($stmt === false) {
            echo "Error de preparación de la consulta: " . $con->error;
            exit();
        }

        $stmt->bind_param("i", $puesto_id);
        if (!$stmt->execute()) {
            echo "Error al ejecutar la consulta: " . $stmt->error;
            exit();
        }

        // Cierra la consulta preparada
        $stmt->close();

        // Redirige a la página actual con un mensaje de éxito
        header('Location: ' . $_SERVER['PHP_SELF'] . '?soltado=true');
        exit();
    } else {
        // No se encontró un puesto ocupado por el estudiante
        echo "El documento del estudiante no tiene un puesto ocupado.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apartar'])) {
    // Obtiene el documento y el nombre del estudiante del formulario
    $doc_usu = $_POST['documento'];
    $nombre_estudiante = $_POST['nombre'];

    // Verifica si el documento del estudiante existe en la tabla Aprendices
    $consulta = "SELECT Doc_usu FROM Aprendices WHERE Doc_usu = ?";
    $stmt = $con->prepare($consulta);
    $stmt->bind_param("s", $doc_usu);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Verifica si el estudiante ya tiene un puesto asignado
        $consulta_puesto = "SELECT Id_puesto FROM PuestosEstacionamiento WHERE doc_usu = ?";
        $stmt = $con->prepare($consulta_puesto);
        $stmt->bind_param("s", $doc_usu);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "El estudiante ya tiene un puesto asignado.";
        } else {
            // Encuentra el primer puesto disponible en la tabla PuestosEstacionamiento
            $sql = "SELECT Id_puesto FROM PuestosEstacionamiento WHERE Estado = 'Disponible' LIMIT 1";
            $result = $con->query($sql);

            if ($result === false) {
                // Manejo de errores
                echo "Error en la consulta: " . $con->error;
                exit();
            }

            // Obtiene el número de puesto otorgado
            $numeroPuestoOtorgado = null;
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $numeroPuestoOtorgado = $row["Id_puesto"];

                // Actualiza el estado del puesto a "Ocupado" y asocia el usuario
                $updateSql = "UPDATE PuestosEstacionamiento SET Estado = 'Ocupado', doc_usu = ? WHERE Id_puesto = ?";
                $stmt = $con->prepare($updateSql);
                if ($stmt === false) {
                    echo "Error de preparación de la consulta: " . $con->error;
                    exit();
                }

                $stmt->bind_param("si", $doc_usu, $numeroPuestoOtorgado);
                if (!$stmt->execute()) {
                    echo "Error al ejecutar la consulta: " . $stmt->error;
                    exit();
                }

                // Cierra la consulta preparada
                $stmt->close();

                // Redirige a la página actual con el número de puesto otorgado
                header('Location: ' . $_SERVER['PHP_SELF'] . '?puesto=' . $numeroPuestoOtorgado);
                exit();
            }
        }
    } else {
        // El documento del estudiante no existe en la tabla Aprendices
        echo "Documento de estudiante no válido. Verifica el documento ingresado.";
    }
}

// Consulta SQL para obtener la cantidad de espacios disponibles
$sql = "SELECT COUNT(*) AS total_disponibles FROM PuestosEstacionamiento WHERE Estado = 'Disponible'";
$result = $con->query($sql);

if ($result === false) {
    // Manejo de errores
    echo "Error en la consulta: " . $con->error;
    exit;
}

// Obtiene el número total de espacios disponibles
$total_disponibles = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_disponibles = $row["total_disponibles"];
}

// Calcula la cantidad de espacios disponibles para cada sección
$espacios_seccion1 = ceil($total_disponibles / 2); // Redondea hacia arriba
$espacios_seccion2 = $total_disponibles - $espacios_seccion1;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" text="text/css" href="../../css/styles_mapa.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Black+Ops+One&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Cabin+Condensed&family=PT+Serif:wght@700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>BICIPARKING</title>
</head>

<body>
  <!-- NavBar -->
      <div class="w3-bar w3-black w3-border">
        <a href="ingresos.php" class="w3-bar-item w3-button w3-aqua" style="font-size:30px; color:black;"><i class="fa fa-home"></i></a>
        <a href="listado.php" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-address-book"></i></a>
        <a href="#" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-calendar"></i></a>
        <a href="mapa.php" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-map-o"></i></a>
        <a href="../../Contenido/inicio.html" class="w3-bar-item w3-button" style="font-size:30px"><i class="fa fa-sign-in"></i></a>
      </div>
    <div class="titulo">
        <h2 class="fa-beat-fade" style="--fa-animation-duration: 2s;">BICIPARKING</h2>
    </div>
    <div class="cont">
        <div class="seccion">
            <div class="n">
                <h1>Sección 1</h1>
                <img src="../../img/bicicleta.png">
            </div>
            <div class="f">
                <h2>Espacios disponibles: <span><?php echo $espacios_seccion1; ?></span></h2>
            </div>
        </div>

        <div class="seccion">
            <div class="n">
                <h1>Sección 2</h1>
                <img src="../../img/bicicleta.png">
            </div>
            <div class="f">
                <h2>Espacios disponibles: <span><?php echo $espacios_seccion2; ?></span></h2>
            </div>
        </div>
    </div>
    <div class="bot">
        <div class="formulario2">
        <form method="post">
           <h1>Ingresa tu <br>
            informacion</h1>
            <input class="j" type="text" name="documento" autocomplete="off" placeholder="Documento del estudiante" required>
            <br>
            <input class="j" type="text" name="nombre" autocomplete="off" placeholder="Nombre del estudiante" required>
            <br>
            <button type="submit" name="apartar">Usar</button>
        </form>
        </div>
    </div>
    
    <?php
    if (isset($_GET['puesto'])) {
        $numeroPuestoOtorgado = $_GET['puesto'];
        echo '<div class="puesto">';
        echo '<div class="conte">';
        echo '<h1>Bienvenido</h1>';
        echo '<h1>Tu puesto es: ' . $numeroPuestoOtorgado . '</h1>';
        echo '</div>';
        echo '</div>';
    }
    ?>
 
    <script src="../../js/disponible.js"></script>
    <script src="../../js/inicio.js"></script>
</body>
</html>