<?php

    include_once dirname(__FILE__).'/config.php';

    class DB{
        
    public $conection;

        public function __construct(){
            $this->conection = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
            if (mysqli_connect_errno()) {
                echo "Error en la conexión: " . mysqli_connect_error();
            }
                
        }

        public function retiroCuenta($numCuenta, $valorRetiro){
            $myUsuario = $_SESSION["ID"];

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
            $sql = "insert into tarjetacredito (idCuenta) values ($idCuenta)";
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
            $sql = "insert into CuentaAhorros (UserID) values ($userId)";

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

            $sql = "insert into credito (cedulaVisitante) values ('$cedula')";
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
            $sql = "insert into credito (tasaInteres, idUsuario) values ($tasaInteres, $IdUsuario)";

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