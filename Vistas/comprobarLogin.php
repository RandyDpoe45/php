<?php 
    session_start();

    include_once dirname(__FILE__).'\..\Configuracion\BD.php';
    $dataBase = new DB();

    if(isset($_POST["userName"])){
        if(isset($_POST["password"])){
            $usuario = $_POST["userName"];
            $contraseña = $_POST["password"];
            
            $resultado = $dataBase->comprobarLogin($_POST["userName"], crypt($_POST["password"], CRIPT_KEY));
            if($resultado == true){
                echo "Logeado como $usuario";
                header("location: ../index.php");
            }
            else{
                echo "Datos incorrectos";
                header("location: login.php");
            }
        }
    } 
    
?>

