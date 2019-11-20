<h2>Comprar con tarjeta de credito</h2>
<?php

if(isset($_POST["fechaCompra"])){
    $fecha = $_POST["fechaCompra"];
    echo "<h2> la fecha es </h2>";
}
?>
    <?php


        if(isset($_POST["numTarjeta"])){
            if(isset($_POST["valorCompra"])){
                if(isset($_POST["cantidadCuotas"])){
                    if(isset($_POST["tipoMonedaTC"])){
                        if($_POST["tipoMonedaTC"] == "pesos"){
                            $valorCompra = (intval($_POST["valorCompra"]))/1000;
                        }
                        else{
                            $valorCompra = $_POST["valorCompra"];
                        }
                        $resultado = $dataBase->comprarTC($_POST["numTarjeta"], $_POST["cantidadCuotas"], $valorCompra);
                        if($resultado){
                            echo "<script>alert(\"Compra con tarjeta de credito exitosa\");</script>";
                        }
                        else{
                            echo "<script>alert(\"No se puede realizar la compra con la tarjeta de credito\");</script>";
                        }
                    }
                }
            }
        }
    ?>

<form action="" method="post">
        <div class="form-row">

            <div class="col">
                <label>Seleccionar tarjeta</label>
                <select class="form-control" name="numTarjeta"> 

                    <?php
                        $UserID = $_SESSION["ID"];
                        $conexion = $dataBase->getConection();
                        $sql = "select * from tarjetacredito inner join cuentaahorros on tarjetacredito.idCuenta = cuentaahorros.NumCuenta where UserID = $UserID";
                        $resultado = mysqli_query($conexion, $sql);
                        while($fila = mysqli_fetch_array($resultado)) {
                            if($fila["aprobada"]){
                                $numTarjeta = $fila["ID"];
                                echo "<option value=\"$numTarjeta\">$numTarjeta</option>";
                            }
                        }
                    ?>

                </select> 
            </div>

            <div class="col">
                <label>Valor de la compra</label>
                <input type="text" class="form-control" name="valorCompra" placeholder="Valor compra">
            </div>

            <div class="col">
                <label>Cantidad de cuotas</label>
                <select class="form-control" name="cantidadCuotas"> 

                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>

                </select> 
            </div>


            <div class="col">
                <label>Tipo de moneda</label>
                <select class="form-control" name="tipoMonedaTC">
                        <option value="pesos">Pesos</option>
                        <option value="coins">JaveCoins</option>
                </select>
            </div>
            
            <!-- <div class="col">
                <label>Fecha compra</label>
                <input class="form-control" type="date" id="start" name="fechaCompra" min="1999-01-01" max="2030-12-31">
            </div> -->
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>