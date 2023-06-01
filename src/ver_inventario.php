<?php
// Conexión a la base de datos
require_once 'getconex.php';

// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión
//if (!isset($_SESSION['usuario'])) {
//  header('Location: ../login.php');
//  exit;
//}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Ver Inventario de Automóviles - Los Santos Customs</title>
    <link rel="stylesheet" type="text/css" href="../styles/style_ver_inventario.css">
</head>
<body>
    <header>
        <a class="menu-button" href="../menu.php">Regresar al Menú</a>
    </header>

    <h1>Ver Inventario de Automóviles</h1>

    <h2>EN EXISTENCIA</h2>

    <table>
        <tr>
            <th>Marca</th>
            <th>Tipo de auto</th>
            <th>Modelo</th>
            <th>Transmision</th>
            <th>Nombre</th>
            <th>Fecha de stock</th>
        </tr>

        <?php
        // Incluir el archivo getconex.php para la conexión a la base de datos
        include 'getconex.php';

        // Consulta SQL para obtener los datos de la tabla carros
        $query = "SELECT marca,tipoauto,modelo,transmision,nombre,fechaStock FROM tbinvauto where fechaStock < '2023-06-05'";

        // Ejecutar la consulta
        $result = sqlsrv_query($conectar, $query);

        // Verificar si la consulta fue exitosa
        if ($result !== false) {
            // Recorrer los resultados y mostrar los datos en la tabla
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $row['marca'] . '</td>';
                echo '<td>' . $row['tipoauto'] . '</td>';
                echo '<td>' . $row['modelo'] . '</td>';
                echo '<td>' . $row['transmision'] . '</td>';
                echo '<td>' . $row['nombre'] . '</td>';
                echo '<td>' . $row['fechaStock']->format('Y-m-d') . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="6">Error al obtener los datos del inventario</td></tr>';
        }

        // Cerrar la conexión a la base de datos
        sqlsrv_close($conectar);
        ?>
    </table>
    <h2>PROXIMO A LLEGAR</h2>
    <table>
        <tr>
            <th>Marca</th>
            <th>Tipo de auto</th>
            <th>Modelo</th>
            <th>Transmision</th>
            <th>Nombre</th>
            <th>Fecha de stock</th>
        </tr>

        <?php
        // Incluir el archivo getconex.php para la conexión a la base de datos
        include 'getconex.php';

        // Consulta SQL para obtener los datos de la tabla carros
        $query = "SELECT marca,tipoauto,modelo,transmision,nombre,fechaStock FROM tbinvauto where fechaStock > '2023-06-05'";

        // Ejecutar la consulta
        $result = sqlsrv_query($conectar, $query);

        // Verificar si la consulta fue exitosa
        if ($result !== false) {
            // Recorrer los resultados y mostrar los datos en la tabla
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $row['marca'] . '</td>';
                echo '<td>' . $row['tipoauto'] . '</td>';
                echo '<td>' . $row['modelo'] . '</td>';
                echo '<td>' . $row['transmision'] . '</td>';
                echo '<td>' . $row['nombre'] . '</td>';
                echo '<td>' . $row['fechaStock']->format('Y-m-d') . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="6">Error al obtener los datos del inventario</td></tr>';
        }

        // Cerrar la conexión a la base de datos
        sqlsrv_close($conectar);
        ?>
    </table>
</body>
</html>
