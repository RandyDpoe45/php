<h2>Retiros</h2>

    <form action="" method="post">
        <div class="form-row">
            <div class="col">
                <label>Cuenta</label>
                <select class="form-control" name="Cuenta"> 

                    <?php
                        $UserID = $_SESSION["ID"];
                        $conexion = $dataBase->getConection();
                        $sql = "SELECT * FROM cuentaahorros INNER JOIN usuario ON cuentaahorros.UserID = usuario.ID where ID = $UserID";
                        $resultado = mysqli_query($conexion, $sql);
                        while($fila = mysqli_fetch_array($resultado)) {
                            $numCuenta = $fila["NumCuenta"];
                            echo "<option value=\"$numCuenta\">$numCuenta</option>";
                        }
                    ?>

                </select> 
            </div>
			

            <div class="col">
                <label>Banco origen</label>
                <input type="text" class="form-control" name="BancoOrigen">
            </div>

            <div class="col">
                <label>Cuenta origen</label>
                <input type="text" class="form-control" name="CuentaOrigen">
            </div>

            <div class="col">
                <label>Cuenta destino</label>
                <input type="text" class="form-control" name="CuentaDestino">
            </div>

            <div class="col">
                <label>Costo</label>
                <input type="text" class="form-control" name="Costo">
            </div>

            <div class="col">
                <label>Valor</label>
                <input type="text" class="form-control" name="Valor">
            </div>

            
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
