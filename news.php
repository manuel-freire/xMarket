<?php
     require_once('comun/config.php');
     require_once (RAIZ . 'comun/config.php');
?>
<!DOCTYPE HTML>
<html>
    <head>
        <!--<link rel="stylesheet" type="text/css" href="estilo.css" /> -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="assets/css/main.css" />
        <title>XMarket</title>
    </head>

    <body>
          
        <!-- menú de navegación -->
        <?php
                if(isset($_SESSION['login'])  && isset($_SESSION["esAdmin"]) && ($_SESSION["login"]===true)) {
                    require ('comun/navAdmin.php');
            
                    
            
                } else {
                    require ('comun/nav.php');
            
                    
            
                }
            ?>

        <!-- menu de categorias -->
        <?php require ('comun/selectCategories.php'); 
        /*
        if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'] == true) {
        ?>
            <form action="procesaNews.php" method="POST">
                <textarea id="new" name="new">
                <input value="login" class="button alt" type="submit" name="accept">
            </form>
        <?php    
        }
        */
        //he intentado hacer que el admin meta cosas en news, pero el texarea se me va a la puta.
        ?>




        <section id="three" class="wrapper">
                <fieldset>
                    <h4>Mensaje de: admin</h4>
                    <p>Hola amigos de Xmarket. Este mensaje tiene como objetivo tener una convivencia en este espacio virtual
                    sana y sin ningún tipo de insulto y/o falta de respeto. Desde la administración nos encargaremos personalmente
                    de que no ocurra ningún incidente de este tipo.</p>
                    <p>Gracias por su atención</p>
                    <p>Administrador</p>
                </fieldset>

                <fieldset>
                    <h4>Mensaje de: admin</h4>
                    <p>Hola amigos de Xmarket. Bienvenidos a esta aplicación novedosa. En ella, podrás encontrar los mejores artículos 
                    de ropa, libros y juguetes al precio que cualquier usuario pondría! Esperemos que disfruteis de la web, y nos deis
                    feedback de lo que os parece.</p>
                    <p>Gracias por su atención</p>
                    <p>Administrador</p>
                </fieldset>
            </section>

    

        
    </body>
</html>