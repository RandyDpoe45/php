
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="">ProyectoPHP</a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <?php //Parte Izquierda del navBar ?>
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

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>