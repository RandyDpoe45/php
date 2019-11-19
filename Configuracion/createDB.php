<?php
	include_once dirname(__FILE__).'/config.php';
	$commands = file_get_contents('Codigo_BaseDatos.sql');
	$con=mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
	 
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Error en la conexión: " . mysqli_connect_error();
	}
	
	$tok = strtok($commands,";");
	while($tok !== false){
		mysqli_query($con,$tok);
		echo $tok;
		$tok = strtok(";");
	}
	mysqli_close($con);
?>