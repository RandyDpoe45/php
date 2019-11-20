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
<div class="card ">
  <h5 class="card-header h5">Solicitudes credito usuarios</h5>
  <div class="card-body">	
	
<?php
session_start();
include_once dirname(__FILE__) . '../../Configuracion/config.php';
$str_datos = "";
$con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
if (mysqli_connect_errno()) {
$str_datos.= "Error en la conexión: " . mysqli_connect_error();
}

$str_datos.='<table  class="table table-dark" >';
$str_datos.='<thead>';
$str_datos.='<tr>';
$str_datos.='<th scope=\"col\">Id prestamo</th>';
$str_datos.='<th scope=\"col\">Tasa interes</th>';
$str_datos.='<th scope=\"col\">Nombre de usuario </th>';
$str_datos.='<th scope=\"col\">Cuota manejo</th>';
$str_datos.='<th scope=\"col\">Aprobar</th>';
$str_datos.='<th scope=\"col\">Rechazar</th>';
$str_datos.='</tr>';
$str_datos.='</thead>';
$str_datos.='<tbody>';
$sql = "SELECT c.Id, c.tasaInteres, u.UserName , c.cuotaManejo FROM credito c inner join usuario u on c.idUsuario = u.ID  where aprobado = false ";
$resultado = mysqli_query($con,$sql);
while($fila = mysqli_fetch_array($resultado)) {
$str_datos.='<tr>';
$str_datos.="<th scope=\"row\">".$fila['Id']."</th>";
$str_datos.= "<td>".$fila['tasaInteres']."</td>"."<td>".$fila['UserName']."</td>";
$str_datos.="<td>".$fila['cuotaManejo']."</td>";
$str_datos.= "<td><button type =\"button\" class =\"btn btn-success\" onclick=\"location.href = 'aprobar.php?credito=".$fila['Id']. "&op=cred'\">Aprobar</button></td>";
$str_datos.= "<td><button type =\"button\" class =\"btn btn-danger\" onclick=\"location.href = 'rechazar.php?credito=".$fila['Id']. "'\">Rechazar</button></td>";
$str_datos.= "</tr>";
}
$str_datos.='</tbody>';
$str_datos.= "</table>";
echo $str_datos;
mysqli_close($con);
?>
</div>
</div>


<div class="card ">
  <h5 class="card-header h5">Solicitudes tarjeta de credito </h5>
  <div class="card-body">
<?php

include_once dirname(__FILE__) . '../../Configuracion/config.php';
$str_datos = "";
$con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
if (mysqli_connect_errno()) {
$str_datos.= "Error en la conexión: " . mysqli_connect_error();
}

$str_datos.='<table  class="table table-dark" >';
$str_datos.='<thead>';
$str_datos.='<tr>';
$str_datos.='<th scope=\"col\">Id Tarjeta</th>';
$str_datos.='<th scope=\"col\">nombre de usuario </th>';
$str_datos.='<th scope=\"col\">Cuota manejo</th>';
$str_datos.='<th scope=\"col\">Aprobar</th>';
$str_datos.='<th scope=\"col\">Rechazar</th>';
$str_datos.='</tr>';
$str_datos.='</thead>';
$str_datos.='<tbody>';
$sql = "SELECT  c.Id ,o.UserName , c.cuotaManejo FROM tarjetacredito c inner join cuentaahorros u on u.NumCuenta  = c.idCuenta inner join usuario o on u.UserID = o.Id where
 c.aprobada = false ";

$resultado = mysqli_query($con,$sql);

while($fila = mysqli_fetch_array($resultado)) {
$str_datos.='<tr>';
$str_datos.="<th scope=\"row\">".$fila['Id']."</th>";
$str_datos.= "<td>".$fila['UserName']."</td>";
$str_datos.="<td>".$fila['cuotaManejo']."</td>";
$str_datos.= "<td><button type =\"button\" class =\"btn btn-success\" onclick=\"location.href = 'aprobar.php?credito=".$fila['Id']. "&op=tarj'\">Aprobar</button></td>";
$str_datos.= "<td><button type =\"button\" class =\"btn btn-danger\" onclick=\"location.href = 'rechazar.php?credito=".$fila['Id']. "'\">Rechazar</button></td>";
$str_datos.= "</tr>";
}
$str_datos.='</tbody>';
$str_datos.= "</table>";
echo $str_datos;
mysqli_close($con);
?>
</div>
</div>

<div class="card">
  <h5 class="card-header h5">Solicitudes credito Visitantes</h5>
  <div class="card-body">
<?php

include_once dirname(__FILE__) . '../../Configuracion/config.php';
$str_datos = "";
$con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
if (mysqli_connect_errno()) {
$str_datos.= "Error en la conexión: " . mysqli_connect_error();
}

$str_datos.='<table  class="table table-dark" >';
$str_datos.='<thead>';
$str_datos.='<tr>';
$str_datos.='<th scope=\"col\">Id prestamo</th>';
$str_datos.='<th scope=\"col\">Tasa interes</th>';
$str_datos.='<th scope=\"col\">Cedula </th>';
$str_datos.='<th scope=\"col\">Cuota manejo</th>';
$str_datos.='<th scope=\"col\">Aprobar</th>';
$str_datos.='<th scope=\"col\">Rechazar</th>';
$str_datos.='</tr>';
$str_datos.='</thead>';
$str_datos.='<tbody>';
$sql = "SELECT c.Id, c.tasaInteres, u.cedula , c.cuotaManejo FROM credito c inner join visitante u on u.cedula = c.cedulaVisitante where c.aprobado = false ";
$resultado = mysqli_query($con,$sql);
while($fila = mysqli_fetch_array($resultado)) {
$str_datos.='<tr>';
$str_datos.="<th scope=\"row\">".$fila['Id']."</th>";
$str_datos.= "<td>".$fila['tasaInteres']."</td>"."<td>".$fila['cedula']."</td>";
$str_datos.="<td>".$fila['cuotaManejo']."</td>";
$str_datos.= "<td><button type =\"button\" class =\"btn btn-success\" onclick=\"location.href = 'aprobar.php?credito=".$fila['Id']. "&op=cred'\">Aprobar</button></td>";
$str_datos.= "<td><button type =\"button\" class =\"btn btn-danger\" onclick=\"location.href = 'rechazar.php?credito=".$fila['Id']. "'\">Rechazar</button></td>";
$str_datos.= "</tr>";
}
$str_datos.='</tbody>';
$str_datos.= "</table>";
echo $str_datos;
mysqli_close($con);
?>
</div>
</div>


<?php
	
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>