<?php session_start();?>

<?php 
    include_once dirname(__FILE__).'\..\Configuracion\BD.php';
    $dataBase = new DB();

    if(isset($_POST["cuenta"])){
        $resultado = $dataBase->crearTarjeta($_POST["cuenta"]);
        if($resultado){
            echo "<script>alert(\"Tarjeta solicitada con exito\");</script>";
            header("location: ../index.php");
        }
        else{
            echo "<script>alert(\"Error al pedir la tarjeta\");</script>";
        }
    }
?>


<html> 
  <head>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <body>

    <div class="margen">
      <div class="container-fluit text-align-center row">
        <div class="col-md-4"></div>
        <div class="jumbotron  col-md-5">
        <h1 class="display-4">Solicitar Tarjeta De Credito</h1>
          

            <form action="" method="post">

                <div>
                    <label>Número de cuenta asociada</label>
                    <select class="form-control" name="cuenta"> 
                        
                    <?php
                        
                        $UserID = $_SESSION["ID"];
                        $conexion = $dataBase->getConection();
                        $sql = "select * from cuentaAhorros where UserID = $UserID";
                        $resultado = mysqli_query($conexion, $sql);

                        while($fila = mysqli_fetch_array($resultado)) {
                            $NumCuenta = $fila["NumCuenta"];
                            echo "<option value=\"$NumCuenta\">$NumCuenta</option>";
                        }

                    ?>

                        
                    </select> 
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>



        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>