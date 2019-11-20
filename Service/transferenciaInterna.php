<?php
	$dataBase = new DB();
	$url = 'http://'.$_POST['url'];//'http://10.192.101.35';
	$BancoOrigen = $_POST["BancoOrigen"];
	$CuentaOrigen = $_POST["CuentaOrigen"];
	$CuentaDestino = $_POST["CuentaDestino"];
	$Costo = $_POST["Costo"];
	$Valor = $_POST["Valor"];
	$data = array('BancoOrigen' => $BancoOrigen, 'CuentaOrigen' => $CuentaOrigen, 'CuentaDestino' => $CuentaDestino, 'Costo' => $Costo , 'Valor' => $Valor);

	// use key 'http' even if you send the request to https://...
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/json\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result['response'] === FALSE) { echo $result['message'];}
	
	$arr = json_decode($result);
	if($arr['response'] == True){
		$dataBase -> guardaTransaccion($BancoOrigen, $CuentaOrigen, $CuentaDestino, $Costo, $Valor); 
	}
	header("location: ../index.php");
	//var_dump($result);
?>