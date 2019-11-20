<?php
	session_start();
	include_once dirname(__FILE__) . '../../Configuracion/config.php';
	$str_datos = "";
	$con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
	if (mysqli_connect_errno()) {
	$str_datos.= "Error en la conexión: " . mysqli_connect_error();
	}
	echo $_SESSION["idu"];
	$id = $_SESSION["idu"]; 
	$val1 = $_POST["UserName"];
	$val2 = $_POST["tipoUsuario"];		
	$sql = "update usuario set UserName = '$val1' ,type = '$val2' 
	where ID = $id";
	mysqli_query($con,$sql);
	mysqli_close($con);
	
	
	header("location: edicionU.php");
?>