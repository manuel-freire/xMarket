<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/aw2019/comun/Definitions.php");
require_once(RAIZ ."negocio/DAOS/DAOModerador.php");
require_once(RAIZ ."negocio/Transfers/moderador.php");
//Inicio del procesamiento

$operacion= isset($_POST['operacion']) ? $_POST['operacion'] : null;

	if($operacion == "eliminar"){

        $id= $_POST['usuario'];//isset($_POST['id']) ? $_POST['id'] : null;
    
	DAOModerador::deleteModerador($id);
	echo "<script>
    
       window.location.href= '../adminView.php'; 
       </script>";

    }
    else{ 
    // se le llama cuando quiero añadir un nuevo moderador 
   
      if(!isset($_POST['categoria']) || empty(($_POST['categoria']))|| $_POST['categoria'] == "nada" ){
   
        echo "<script>
            
               window.location.href= '../adminView.php#administr'; 
               </script>";

      }
       else {
        $nuevoModer= $_POST['moderador'];//isset($_POST['id']) ? $_POST['id'] : null;
        $categoria =$_POST['categoria'] ;

        if(DAOModerador::selectModeradorByCategoria($categoria) != null || DAOModerador::selectModerador($nuevoModer) != null) {// ya hay un moderafdor para esta categori
            
            echo "<script>
               window.location.href= '../AdminView.php#administr'; 
               </script>";
        }
        else{
            $moderador = new Moderador();
            $moderador->setId($nuevoModer);
            $moderador->setCategoria($categoria);
            DAOModerador::insertModerador($moderador);
            echo $_POST['categoria'];
            echo "<script>
            
               window.location.href= '../AdminView.php#administr'; 
               </script>";
        }
}
    }







?>