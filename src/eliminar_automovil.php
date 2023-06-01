<?php
require_once 'getconex.php';

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idauto = $_POST['id'];

    // Eliminar el registro de la base de datos
    $queryDelete = "DELETE FROM tbinvauto WHERE idauto = $idauto";
    $resultDelete = sqlsrv_query($conectar, $queryDelete);

    if ($resultDelete === false) {
        echo 'Error al eliminar el registro de la base de datos.';
    } else {
        // Actualizar la página después de eliminar el registro
        header("Location: eliminar_automovil.php");
        exit();
    }
}

// Obtener los datos de la tabla tbinvauto
$queryData = "SELECT * FROM tbinvauto";
$resultData = sqlsrv_query($conectar, $queryData);

if ($resultData === false) {
    echo 'Error al obtener los datos de la base de datos.';
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Automovil</title>
    <link rel="stylesheet" type="text/css" href="../styles/style_ver_inventario.css">
</head>
<body>
    <header>
        <a class="menu-button" href="../menu.php">Regresar al Menú</a>
    </header>

    <h1>Eliminar Automovil</h1>
    <table>
        <tr>
            <th>IdAuto</th>
            <th>Marca</th>
            <th>Tipo de Auto</th>
            <th>Modelo</th>
            <th>Transmisión</th>
            <th>Nombre</th>
            <th>Acción</th>
        </tr>
        <?php while ($row = sqlsrv_fetch_array($resultData, SQLSRV_FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $row['idauto']; ?></td>
                <td><?php echo $row['marca']; ?></td>
                <td><?php echo $row['tipoauto']; ?></td>
                <td><?php echo $row['modelo']; ?></td>
                <td><?php echo $row['transmision']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['idauto']; ?>">
                        <input type="submit" value="Eliminar">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
