<?php
$serverName = 'LAPTOP-BLOE3A58';   
$connectionInfo = array( 'Database'=>'Produccion', 'UID'=>'LSBDUSER', 'PWD'=>'ERTAgef6391$');
$conectar = sqlsrv_connect( $serverName, $connectionInfo);  /*Aquí esta la instrucción para la conexión NOTA que es SQLSRV */
if ($conectar){
	/* */
}else{
	echo 'Hubo un error 404';
}
?>
