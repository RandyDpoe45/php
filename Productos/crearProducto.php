
<?php
    session_start();
    //include_once dirname(__FILE__).'\..\Vistas\navBar.php';
    include_once dirname(__FILE__).'\..\Configuracion\BD.php';

    $dataBase = new DB();

    if(isset($_POST['tipoProducto'])){
        if($_POST['tipoProducto'] == "Cuenta"){
            echo "VAMOS POR UNA CUENTA";
            $resultado = $dataBase->crearCuentaAhorros($_SESSION["ID"]);
            echo "<h2>$resultado</h2>";
        }

        if($_POST['tipoProducto'] == "Credito"){
            echo "VAMOS POR UN CREDITO";
        }

        if($_POST['tipoProducto'] == "Tarjeta"){
            echo "VAMOS POR UNA TARJETA";
        }
        
    }
    else{
        header(dirname(__FILE__).'solicitarProducto');
    }
?>
