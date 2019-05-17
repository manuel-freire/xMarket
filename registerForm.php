
<?php
    require_once('comun/config.php');
    require_once (RAIZ . 'controller/FormularioRegistro.php');
    require_once (RAIZ . 'comun/config.php');

    $form = new FormularioRegistro(); $a = $form->gestiona();
    
?>
<!DOCTYPE HTML>
<html>
    <head>
    	<script type="text/javascript" src="GestionarFormulario.js"></script>
        <link rel="stylesheet" type="text/css" href="estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>XMarket</title>
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>

    <body>
        <!-- MENÚ DE NAVEGACIÓN -->
        <?php require ('comun/nav.php'); ?>

        <?php require ('comun/selectCategories.php'); ?>

        
        
        <footer id="footer">
                <div class="inner">

                    <h3>¡Registrate!</h3>
                    <?php echo $a;?>
			
                    <!--
                    <form action="controller/procesarRegistro.php" method="post">

                        <div class="field">
                            <label for="name">Nombre usuario *</label>
                            <input name="usuario" id="name" type="text" placeholder="Name">
                        </div>
                        <div class="field">
                            <label for="name"> Email:*</label>
                            <input name="correo" id="name"type="email" required>
                        </div>
                        
                            
                        </div>
                        <div class="field">
                            <label for="name">Contraseña:*</label>
                            <input name="pass" id="name"type="password" required>
                        </div>
                        <div class="field">
                            <label for="name"> Repite Contraseña:*</label>
                            <input name="pass2" id="name"type="password" required>
                        </div>
                        
                        <div class="field">
                            <label for="name"> Direccion:</label>
                            <input name="direc" id="name"type="text" required>
                        </div>

                        
                        

                     
						<ul class="actions">
                            <li><input value="¡Registrate!" class="button alt" type="submit"></li>
                        </ul>
                        
                    </form>
                -->
                </div>
            </footer>
    </body>
</html>
