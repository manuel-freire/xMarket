<?php

$url=$_SERVER["REQUEST_URI"];

$h1="Bienvenido a Xmarket";

			switch ($url) {
	               case '/Aw2019/sell.php':
		           $h1="Vende tu producto en Xmarket";
		           break;
	               case '/Aw2019/news.php':
		           $h1="Novedades en Xmarket";
		           break;
	               case '/Aw2019/productos.php?estado=0':
		           $h1="Productos en venta en Xmarket";
				   break;
				   case '/Aw2019/productos.php?estado=1':
		           $h1="Productos pendientes en Xmarket";
		           break;
	               case '/Aw2019/registerForm.php':
		           $h1="Registrate en Xmarket";
		           break;
		           case '/Aw2019/index.php':
		           $h1="Bienvenido a Xmarket";
		           break;
		           case '/Aw2019/about.php':
		           $h1="¿Quiénes somos?";
		           break;
		           case '/Aw2019/adminView.php':
		           $h1="Página de administración";
		           break;
		           case '/Aw2019/ventasView.php':
		           $h1="Número de ventas en nuestro dominio";
		           break;
		          

}
	
?>
<section id="banner">
    <div class="inner">
		<header>

			<?php
			echo"<h1>$h1</h1>";
			?>
		</header>
    
        <div class="flex ">
			<a href="productos.php?estado=5"><div>
				<span class="icon fa-car"></span>
				<h3>Ropa</h3>
				<p>Camisetas, calzado, corbatas, vestidos...</p>
			</div></a>
			<a href="productos.php?estado=3"><div>
				<span class="icon fa-camera"></span>
				<h3>Libros</h3>
				<p>Tenemos infinidad de libros</p>
			</div></a>
			<a href="productos.php?estado=4"><div>  
				<span class="icon fa-bug"></span>
				<h3>Juguetes</h3>
				<p>Para todas las edades</p>
			</div></a>
		</div>
		<footer>
			<a href="sell.php" class="button">¡Compra o vende lo que quieras!</a>
		</footer>
	</div>
</section>          