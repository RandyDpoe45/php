<?php
	$dataBase = new DB();
	$BancoOrigen = $_POST["BancoOrigen"];
	$CuentaOrigen = $_POST["CuentaOrigen"];
	$CuentaDestino = $_POST["CuentaDestino"];
	$Costo = $_POST["Costo"];
	$Valor = $_POST["Valor"];
	$dataBase -> guardaTransaccion($BancoOrigen, $CuentaOrigen, $CuentaDestino, $Costo, $Valor); 
	$arr = [];
	$arr ['response'] = true;
	$arr ['message'] = 'transaccion exitosa';
	echo json_encode($arr);
?>