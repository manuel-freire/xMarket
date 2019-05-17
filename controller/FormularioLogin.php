<?php
    require_once('comun/config.php');
    require_once(RAIZ ."negocio/DAOs/DAOUsuario.php");
    require_once(RAIZ ."negocio/DAOs/DAOModerador.php");
    require_once(RAIZ ."controller/Form.php");
    require_once(RAIZ ."controller/UsuarioV.php");

class FormularioLogin extends Form
{
    public function __construct() {
        parent::__construct('formLogin');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $html='<div class="field half first">
                <label for="name">Nombre de usuario o DNI</label>
                <input type="text" name="user" placeholder ="Nickname o DNI" required> 
            </div>
       
            <div class="field half">
                <label for="name">Password*</label>
                <input type="password" name="pass" value="" required>
            </div>
     
            <ul class="actions">
                <li><input value="login" class="button alt" type="submit" name="accept"></li>
            </ul>';
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        
        $result = array();
        $id = htmlspecialchars(trim(strip_tags($datos['user'])));  
        $pass = htmlspecialchars(trim(strip_tags($datos['pass']))); 

        //$user = UsuarioV::searchUsuario($id,$pass);
        $user = DAOUsuario::searchUsuario($id,$pass);
        $_SESSION['login'] = false;

        if(!is_null($user)) {
            $moderador = DAOModerador::selectModerador($user->getId());
            $_SESSION['login']=true;
            $_SESSION['id']=$user->getId();
            $_SESSION['nombre'] = $user->getNombre();
            //if($user->getNombre() == 'admin'){
            if($user->getEsAdmin() == '1') {
                $_SESSION['esAdmin'] = true;
                $_SESSION['esModerador'] = false;   
                $result="adminView.php";
            } else if (!is_null($moderador)) {
                $_SESSION['esModerador'] = true;
                $_SESSION['categoria'] = $moderador->getCategoria();
                $result="index.php";
            } else $result="index.php";
            
        } else {
            $result[] = "Usuario o contraseña no coinciden";
        }
        
        return $result;        
    }    
}
?>