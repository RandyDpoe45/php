<h2>Retiros</h2>


    <form action="" method="post">
        <div class="form-row">
            <div class="col">
                <label>Seleccione la cuenta</label>
                <select class="form-control" name="cuenta"> 

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
                <label>Valor a retirar</label>
                <input type="text" class="form-control" placeholder="Valor a retirar">
            </div>
            
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
