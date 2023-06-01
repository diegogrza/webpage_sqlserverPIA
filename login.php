<?php


if (isset($_POST['login'])) {
  $nombreUsuario = $_POST['username'];
  $pwdUsuario = $_POST['password'];

  require_once '/src/getconex.php';
  // se hace la comparacion de usuario y contraseñas por medio de un procedimiento almacenado
  $qComparar = "EXEC SP_CompararPasswordEncriptada @email = '$nombreUsuario', @passwd = '$pwdUsuario'";
  $rComparar = sqlsrv_query($conectar, $qComparar);
  // se obtiene el ID_Empleado por medio de un procedimiento almacenado
  $qEmpleado = "exec SP_ObtenerIDEmpleado @email = '$nombreUsuario', @passwd = '$pwdUsuario'";
  $rEmpleado = sqlsrv_query($conectar, $qEmpleado);
  if ($row = sqlsrv_fetch_array($rEmpleado, SQLSRV_FETCH_ASSOC)) {
    // Obtener el valor deseado
    $ID_Empleado = $row['ID_Empleado'];
  }


  if ($qComparar === false) {
    // Si hay un error en la consulta, mostramos el mensaje y finalizamos el script
    echo 'Hubo un error al comprobar el inicio de sesión: <br>';
    die(print_r(sqlsrv_errors(), true));
  }else

  if (sqlsrv_has_rows($rEmpleado)) {
    $_SESSION['usuario'] = $ID_Empleado;
    header('Location: menu.php');
    exit();
  } else {
    header('Location: error_login.php');
    exit();
  }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de Sesión - Venta de Vehículos</title>
  <link rel="stylesheet" href="styles/styles_login.css">
</head>
<body>
  <div class="background">
    <div class="container">
      <form class="login-form" method="POST">
        <h1>Inicio de Sesión</h1>
        <div class="form-group">
          <label for="username">Usuario:</label>
          <input type="text" id="username" name="username" placeholder="Ingrese su nombre de usuario">
        </div>
        <div class="form-group">
          <label for="password">Contraseña:</label>
          <input type="password" id="password" name="password" placeholder="Ingrese su contraseña">
        </div>
        <button type="submit" name="login">Iniciar Sesión</button>
      </form>
    </div>
  </div>
</body>
</html>
