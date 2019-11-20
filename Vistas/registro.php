<html> 
  <head>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <body>

    <div class="margen">
      <div class="container-fluit text-align-center row">
        <div class="col-md-4"></div>
        <div class="jumbotron  col-md-5">
        	<h1 class="display-4">Registrarse</h1>
          
		<form action="comprobarRegistro.php" method="post">
            <div class="form-group">
              <label >Nombre de usuario</label>
              <input type="userName" class="form-control" name="userName" placeholder="Nombre de usuario" required>
            </div>
            <div class="form-group">
              <label >Contraseña</label>
              <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
            </div>

            <div class="form-group">
              <label >Correo</label>
              <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>

            <div>
                <label>Tipo de usuario</label>
                <select class="form-control" name="tipo"> 
                    <option value='Usuario'>Usuario</option>
                    <option value='Administrador'>Administrador</option>
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