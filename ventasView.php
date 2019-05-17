<?php


require_once('comun/config.php');
require_once(RAIZ . "controller/VentaV.php");
require_once('comun/config.php');

?>



<!DOCTYPE html>
<html lang="es">
<head>
	<title>XMARKET : RESUMEN VENTAS</title>
	<meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/main.css" />

	
	
	
</head>
<body>
    
    <?php
                if(isset($_SESSION['login'])  && isset($_SESSION["esAdmin"]) && ($_SESSION["login"]===true)) {
                    require ('comun/navAdmin.php');
            
                    
            
                } else {
                    require ('comun/nav.php');
            
                    
            
                }
            ?>

        <!-- menu de categorias -->
        <?php require ('comun/selectCategories.php'); ?>
	<?php
$ventas = new VentaV();
$arr = array();
$beneficio = array();
for($i = 1 ;$i<13;$i++){
	
	$cantidad = $ventas->selectVentaByFecha("$i");
	array_push($arr, $cantidad);
	$beneficios = $ventas->recaudacion("$i");
	array_push($beneficio, $beneficios);
   
}





	?>
<div id="contenedor"></div>

<script src="https://code.jquery.com/jquery.js"></script>
    <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script>

chartCPU = new Highcharts.Chart({
    chart: {
        renderTo: 'contenedor'
        //defaultSeriesType: 'line'

    },
   /* rangeSelector : {
        enabled: false
    },*/
    title: {
        text: 'Ventas Anual'
    },
    xAxis: {
       categories: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre',
'Noviembre','Diciembre'],
        //tickPixelInterval: 150,
        //maxZoom: 20 * 1000
        title: {
					text: 'Meses'
				}
    },
    yAxis: {
        minPadding: 0.1,
        maxPadding: 0.1,
        title: {
            text: 'Ventas',
            margin: 10
        }
    },
    series: [{
        name: 'Nmero de Ventas',
        data: (function() {
                // generate an array of random data
                var data = [];
                <?php
                    for($i = 0 ;$i<12;$i++){
                ?>
                data.push([<?php echo $arr[$i];?>]);
                <?php } ?>
                return data;
            })()
    }],
    credits: {
            enabled: false
    }
});

</script>   


</body>
</html>

