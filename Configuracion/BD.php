<?php

    include_once dirname(__FILE__).'/config.php';
	if(!isset($GLOBALS["cuotaManejoCredito"])){
		$GLOBALS["cuotaManejoCredito"] = 12;
	}
	if(!isset($GLOBALS["tasaInteres"])){
		$GLOBALS["tasaInteres"] = 0.05;
	}
	if(!isset($GLOBALS["cuotaManejoAhorros"])){
		$GLOBALS["cuotaManejoAhorros"] = 10;
	}
    class DB{
        
    public $conection;

        public function __construct(){
            $this->conection = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
            if (mysqli_connect_errno()) {
                echo "Error en la conexión: " . mysqli_connect_error();
            }
                
        }

        public function comprarTC($numTarjeta, $cantidadCuotas, $valorCompra){
            $sql = "insert into transacciontarjeta (TarjetaID, Cuotas, Valor) values ($numTarjeta, $cantidadCuotas, $valorCompra)";
            $resultado = mysqli_query($this->getConection(), $sql);
            if($resultado){
                return true;
            }
            else{
                return false;
            }
        }

        public function consignacionCuenta($numCuenta, $valor){
            $sql = "select * from cuentaahorros where NumCuenta = $numCuenta";
            $resultado = mysqli_query($this->getConection(), $sql);
            $fila = mysqli_fetch_array($resultado);
            $valorActual = $fila["JaveCoins"];

            $valorTotal = $valorActual + $valor;
            $sqlActualizar = "UPDATE cuentaahorros SET JaveCoins = $valorTotal where NumCuenta = $numCuenta";
            $resultado2 = mysqli_query($this->getConection(), $sqlActualizar);
            if($resultado2){
                return true;
            }
            else{
                return false;
            }
        }

        public function retiroCuenta($numCuenta, $valorRetiro, $tipoMoneda){
            $myUsuario = $_SESSION["ID"];
			if($tipoMoneda == "coins"){
				$valorRetiro = $valorRetiro/1000;
			
			}
            $sql = "select * from cuentaahorros where NumCuenta = $numCuenta";
            $resultado = mysqli_query($this->getConection(), $sql);
            $fila = mysqli_fetch_array($resultado);
            $valorActual = $fila["JaveCoins"];

            if($valorActual < $valorRetiro){
                return false;
            }
            else{
                $valorRestante = $valorActual - $valorRetiro;
                $sqlActualizar = "UPDATE cuentaahorros SET JaveCoins = $valorRestante where NumCuenta = $numCuenta";
                $resultado2 = mysqli_query($this->getConection(), $sqlActualizar);
            }
            return true;
        
        }

        public function getConection(){
            return $this->conection;
        }

        public function guardaTransaccion($BancoOrigen, $CuentaOrigen, $CuentaDestino, $Costo, $Valor){
            $sql = "insert into transacciones (BancoOrigen, CuentaOrigen, CuentaDestino, Costo, ValorTransaccion) values ($BancoOrigen, $CuentaOrigen, $CuentaDestino, $Costo, $Valor)";
            $resultado = mysqli_query($this->getConection(), $sql);
            if($resultado){
                return true;
            }
            else{
                return false;
            }
        }

        public function registro($userName, $password, $type){
            if($this->usuarioExiste($userName) == true){
                return false;
            }
            else{
                $sql = "insert into Usuario (UserName, Password, type) values ('$userName', '$password', '$type')";
                $resultado = mysqli_query($this->getConection(), $sql);

                if($resultado){
                    return true;
                }
                else{
                    return false;
                }
            }
            
        }

        public function crearTarjeta($idCuenta){
			$val2 = $GLOBALS["cuotaManejoAhorros"];
            $sql = "insert into tarjetacredito (idCuenta,cuotaManejo) values ($idCuenta,$val2)";
            $resultado = mysqli_query($this->getConection(), $sql);
            if($resultado){
                return true;
            }
            else{
                return false;
            }
        }

        public function nombreUsuario($id){
            $sql = "SELECT userName FROM usuario WHERE ID = $id";
            $resultado = mysqli_query($this->getConection(), $sql);
            $fila = mysqli_fetch_array($resultado);
            return $fila["userName"];
        }

        public function crearMensaje($para, $mensaje){
            $usuario = $_SESSION["ID"];
            $sql = "insert into mensaje (mensaje, idremitido, idRemitente) values ('$mensaje', $para, $usuario)";
            $resultado = mysqli_query($this->getConection(), $sql);
            if($resultado){
                return true;
            }
            else{
                return false;
            }
        }

        public function usuarioExiste($userName){
            $sql = "select * from usuario where userName = '$userName'";

            $resultado = mysqli_query($this->getConection(), $sql);

            $cantidadCol = 0;
            while($fila = mysqli_fetch_array($resultado)) {
                $cantidadCol = $cantidadCol + 1;
            }

            if($cantidadCol > 0){
                return true;
            }
            else{
                return false;
            }

        }

        public function crearCuentaAhorros($userId){
			$val2 = $GLOBALS["cuotaManejoAhorros"];
            $sql = "insert into CuentaAhorros (UserID,cuotaManejo) values ($userId,$val2)";

            $resultado = mysqli_query($this->getConection(), $sql);

            if($resultado){
                return "Cuenta Creada con exito";
            }
            else{
                return "No se pudo crear su cuenta";
            }

            
        }

        public function getCuentas(){
            $UserID = $_SESSION["ID"];
            $sql = "select * from cuentaAhorros where UserID = $UserID";
            $resultado = mysqli_query($this->getConection(), $sql);

            $return = array();

            while($fila = mysqli_fetch_array($resultado1)) {
                array_push($return, $fila["NumCuenta"]);
            }

            


            return $return;
        }

        public function crearCreditoVisitante($cedula, $email){
            $buscarVisitante = "select * from Visitante where cedula = '$cedula'";
            $resultado1 = mysqli_query($this->getConection(), $buscarVisitante);
            $cantidadCol = 0;
            while($fila = mysqli_fetch_array($resultado1)) {
                $cantidadCol = $cantidadCol + 1;
            }
            if($cantidadCol == 0){
                $crearVisitante = "insert into Visitante (cedula, correo) values ('$cedula', '$email')";
                $resultado2 = mysqli_query($this->getConection(), $crearVisitante);
            }
			$val = $GLOBALS["tasaInteres"];
			$val2 = $GLOBALS["cuotaManejoCredito"];
            $sql = "insert into credito (cedulaVisitante,cuotaManejo,tasaInteres) values ('$cedula',$val2,$val)";
            $resultado3 = mysqli_query($this->getConection(), $sql);

            if($resultado3){
                return true;
            }
            else{
                return false;
            }
        }

        public function crearCreditoCliente($tasaInteres){
            $IdUsuario = $_SESSION["ID"];
			$val = $GLOBALS['cuotaManejoCredito'];
            $sql = "insert into credito (tasaInteres, idUsuario,cuotaManejo) values ($tasaInteres, $IdUsuario,$val)";

            $resultado3 = mysqli_query($this->getConection(), $sql);

            if($resultado3){
                return true;
            }
            else{
                return false;
            }
        }

        public function comprobarLogin($userName, $password){
            $sql = "SELECT * FROM usuario WHERE userName = '$userName' AND password = '$password'";
            
            $resultado = mysqli_query($this->getConection(), $sql);

            $cantidadCol = 0;
            while($fila = mysqli_fetch_array($resultado)) {
                //actualizar con todo los datos nesesarios de la sesion
                $_SESSION["userName"] = $fila["UserName"];
                $_SESSION["type"] = $fila["type"];
                $_SESSION["ID"] = $fila["ID"];
                $cantidadCol = $cantidadCol + 1;
            }
            if($cantidadCol > 0){
                return true;
            }
            else{
                return false;
            }

        }
    }

?>