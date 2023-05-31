<?php



if (!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip = $_SERVER[HTTP_CLIENT_IP];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip =  $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$date = date(' [Y/m/d H:i:s]');
$dirip = " [ " . $ip . " ] ";

$sqlerror = print_r(sqlsrv_errors(), true);

error_log($date . $dirip . "Error de SQL Server : " . $sqlerror,3, 'c:\xampp\apache\logs\sqlsrv_error.log');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Página con Imagen de Fondo</title>
    <style>
        body {
            background-image: url('../logos/error.png');
            background-repeat: no-repeat;
        }
        
    </style>
</head>
<body>
</body>
</html>



