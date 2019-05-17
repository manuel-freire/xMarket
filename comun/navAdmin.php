<header id="header">
    <div class="inner">
        <?php
                if(isset($_SESSION['esAdmin'])==true) {
            ?>
                    <a href="logout.php" class="logo">Desconectar</a>
            <?php
                }
            ?>
          <nav id="navAdmin">
            <a href="adminView.php">Inicio</a>
            <a href="adminView.php">Admin View</a> 
            <a href="ventasView.php">Ventas </a>
            <a href="news.php">News</a>
            
            <?php
                if(isset($_SESSION['login'])  && ($_SESSION["login"]==true)) {
            ?>
                    <a href="perfil.php?id=<?php echo $_SESSION['id'];?>">Perfil administrador</a>
            <?php
                } else {
            ?>
                    <a href="loginForm.php">Login</a> <a href="loginForm.php">inicie sesion</a>
            <?php
                }
            ?>
          </nav>
        <a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
    </div>
</header>