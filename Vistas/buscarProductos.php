<?php
    $dataBase = new DB();
?>

<h2>Buscar producto</h2>


    <form action="" method="post">

        <div class="form-group">
            <label>Cédula</label>
            <input type="text" class="form-control" name="cedulaProductos" placeholder="Cédula">
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>


    
    <?php
    
        if(isset($_POST["cedulaProductos"])){
            echo "<table class=\"table\"><thead><tr><th >ID</th><th >Tasa de interes</th><th >Cuota de manejo</th><th >Aprobado</th></tr></thead><tbody>";
            $ccVisitante = $_POST["cedulaProductos"];
            $conexion = $dataBase->getConection();
            $sql = "select * from credito where cedulaVisitante = $ccVisitante";
            $resultado = mysqli_query($conexion, $sql);
            while($fila = mysqli_fetch_array($resultado)){
                $ID = $fila["ID"];
                $TasaInteres = $fila["tasaInteres"];
                $CuotaManejo = $fila["cuotaManejo"];
                $Aprobado = $fila["aprobado"];
                
                echo "<tr>";
                echo "<th>$ID</th><th>$TasaInteres</th><th>$CuotaManejo</th><th>$Aprobado</th>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        }

    ?>