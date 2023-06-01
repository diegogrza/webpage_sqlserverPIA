<?php

require_once 'getconex.php';
session_start();

// Consulta SQL para obtener las opciones
$query = "SELECT marca FROM tbmarca";
$result = sqlsrv_query($conectar, $query);

$queryAnos = "SELECT ano FROM tbano";
$resultAnos = sqlsrv_query($conectar, $queryAnos);

$queryTransmision = "SELECT tipotransm FROM tbTipoTransm";
$resultTransm = sqlsrv_query($conectar, $queryTransmision);

// Verificar si la consulta de transmisión fue exitosa
if ($resultTransm !== false) {
    $opcionesTransm = array();
    while ($rowTransm = sqlsrv_fetch_array($resultTransm, SQLSRV_FETCH_ASSOC)) {
        $opcionesTransm[] = $rowTransm['tipotransm'];
    }
} else {
    echo 'Error al obtener las opciones de tipo de transmisión';
}

// Verificar si la consulta de años fue exitosa
if ($resultAnos !== false) {
    $opcionesAnos = array();
    while ($rowAno = sqlsrv_fetch_array($resultAnos, SQLSRV_FETCH_ASSOC)) {
        $opcionesAnos[] = $rowAno['ano'];
    }
} else {
    echo 'Error al obtener las opciones de años';
}

// Verificar si la consulta de marcas fue exitosa
if ($result !== false) {
    $opciones = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $opciones[] = $row['marca'];
    }
} else {
    echo 'Error al obtener las opciones de la marca';
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores enviados desde el formulario
    $marca = $_POST['marca'];
    $ano = $_POST['ano'];
    $transmision = $_POST['transmision'];
    $tipo = $_POST['tipo'];
    $auto = $_POST['auto'];
    $fecha = $_POST['fecha'];

    // Validar campos requeridos
    if (empty($marca) || empty($ano) || empty($transmision) || empty($tipo) || empty($auto) || empty($fecha)) {
        echo '<script>alert("Por favor, complete todos los campos.");</script>';
    } else {
        // Realizar la consulta SQL de INSERT
        $queryInsert = "INSERT INTO tbinvauto (marca, tipoauto, modelo, transmision, nombre, fechaStock) VALUES (?, ?, ?, ?, ?, ?)";

        // Preparar la consulta
        $stmt = sqlsrv_prepare($conectar, $queryInsert, array(&$marca, &$tipo, &$ano, &$transmision, &$auto, &$fecha));

        // Ejecutar la consulta
        if (sqlsrv_execute($stmt)) {
            header('Location: ver_inventario.php');
        } else {
            echo '<script>alert("Error al insertar el registro.");</script>';
        }

        // Cerrar la declaración
        sqlsrv_free_stmt($stmt);
    }
}

// Cerrar la conexión
sqlsrv_close($conectar);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Agrega un auto</title>
    <link rel="stylesheet" type="text/css" href="../styles/style_insert.css">
</head>
<body>

    <header>
        <button onclick="window.location.href='../menu.php'">Regresar al menú</button>
    </header>
    <h1>Agrega un auto nuevo</h1>
    <form method="POST">
        <label for="marca">Selecciona una marca:</label>
        <select name="marca" id="marca">
            <?php foreach ($opciones as $opcionMarca) : ?>
                <option value="<?php echo $opcionMarca; ?>"><?php echo $opcionMarca; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="ano">Selecciona un año:</label>
        <select name="ano" id="ano">
            <?php foreach ($opcionesAnos as $opcionAno) : ?>
                <option value="<?php echo $opcionAno; ?>"><?php echo $opcionAno; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="transmision">Selecciona un tipo de transmisión:</label>
        <select name="transmision" id="transmision">
            <?php foreach ($opcionesTransm as $opcionTrans) : ?>
                <option value="<?php echo $opcionTrans; ?>"><?php echo $opcionTrans; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="tipo">Tipo de auto: </label>
        <input type="text" name="tipo" id ="tipo">
        <br>
        <label for="auto">Nombre del auto: </label>
        <input type="text" name="auto" id ="auto">
        <br>
        <label for="fecha">Selecciona una fecha:</label>
        <input type="date" id="fecha" name="fecha">
        <br><br>

        <input type="submit" value="Enviar">

    </form>
</body>
</html>
