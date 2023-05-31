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

    <table>
        <tr>
            <th>Carro</th>
            <th>Marca</th>
            <th>Tipo</th>
            <th>Puertas</th>
            <th>Precio</th>
            <th>Cantidad actual</th>
        </tr>

        <?php
        // Incluir el archivo getconex.php para la conexión a la base de datos
        include 'getconex.php';

        // Consulta SQL para obtener los datos de la tabla carros
        $query = "SELECT Carro, Marca, Tipo, Puertas, Precio, CantidadActual FROM carros";

        // Ejecutar la consulta
        $result = sqlsrv_query($conectar, $query);

        // Verificar si la consulta fue exitosa
        if ($result !== false) {
            // Recorrer los resultados y mostrar los datos en la tabla
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $row['Carro'] . '</td>';
                echo '<td>' . $row['Marca'] . '</td>';
                echo '<td>' . $row['Tipo'] . '</td>';
                echo '<td>' . $row['Puertas'] . '</td>';
                echo '<td>' . $row['Precio'] . '</td>';
                echo '<td>' . $row['CantidadActual'] . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="6">Error al obtener los datos del inventario</td></tr>';
        }

        // Cerrar la conexión a la base de datos
        sqlsrv_close($conectar);
        ?>
    </table>

    <footer>
        &copy; <?php echo date("Y"); ?> Los Santos Customs. Todos los derechos reservados.
    </footer>
</body>
</html>
