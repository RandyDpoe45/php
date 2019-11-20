
<?php
    function sendMail($to, $message){
            ini_set( 'display_errors', 1 );
            error_reporting( E_ALL );
            $subject = "Banco Proyecto PHP";
            $headers = "From:" . "sheeva0710@gmail.com";
            mail($to,$subject,$message, $headers);
    }
?>

<?php
	session_start();
	include_once dirname(__FILE__) . '../../Configuracion/config.php';
	$str_datos = "";
	$con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
	if (mysqli_connect_errno()) {
	$str_datos.= "Error en la conexión: " . mysqli_connect_error();
	}
	
	if($_SESSION["op"]=="tarj"){
		$id = $_SESSION["idTarj"]; 
		$val1 = $_POST["cupoMaximo"];
		$val2 = $_POST["sobrecupo"];
		$val3 = $_POST["cuotaManejo"];
		$val4 = $_POST["tasaInteres"];		
		$sql = "update tarjetacredito set cupoMaximo = $val1 ,sobrecupo = $val2 ,
		cuotaManejo = $val3, tasaInteres = $val4 , aprobada = true
		where ID = $id";
		mysqli_query($con,$sql);

	}else if($_SESSION["op"]=="cred"){
		$id = $_SESSION["idCred"]; 
		echo $id;
		$val3 = $_POST["cuotaManejo"];
		$val4 = $_POST["tasaInteres"];		
		$sql = "update credito set
		cuotaManejo = $val3, tasaInteres = $val4 , aprobado = true
		where ID = $id";
		mysqli_query($con,$sql);

		
		$sql = "select * from credito where ID = $id";
		$resultado = mysqli_query($con,$sql);
		while($fila = mysqli_fetch_array($resultado)){
			$idUsuario = $fila["idUsuario"];
			$cedulaVisitante = $fila["cedulaVisitante"];

			if(!($cedulaVisitante == NULL)){
				$sql = "select * from visitante where cedula = '$cedulaVisitante'";
				$resultado = mysqli_query($con,$sql);
				$fila = mysqli_fetch_array($resultado);
				sendMail($fila["correo"], "Se credito con id $id fue aprobado ¡FELICIDADES!");
			}
		}
	}
	
	header("location: solicitudes.php");
?>