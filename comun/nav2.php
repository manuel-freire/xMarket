<header id="header">
				<div class="inner">
					<?php
                if(isset($_SESSION['login'])==true) {
            ?>
                    <a href="logout.php" class="logo">Desconectar</a>
            <?php
                }else{
            ?>
                    <a href="index.php" class="logo"><strong>Proyecto para la asignatura AW</strong> por grupo 2</a>
            <?php
                }
            ?>
					<nav id="nav">
                        <a href="index.php">Home</a>
                        <a href="sell.php">Sell</a>
                        <a href="productos.php">Productos</a>
                        <a href="news.php">News</a>
                        <a href="about.php">About</a>
            <?php
                if(isset($_SESSION['login'])  && ($_SESSION["login"]===true)) {
            ?>
                    <a href="perfil.php?id=<?php echo $_SESSION['id'];?>">Mi Perfil</a>
            <?php
                } else {
            ?>
                    <a href="loginForm.php">Login</a> <a href="registerForm.php">Regístrate</a>
            <?php
                }
            ?>
          </nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>