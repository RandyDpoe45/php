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
      
</nav>
<main role="main" class="container mt-3 pt-5">
<div class="my-3 p-3 bg-white rounded box-shadow">
	<?php
		session_start();
		include_once dirname(__FILE__).'../../Configuracion/config.php';

		$con=mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
		 
		// Check connection
		if (mysqli_connect_errno()) {
			echo "Error en la conexión: " . mysqli_connect_error();
		}
		$nn = $_GET['usu'];
		$sql1 = "SELECT * FROM Usuario where UserName = '$nn'";
		$fila = mysqli_query($con, $sql1) ;
		$result = mysqli_fetch_array($fila);
		
	?>
          
		  <div class="form-group">
            <label for="recipient-name" class="col-form-label">NombreUsuario:</label>
            <input type="text"label class="col-form-label" value = "<?php echo $result['UserName'];?>"></label>
          </div>
		  <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tipo:</label>
            <input type="text" class="col-form-label" value="<?php echo $result['Tipo'];?>"></input>
          </div>
</main>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>