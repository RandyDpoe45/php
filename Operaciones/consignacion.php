<h2>Consignación</h2>


    <?php
        
        $dataBase = new DB();


        if(isset($_POST["cuentaConsignacion"])){
            if(isset($_POST["valConsignacion"])){
                if(isset($_POST["tipoMoneda"])){
                    if($_POST["tipoMoneda"] == "pesos"){
                        $valorConsignacion = ($_POST["valConsignacion"])/1000;
                    }
                    else{
                        $valorConsignacion = $_POST["valConsignacion"];
                    }
                    $resultado = $dataBase->consignacionCuenta($_POST["cuentaConsignacion"], $valorConsignacion);
                    if($resultado){
                        echo "<script>alert(\"Consignacion exitosa\");</script>";
                    }
                    else{
                        $numCuenta = $_POST["cuentaConsignacion"];
                        echo "<script>alert(\"No se puede realizar la consignacion en la cuenta $numCuenta\");</script>";
                    }
                }
                
            }
        }

    ?>



    <form action="" method="post">
        <div class="form-row">
            <div class="col">
                <label>Seleccione la cuenta</label>
                <select class="form-control" name="cuentaConsignacion"> 

                    <?php
                        $UserID = $_SESSION["ID"];
                        $conexion = $dataBase->getConection();
                        $sql = "SELECT * FROM cuentaahorros";
                        $resultado = mysqli_query($conexion, $sql);
                        while($fila = mysqli_fetch_array($resultado)) {
                            $numCuenta = $fila["NumCuenta"];
                            echo "<option value=\"$numCuenta\">$numCuenta</option>";
                        }
                    ?>

                </select> 
            </div>

            <div class="col">
                <label>Valor a consignar</label>
                <input type="text" class="form-control" name="valConsignacion" placeholder="Valor a consignar">
            </div>

            <div>
                <label>Tipo de mensaje</label>
                <select class="form-control" name="tipoMoneda">
                        <option value="pesos">Pesos</option>
                        <option value="coins">JaveCoins</option>
                </select>
            </div>
            
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>