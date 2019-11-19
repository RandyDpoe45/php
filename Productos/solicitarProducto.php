<h2>Solicitar Producto</h2>

<form action="" method="post">
    <div class="form-group">
        <select class="form-control" name="tipoProducto">
            <?php if(isset($_SESSION['type'])){
                echo "<option value='Cuenta'>Cuenta de ahorros</option>";
            } ?>
            
            <option value='Credito'>Credito</option>

            <?php if(isset($_SESSION['type'])){
                echo "<option value='Tarjeta'>Tarjeta de credito</option>";
            } ?>

        </select>   
    </div>

    <button type="submit" class="btn btn-primary">Solicitar</button>
</form>


<?php

    $dataBase = new DB();

    if(isset($_POST['tipoProducto'])){
        if($_POST['tipoProducto'] == "Cuenta"){
            $resultado = $dataBase->crearCuentaAhorros($_SESSION["ID"]);
            echo "<script>alert(\"Cuenta de ahorros creada correctamente\");</script>";
        }

        if($_POST['tipoProducto'] == "Credito"){
            header("location: Productos/credito.php");
        }

        if($_POST['tipoProducto'] == "Tarjeta"){
            header("location: Productos/tarjeta.php");
        }
        
    }


?>
