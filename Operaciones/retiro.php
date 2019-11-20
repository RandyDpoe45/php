<h2>Retiros</h2>

    <?php
    
        $dataBase = new DB();

        if(isset($_POST["cuentaRetiro"])){
            if(isset($_POST["valRetiro"])){
				if(isset($_POST["tipoMoneda"])){
					$resultado = $dataBase->retiroCuenta($_POST["cuentaRetiro"], $_POST["valRetiro"],$_POST["tipoMoneda"]);
					//echo "<p><script>alert(\"PUES PARECE QUE ES $resultado\"</script>";
					if($resultado){
						echo "<script>alert(\"Retiro exitoso\");</script>";
					}
					else{
						$valorRetiro = $_POST["valRetiro"];
						$numCuenta = $_POST["cuentaRetiro"];
						echo "<script>alert(\"No se puede retirar $valorRetiro de la cuenta $numCuenta\");</script>";
					}
				}
                
            }
        }

    ?>

    <form action="" method="post">
        <div class="form-row">
            <div class="col">
                <label>Seleccione la cuenta</label>
                <select class="form-control" name="cuentaRetiro"> 

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
			
			<div>
                <label>Tipo de moneda</label>
                <select class="form-control" name="tipoMoneda">
                        <option value="pesos">Pesos</option>
                        <option value="coins">JaveCoins</option>
                </select>
            </div>

            <div class="col">
                <label>Valor a retirar</label>
                <input type="text" class="form-control" name="valRetiro" placeholder="Valor a retirar">
            </div>
            
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
