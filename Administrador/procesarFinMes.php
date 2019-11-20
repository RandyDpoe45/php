
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
    
    $sqlTransacciones = "SELECT * from transacciontarjeta INNER JOIN tarjetacredito on transacciontarjeta.TarjetaID = tarjetacredito.ID INNER JOIN cuentaahorros ON tarjetacredito.idCuenta = cuentaahorros.NumCuenta INNER JOIN usuario ON cuentaahorros.UserID = usuario.ID";
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

        

        if(true){//primer mes de compra
            $totalPagar = ($Valor/$Cuotas)+$cuotaManejo;
        }
        else{
            $totalPagar = (($Valor/$Cuotas)*$tasaInteres)+$cuotaManejo+($Valor/$Cuotas);
        }
        if($JaveCoins < $totalPagar){
            sendMail($Email, "Saldo Insuficiente en la cuenta $idCuenta para pagar la tarjeta $TarjetaID CUIDADO");
        }
        else{
            $dataBase->retiroCuenta($idCuenta, $Valor/$Cuotas, "JaveCoins");
        }
        if(($Valor - ($Valor/$Cuotas)) == 0){//ultimos mes
            $sql = "DELETE from transacciontarjeta where ID = $transaccionID";
            $resultado = mysqli_query($dataBase->getConection(), $sql);
        }


    }


    $sql = "SELECT * FROM cuentaahorros";
    $resultado = mysqli_query($dataBase->getConection(), $sql);
    while($fila = mysqli_fetch_array($resultado)) {
        $NumCuenta = $fila["NumCuenta"];
        $JaveCoins = $fila["JaveCoins"];
        $cuotaManejo = $fila["cuotaManejo"];

        $valorTotal = (($JaveCoins*$cuotaManejo)+$JaveCoins);
        $sql = "UPDATE cuentaahorros set JaveCoins = $valorTotal where NumCuenta = $NumCuenta";
        mysqli_query($dataBase->getConection(), $sql);
    }

    echo "<script>alet(\"Acciones de fin de mes realizadas con exito\")</script>";
    //header("location: ../index.php");
?>

