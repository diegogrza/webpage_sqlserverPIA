<?php

$serverName = 'LENOVO-VAPE';  

$connectionInfo = array( 'Database'=>'MuevoDenuncia', 'UID'=>'LSBDUSER', 'PWD'=>'eliasv');

$conectar = sqlsrv_connect( $serverName, $connectionInfo);  /*Aquí esta la instrucción para la conexión NOTA que es SQLSRV */



?>