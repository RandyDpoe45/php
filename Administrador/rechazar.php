<?php
	session_start();
	include_once dirname(__FILE__) . '../../Configuracion/config.php';
	$con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
	if (mysqli_connect_errno()) {
	$str_datos.= "Error en la conexión: " . mysqli_connect_error();
	}
	$id = $_GET['credito'];
	$sql = "delete from credito where ID = $id";
	echo $sql;
	mysqli_query($con,$sql);
	header("location: ../index.php");

?>