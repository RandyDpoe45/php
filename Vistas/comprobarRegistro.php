<?php

    include_once dirname(__FILE__).'\..\Configuracion\BD.php';
    $dataBase = new DB();

    if(isset($_POST["userName"])){
        echo "Va 1";
        if(isset($_POST["password"])){
            echo "Va 1";
            if(isset($_POST["tipo"])){
                echo "Va 1";
                $resultado = $dataBase->registro($_POST["userName"], crypt($_POST["password"], CRIPT_KEY), $_POST["tipo"]);
                if($resultado == true){
                    header("location: ../index.php");
                }
                else{
                    echo "Usuario no se pudo registrar";
                    header("location: registro.php");
                }
            }
        }
    }
    echo "ERROR";

?>