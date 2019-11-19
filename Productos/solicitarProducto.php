<h2>Solicitar Producto</h2>

<form action="Productos\crearProducto.php" method="post">
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