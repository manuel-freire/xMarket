<?php
    require_once('comun/config.php');
    require_once(RAIZ ."negocio/DAOs/DAOUsuario.php");
    require_once(RAIZ ."negocio/Transfers/usuario.php");
    require_once(RAIZ ."controller/Form.php");
    require_once(RAIZ ."controller/UsuarioV.php");

class FormularioCredito extends Form
{
    public function __construct() {
        parent::__construct('formCredito');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $html='<label>Cantidad a añadir</label><input type="number" class="formCredito" name="credito" required>
                <button type="submit" id="submit" >Añadir</button>';
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {        
        $result = array();
        $credito = $datos['credito'];
        $usuario = UsuarioV::selectUsuarioByNick($_SESSION['nombre']);
        $usuario->setCredito($usuario->getCredito() + $credito);
        $actualiza = UsuarioV::actualiza($usuario);
        if($actualiza == '1') {
            $result = "index.php";
        } else {
            $result[] = "No se ha podido realizar la operacion con éxito. Intentelo más tarde.";        
        }
        
        return $result;        
    }    
}
?>