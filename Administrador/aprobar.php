<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<title></title>
</head>
<body class="bg-light">
<main role="main" class="container mt-3 pt-5">
<div class="my-3 p-3 bg-white rounded box-shadow">
	<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Panel de administracion</a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="Administrador/solicitudes.php" >Solicitudes de credito pendientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php" >Centro Mensajes</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">

        <?php
		session_start();
          if(!isset($_SESSION["userName"])){
                echo "<li class=\"nav-item active\">
                        <a class=\"nav-link\" href=\"Vistas/login.php\">Iniciar Sesión <span class=\"sr-only\">(current)</span></a>
                      </li>
                      <li class=\"nav-item active\">
                        <a class=\"nav-link\" href=\"Vistas/registro.php\">Registrarse <span class=\"sr-only\">(current)</span></a>
                      </li>";
          }
          else{
            $usuario = $_SESSION["userName"];
            echo "<li class=\"nav-item active\">
                    <a class=\"nav-link\" href=\"\">Bienvenido $usuario <span class=\"sr-only\">(current)</span></a>
                  </li>
                  <li class=\"nav-item active\">
                    <a class=\"nav-link\" href=\"Vistas/logOut.php\">Cerrar Sesión <span class=\"sr-only\">(current)</span></a>
                  </li>";
          }
        ?>
        


    </ul>
      </div>
    </nav>

<?php
include_once dirname(__FILE__) . '../../Configuracion/config.php';
	$str_datos = "";
	$con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
	if (mysqli_connect_errno()) {
	$str_datos.= "Error en la conexión: " . mysqli_connect_error();
	}
if($_GET["op"]=="tarj"){
	$val=$_GET["credito"];
	$sql = "SELECT * from tarjetacredito where Id= $val";
	$fila = mysqli_query($con,$sql);
	$resultado = mysqli_fetch_array($fila);
	$_SESSION["idTarj"]=$_GET["credito"];
	$_SESSION["op"]=$_GET["op"];
	$val1 =$resultado['cupoMaximo'];
	$val2=$resultado['sobrecupo'];
	$val3 =$resultado['cuotaManejo'];
	$val4=$resultado['tasaInteres'];
	$str_datos="<div class=\"card\">
				  <h5 class=\"card-header h5\">Edicion tarjeta de credito</h5>
				  <div class=\"card-body\">
				   
						<form action=\"guardarCambios.php\" method=\"post\">
						  <div class=\"form-group\">
							<label for=\"recipient-name\" class=\"col-form-label\">Cupo Maximo:</label>
							<input type=\"text\" class=\"form-control\" name=\"cupoMaximo\" value=\"$val1\">
						  </div>
						  <div class=\"form-group\">
							<label for=\"recipient-name\" class=\"col-form-label\">Sobrecupo:</label>
							<input type=\"text\" class=\"form-control\" name=\"sobrecupo\" value=\"$val2\">
						  </div>
						  <div class=\"form-group\">
							<label for=\"recipient-name\" class=\"col-form-label\">Cuota de Manejo:</label>
							<input type=\"text\" class=\"form-control\" name=\"cuotaManejo\" value=\"$val3\">
						  </div>
						  <div class=\"form-group\">
							<label for=\"message-text\" class=\"col-form-label\">Tasa Interes:</label>
							<input type=\"text\" class=\"form-control\" name=\"tasaInteres\" value=\"$val4\"></input>
						  </div>
						  <div class=\"modal-footer\">
								<input type=\"submit\" class=\"btn btn-primary\">
								<button type =\"button\" class =\"btn btn-danger\" onclick=\"location.href = 'solicitudes.php'\">Cancelar</button>
							</div>
						</form>
					  </div>
					  
				  </div>
				</div>";
	
}
if($_GET["op"]=="cred"){
	$val=$_GET["credito"];
	$sql = "SELECT * from credito where Id= $val";
	$fila= mysqli_query($con,$sql);
	$resultado = mysqli_fetch_array($fila);
	$_SESSION["idCred"]=$_GET["credito"];
	$_SESSION["op"]=$_GET["op"];
	$val3 =$resultado['cuotaManejo'];
	$val4=$resultado['tasaInteres'];
	$str_datos="<div class=\"card\">
				  <h5 class=\"card-header h5\">Edicion Credito</h5>
				  <div class=\"card-body\">
				   
						<form action=\"guardarCambios.php\" method=\"post\">
						  
						  <div class=\"form-group\">
							<label for=\"recipient-name\" class=\"col-form-label\">Cuota de Manejo:</label>
							<input type=\"text\" class=\"form-control\" name=\"cuotaManejo\" value=\"$val3\">
						  </div>
						  <div class=\"form-group\">
							<label for=\"message-text\" class=\"col-form-label\">Tasa Interes:</label>
							<input type=\"text\" class=\"form-control\" name=\"tasaInteres\" value=\"$val4\"></input>
						  </div>
						  <div class=\"modal-footer\">
								<input type=\"submit\" class=\"btn btn-primary\">
								<button type =\"button\" class =\"btn btn-danger\" onclick=\"location.href = 'solicitudes.php'\">Cancelar</button>
							</div>
						</form>
					  </div>
					  
				  </div>
				</div>";
	
}
echo $str_datos;
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>