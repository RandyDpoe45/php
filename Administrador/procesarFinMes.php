
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

    include_once dirname(__FILE__).'\..\Configuracion\BD.php';
    $dataBase = new DB();

    $sqlTransacciones = "SELECT * from transacciontarjeta INNER JOIN tarjetacredito on transacciontarjeta.TarjetaID = tarjetacredito.ID INNER JOIN cuentaahorros ON tarjetacredito.idCuenta = cuentaahorros.NumCuenta";
    $resultadoTransacciones = mysqli_query($dataBase->getConection(), $sqlTransacciones);
    while($transaccion = mysqli_fetch_array($resultadoTransacciones)) {
        $transaccionID = $transaccion["ID"];
        $TarjetaID = $transaccion["TarjetaID"];
        $Cuotas = $transaccion["Cuotas"];
        $Valor = $transaccion["Valor"];
        $FechaCompra = $transaccion["FechaCompra"];
        $cuotaManejo = $transaccion["cuotaManejo"];
        $tasaInteres = $transaccion["tasaInteres"];
        $JaveCoins = $transaccion["JaveCoins"];
        $Email = $transaccion["Email"];
        $idCuenta = $transaccion["idCuenta"];

        echo "FechaCompra";

        if(true){//primer mes de compra
            $totalPagar = ($Valor/$Cuotas)+$cuotaManejo;
        }
        else{
            $totalPagar = (($Valor/$Cuotas)*$tasaInteres)+$cuotaManejo;
        }
        if($JaveCoins < $totalPagar){
            sendMail($Email, "Saldo Insuficiente en la cuenta $idCuenta para pagar la tarjeta $TarjetaID CUIDADO");
        }
        else{
            $dataBase->retiroCuenta($idCuenta, $totalPagar, "JaveCoins");
        }
        if(true){//ultimos mes
            $sql = "DELETE from transacciontarjeta where ID = $transaccionID";
            $resultado = mysqli_query($dataBase->getConection(), $sql);
        }


    }

    $saldoCuenta = 

    $dataBase = new DB();

    $conexion = $dataBase->getConection();

    $sql = "SELECT * FROM transacciontarjeta";
    $resultado = mysqli_query($conexion, $sql);
    while($fila = mysqli_fetch_array($resultado)) {
        $aux = $fila["FechaCompra"];
        echo "<p> $aux </p>";
    }

    //header("location: ../index.php");
?>

