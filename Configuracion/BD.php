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