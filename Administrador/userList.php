<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<title></title>
</head>
<body class="bg-light">
	<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Gestor BD</a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#" >Solicitudes pendientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" >Centro Mensajes</a>
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
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
	
<main role="main" class="container mt-3 pt-5">
<div class="my-3 p-3 bg-white rounded box-shadow">
<?php
session_start();
include_once dirname(__FILE__) . '../../Configuracion/config.php';
$str_datos = "";
$con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
if (mysqli_connect_errno()) {
$str_datos.= "Error en la conexión: " . mysqli_connect_error();
}
$param = 'Cedula';
$orden = 'ASC';
if(isset($_SESSION['parametro'])){
	$param = $_SESSION['parametro'];
}
if(isset($_SESSION['ordenamiento'])){
	$orden = $_SESSION['ordenamiento'];
}
$str_datos.='<table  class="table table-dark" >';
$str_datos.='<thead>';
$str_datos.='<tr>';
$str_datos.='<th scope=\"col\">UserName</th>';
$str_datos.='<th scope=\"col\">Tipo</th>';
$str_datos.='<th scope=\"col\">Editar</th>';
$str_datos.='</tr>';
$str_datos.='</thead>';
$str_datos.='<tbody>';
$sql = "SELECT * FROM Usuario  ";
$resultado = mysqli_query($con,$sql);
while($fila = mysqli_fetch_array($resultado)) {
$str_datos.='<tr>';
$str_datos.="<th scope=\"row\">".$fila['UserName']."</th>";
$str_datos.= "<td>".$fila['Tipo']."</td>";
$str_datos.= "<td><a href=\""."profileEdit.php?usu=".$fila['UserName']. "\">Editar</a><td>";
$str_datos.= "</tr>";
}
$str_datos.='</tbody>';
$str_datos.= "</table>";
echo $str_datos;
mysqli_close($con);
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>