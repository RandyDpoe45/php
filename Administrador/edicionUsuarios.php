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
            <a class="nav-link" href="solicitudes.php" >Solicitudes de credito pendientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php" >Centro Mensajes</a>
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
                        <a class=\"nav-link\" href=\"../Vistas/login.php\">Iniciar Sesión <span class=\"sr-only\">(current)</span></a>
                      </li>
                      <li class=\"nav-item active\">
                        <a class=\"nav-link\" href=\"../Vistas/registro.php\">Registrarse <span class=\"sr-only\">(current)</span></a>
                      </li>";
          }
          else{
            $usuario = $_SESSION["userName"];
            echo "<li class=\"nav-item active\">
                    <a class=\"nav-link\" href=\"\">Bienvenido $usuario <span class=\"sr-only\">(current)</span></a>
                  </li>
                  <li class=\"nav-item active\">
                    <a class=\"nav-link\" href=\"../Vistas/logOut.php\">Cerrar Sesión <span class=\"sr-only\">(current)</span></a>
                  </li>";
          }
        ?>
        


    </ul>
      </div>
    </nav>
	<?php
$str_datos ="";	
$idu = $_GET["idu"];
include_once dirname(__FILE__) . '../../Configuracion/config.php';

$con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
if (mysqli_connect_errno()) {
$str_datos.= "Error en la conexión: " . mysqli_connect_error();
}
$sql = "select * from usuario where Id = $idu "; 
$resultado = mysqli_query($con,$sql);
$fila = mysqli_fetch_array($resultado);
if($_GET["op"]=="Administrador"){
	$str_datos.="<div class=\"card \">
  <h5 class=\"card-header h5\">Edicion usuario</h5>
  <div class=\"card-body\">";	
  $val1 = $fila["UserName"];
  $val2 = $fila["type"];
  $_SESSION["idu"] = $idu;
	
						
						$str_datos.="<form action=\"guardarCambiosUsuario.php\" method=\"post\">
						  
						  
						  <div class=\"form-group\">
							<label for=\"message-text\" class=\"col-form-label\">Nombre de usuario:</label>
							<input type=\"text\" class=\"form-control\" name=\"UserName\" value=\"$val1\"></input>
						  </div>
						  <div>
								<label>Tipo de usuario</label>
								<select class=\"form-control\" name=\"tipoUsuario\" value=\"Administrador\" >
										<option value=\"Usuario\">Cliente</option>
										<option value=\"Administrador\">Administrador</option>
								</select>
							</div>
						  <div class=\"modal-footer\">
								<input type=\"submit\" class=\"btn btn-primary\">
								<button type =\"button\" class =\"btn btn-danger\" onclick=\"location.href = 'solicitudes.php'\">Cancelar</button>
							</div>
						</form>
					  </div>";
					  
				  
		$str_datos.="</div>";
		$str_datos.="</div>";
		echo $str_datos;
}
if(  $_GET["op"]=="Usuario" ){
	$str_datos.="<div class=\"card \">
  <h5 class=\"card-header h5\">Edicion usuario</h5>
  <div class=\"card-body\">";	
  $val1 = $fila["UserName"];
  $val2 = $fila["type"];
  $_SESSION["idu"] = $idu;
	
						
						$str_datos.="<form action=\"guardarCambiosUsuario.php\" method=\"post\">
						  
						  
						  <div class=\"form-group\">
							<label for=\"message-text\" class=\"col-form-label\">Nombre de usuario:</label>
							<input type=\"text\" class=\"form-control\" name=\"UserName\" value=\"$val1\"></input>
						  </div>
						  <div>
								<label>Tipo de usuario</label>
								<select class=\"form-control\" name=\"tipoUsuario\" value=\"$val2\" >
										<option value=\"Usuario\">Cliente</option>
										<option value=\"Administrador\">Administrador</option>
								</select>
							</div>
						  <div class=\"modal-footer\">
								<input type=\"submit\" class=\"btn btn-primary\">
								<button type =\"button\" class =\"btn btn-danger\" onclick=\"location.href = 'solicitudes.php'\">Cancelar</button>
							</div>
						</form>
					  </div>";
					  
				  
		$str_datos.="</div>";
		$str_datos.="</div>";
		echo $str_datos;
}
	if($_GET["op"]=="Usuario"){
		
$str_datos="<div class=\"card \">
  <h5 class=\"card-header h5\">creditos usuario</h5>
  <div class=\"card-body\">";	
	


$str_datos.='<table  class="table table-dark" >';
$str_datos.='<thead>';
$str_datos.='<tr>';
$str_datos.='<th scope=\"col\">Id prestamo</th>';
$str_datos.='<th scope=\"col\">Tasa interes</th>';
$str_datos.='<th scope=\"col\">Cuota manejo</th>';
$str_datos.='<th scope=\"col\">Editar</th>';
$str_datos.='</tr>';
$str_datos.='</thead>';
$str_datos.='<tbody>';
$sql = "SELECT c.Id, c.tasaInteres, c.cuotaManejo FROM credito c inner join usuario u on c.idUsuario = u.ID  where aprobado = true and u.ID = $idu ";
$resultado = mysqli_query($con,$sql);
while($fila = mysqli_fetch_array($resultado)) {
$str_datos.='<tr>';
$str_datos.="<th scope=\"row\">".$fila['Id']."</th>";
$str_datos.= "<td>".$fila['tasaInteres']."</td>";
$str_datos.="<td>".$fila['cuotaManejo']."</td>";
$str_datos.= "<td><button type =\"button\" class =\"btn btn-success\" onclick=\"location.href = 'aprobar.php?credito=".$fila['Id']. "&op=cred'\">Editar</button></td>";
$str_datos.= "</tr>";
}
$str_datos.='</tbody>';
$str_datos.= "</table>";

$str_datos.="</div>";
$str_datos.="</div>";


$str_datos.="<div class=\"card \">";
$str_datos.="  <h5 class=\"card-header h5\">tarjetas de credito </h5>";
$str_datos.=" <div class=\"card-body\">";



$str_datos.='<table  class="table table-dark" >';
$str_datos.='<thead>';
$str_datos.='<tr>';
$str_datos.='<th scope=\"col\">Id Tarjeta</th>';
$str_datos.='<th scope=\"col\">cupo maximo </th>';
$str_datos.='<th scope=\"col\">sobrecupo </th>';
$str_datos.='<th scope=\"col\">cuota de manejo </th>';
$str_datos.='<th scope=\"col\">Tasa interes</th>';
$str_datos.='<th scope=\"col\">Editar</th>';
$str_datos.='</tr>';
$str_datos.='</thead>';
$str_datos.='<tbody>';
$sql = "SELECT  c.Id ,c.cupoMaximo,c.sobrecupo,c.tasaInteres, c.cuotaManejo FROM tarjetacredito c inner join cuentaahorros u on u.NumCuenta  = c.idCuenta inner join usuario o on u.UserID = o.Id where
 aprobada = true and u.UserID = $idu ";

$resultado = mysqli_query($con,$sql);

while($fila = mysqli_fetch_array($resultado)) {
$str_datos.='<tr>';
$str_datos.="<th scope=\"row\">".$fila['Id']."</th>";
$str_datos.= "<td>".$fila['cupoMaximo']."</td>";
$str_datos.="<td>".$fila['sobrecupo']."</td>";
$str_datos.="<td>".$fila['cuotaManejo']."</td>";
$str_datos.="<td>".$fila['tasaInteres']."</td>";
$str_datos.= "<td><button type =\"button\" class =\"btn btn-success\" onclick=\"location.href = 'aprobar.php?credito=".$fila['Id']. "&op=tarj'\">Editar</button></td>";
$str_datos.= "</tr>";
}
$str_datos.='</tbody>';
$str_datos.= "</table>";


$str_datos.="</div>";
$str_datos.="</div>";
echo $str_datos;
mysqli_close($con);
}
if($_GET["op"]=="visi"){
$str_datos = "";
$str_datos.="<div class=\"card\">";
$str_datos.="  <h5 class=\"card-header h5\">credito Visitantes</h5>
  <div class=\"card-body\">";


include_once dirname(__FILE__) . '../../Configuracion/config.php';

$con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
if (mysqli_connect_errno()) {
$str_datos.= "Error en la conexión: " . mysqli_connect_error();
}
$idu = $_GET["idu"];
$str_datos.='<table  class="table table-dark" >';
$str_datos.='<thead>';
$str_datos.='<tr>';
$str_datos.='<th scope=\"col\">Id prestamo</th>';
$str_datos.='<th scope=\"col\">Tasa interes</th>';
$str_datos.='<th scope=\"col\">Cuota manejo</th>';
$str_datos.='<th scope=\"col\">Editar</th>';
$str_datos.='</tr>';
$str_datos.='</thead>';
$str_datos.='<tbody>';
$sql = "SELECT c.Id, c.tasaInteres , c.cuotaManejo , aprobado FROM credito c inner join visitante u on u.cedula = c.cedulaVisitante where  c.cedulaVisitante = $idu";
$resultado = mysqli_query($con,$sql);
while($fila = mysqli_fetch_array($resultado)) {
$str_datos.='<tr>';
$str_datos.="<th scope=\"row\">".$fila['Id']."</th>";
$str_datos.= "<td>".$fila['tasaInteres']."</td>";
$str_datos.="<td>".$fila['cuotaManejo']."</td>";
$str_datos.= "<td><button type =\"button\" class =\"btn btn-success\" onclick=\"location.href = 'aprobar.php?credito=".$fila['Id']. "&op=cred'\">Editar</button></td>";
$str_datos.= "</tr>";
}
$str_datos.="</tbody>";
$str_datos.= "</table>";


$str_datos.="</div>";
$str_datos.="</div>";
echo $str_datos;
mysqli_close($con);
}

	
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>