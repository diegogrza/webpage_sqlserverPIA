<?php
require_once 'getconex.php';

// Obtener los datos de la tabla tbinvautos
$queryData = "SELECT * FROM tbinvauto";
$resultData = sqlsrv_query($conectar, $queryData);

if ($resultData === false) {
    echo 'Error al obtener los datos de la base de datos.';
    exit();
}

// Consulta SQL para obtener las opciones
$query = "SELECT marca FROM tbmarca";
$result = sqlsrv_query($conectar, $query);

$queryAnos = "SELECT ano FROM tbano";
$resultAnos = sqlsrv_query($conectar, $queryAnos);

$queryTransmision = "SELECT tipotransm FROM tbTipoTransm";
$resultTransm = sqlsrv_query($conectar, $queryTransmision);

$queryId = "Select idauto from tbinvauto";
$resultId = sqlsrv_query($conectar,$queryId);


// Verificar si la consulta de transmisión fue exitosa
if ($resultTransm !== false) {
    $opcionesTransm = array();
    while ($rowTransm = sqlsrv_fetch_array($resultTransm, SQLSRV_FETCH_ASSOC)) {
        $opcionesTransm[] = $rowTransm['tipotransm'];
    }
} else {
    echo 'Error al obtener las opciones de tipo de transmisión';
}

// Verificar si la consulta de transmisión fue exitosa
if ($resultId !== false) {
    $opcionesId = array();
    while ($rowId = sqlsrv_fetch_array($resultId, SQLSRV_FETCH_ASSOC)) {
        $opcionesId[] = $rowId['idauto'];
    }
} else {
    echo 'Error al obtener las opciones de ID';
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

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idauto = $_POST['id'];
    $marca = $_POST['marca'];
    $tipoauto = $_POST['tipoauto'];
    $modelo = $_POST['ano'];
    $transmision = $_POST['transmision'];
    $nombre = $_POST['nombre'];

    // Actualizar los datos en la base de datos
    $queryUpdate = "UPDATE tbinvauto SET marca = '$marca', tipoauto = '$tipoauto', modelo = '$modelo', transmision = '$transmision', nombre = '$nombre' WHERE idauto = $idauto";
    $resultUpdate = sqlsrv_query($conectar, $queryUpdate);

    if ($resultUpdate === false) {
        echo 'Error al actualizar los datos en la base de datos.';
    } else {
        header("Location: actualizar_automovil.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Autos</title>
    <link rel="stylesheet" type="text/css" href="../styles/style_update.css">

</head>
<body>
    <div class="table-container">
        <button onclick="window.location.href='../menu.php'">Regresar al menú</button>
        <h1>Tabla de Autos</h1>
        <table>
            <tr>
                <th>IdAuto</th>
                <th>Marca</th>
                <th>Tipo de Auto</th>
                <th>Modelo</th>
                <th>Transmisión</th>
                <th>Nombre</th>
            </tr>
            <?php while ($row = sqlsrv_fetch_array($resultData, SQLSRV_FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['idauto']; ?></td>
                    <td><?php echo $row['marca']; ?></td>
                    <td><?php echo $row['tipoauto']; ?></td>
                    <td><?php echo $row['modelo']; ?></td>
                    <td><?php echo $row['transmision']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="form-container">
        <h2>Modificar Registro</h2>
        <form method="POST">
            <div class="select-container">
                <label for="id">Selecciona ID del vehiculo para actualizar:</label>
                <select name="id" id="id">
                    <?php foreach ($opcionesId as $opcionId) : ?>
                        <option value="<?php echo $opcionId; ?>"><?php echo $opcionId; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="select-container">
                <label for="marca">Selecciona una marca:</label>
                <select name="marca" id="marca">
                    <?php foreach ($opciones as $opcionMarca) : ?>
                        <option value="<?php echo $opcionMarca; ?>"><?php echo $opcionMarca; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="select-container">
                <label for="ano">Selecciona un año:</label>
                <select name="ano" id="ano">
                    <?php foreach ($opcionesAnos as $opcionAno) : ?>
                        <option value="<?php echo $opcionAno; ?>"><?php echo $opcionAno; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="select-container">
                <label for="transmision">Selecciona un tipo de transmisión:</label>
                <select name="transmision" id="transmision">
                    <?php foreach ($opcionesTransm as $opcionTrans) : ?>
                        <option value="<?php echo $opcionTrans; ?>"><?php echo $opcionTrans; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label for="tipoauto">Tipo de Auto:</label>
            <input type="text" name="tipoauto" id="tipoauto"><br>

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre"><br>

            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>
