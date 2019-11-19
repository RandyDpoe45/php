<?php
    session_start();
    //session_destroy();
    include_once dirname(__FILE__).'\Configuracion\BD.php';
    $DataBase = new DB();
?>


<html>
    <head>
        
    </head>
    <body>
        <?php include_once dirname(__FILE__).'\Vistas\navBar.php'; ?>

        <?php
            if(isset($_SESSION['type'])){
                if($_SESSION['type'] == "Usuario"){
                    include_once dirname(__FILE__).'\Usuario\index.php';
                }
                if($_SESSION['type'] == "Administrador"){
                    include_once dirname(__FILE__).'\Administrador\index.php';
                }
            }
            else{
                include_once dirname(__FILE__).'\Visitante\index.php';
            }
        ?>    

    
    </body>
</html>