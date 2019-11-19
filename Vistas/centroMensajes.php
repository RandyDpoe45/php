<?php 
    $dataBase = new DB();

    if(isset($_POST["destinatario"])){
        if(isset($_POST["mensaje"])){
            if($_POST["mensaje"] != ""){
                $resultado = $dataBase->crearMensaje($_POST["destinatario"], $_POST["mensaje"]);
                if($resultado){
                    echo "<script>alert(\"Mensaje enviado con exito\");</script>";
                    $_POST["mensaje"] = "";
                }
                else{
                    echo "<script>alert(\"No es posible enviar este mensaje\");</script>";
                }
            }

        }
    }
?>

<h2>Centro de mensajes</h2>


    <form action="" method="post">
        <div class="form-group">
            <label>Enviar mensaje a:</label>
            <select class="form-control" name="destinatario"> 

                <?php
                    $UserID = $_SESSION["ID"];
                    $conexion = $dataBase->getConection();
                    $sql = "select * from usuario where ID != $UserID";
                    $resultado = mysqli_query($conexion, $sql);
                    while($fila = mysqli_fetch_array($resultado)) {
                        $UsuarioMostrarID = $fila["ID"];
                        $UsuarioMostrarName = $fila["UserName"];
                        echo "<option value=\"$UsuarioMostrarID\">$UsuarioMostrarName</option>";
                    }
                ?>

            </select> 
        </div>

        <div class="form-group">
            <label>Mensaje</label>
            <textarea class="form-control" name="mensaje" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label>Historial</label>
            <select multiple class="form-control">

                <?php
                    $UserID = $_SESSION["ID"];
                    $conexion = $dataBase->getConection();
                    $sql = "select * from mensaje where idremitido = $UserID";
                    $resultado = mysqli_query($conexion, $sql);
                    while($fila = mysqli_fetch_array($resultado)) {
                        $usuario = $dataBase->nombreUsuario($fila["idRemitente"]);
                        $mensaje = $fila["mensaje"];
                        echo "<option>FROM: $usuario MESSAGE: $mensaje </option>";
                    }
                ?>

            </select>
        </div>


        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>