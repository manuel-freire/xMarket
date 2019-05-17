<?php
    require_once($_SERVER['DOCUMENT_ROOT']. "/Aw2019/comun/Definitions.php");
    require_once(RAIZ ."negocio/DAOs/DAOUsuario.php");
    require_once(RAIZ ."controller/Form.php");
    require_once(RAIZ ."controller/UsuarioV.php");
    require_once(RAIZ ."negocio/Transfers/usuario.php");    


class FormularioRegistro extends Form
{
    public function __construct() {
        parent::__construct('formRegistro');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $nombreUsuario = '';
        if ($datos) {
            $nombreUsuario = isset($datos['nombreUsuario']) ? $datos['nombreUsuario'] : $nombreUsuario;
        }
        $html='<div class="field">
                    <label for="name">Nombre usuario *</label>
                    <input name="usuario" id="name" type="text" placeholder="Name">
                </div>
                <div class="field">
                    <label for="name"> Email:*</label>
                    <input name="correo" id="name" type="email" required>
                </div>       
                </div>
                <div class="field">
                    <label for="name">Contraseña:*</label>
                    <input name="pass" id="name" type="password" required>
                </div>
                <div class="field">
                    <label for="name"> Repite Contraseña:*</label>
                    <input name="pass2" id="name" type="password" required>
                </div>
                <div class="field">
                    <label for="name"> Direccion:</label>
                    <input name="direc" id="name" type="text" required>
                </div>
                <ul class="actions">
                    <li><input value="¡Registrate!" class="button alt"  type="submit"></li>
                </ul>';
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        
        $result = array();
        
        $usuario = new Usuario();
        $contErrores = 0;
        $correo = htmlspecialchars(trim(strip_tags($datos['correo'])));
        if(!isset($datos['correo']) || is_null($datos['correo']) || empty($datos['correo'])) $contErrores++;
        else{
            $correo = htmlspecialchars(trim(strip_tags($datos['correo'])));
            if(strlen($correo)>30){
                $result[] = "El email no puede tener más de 30 caracteres.";
                $contErrores++;
            }
        }

        if(!isset($datos['usuario'])|| is_null($datos['usuario'])||empty($datos['usuario'])) $contErrores++;
        else{
            $user=htmlspecialchars(trim(strip_tags($datos['usuario'])));
            if(strlen($user)>20){
                $result[] = "El nombre de usuario no puede tener más de 20 caracteres.";
                $contErrores++;
            }
            else{           
                $correcto = DAOUsuario::selectUsuarioByNickCorreo($user,$correo);
                if(!is_null($correcto)){
                    $result[] =  "Este nombre de usuario ya se encuentra registrado. Por favor, intente con otro.";
                    $contErrores++;
                
                }
                else {
                    $usuario->setNombre($user);
                    $usuario->setEmail($correo);
                }
    	    }
        }   

        //CONTRASEÑA
        if(!isset($datos['pass'])|| is_null($datos['pass'])||empty($datos['pass'])) $contErrores++;
        else{
            $pass=htmlspecialchars(trim(strip_tags($datos['pass'])));
            if(strlen($pass)>20){
                $result[] = "La contraseña no puede tener más de 20 caracteres. Pruebe con una más corta.";
                $contErrores++;
            }
            else {
            
                $pass_hash= password_hash($pass, PASSWORD_DEFAULT);
                $usuario->setPass($pass_hash);
            }
        }

        //DIRECCION
        if(!isset($datos['direc'])|| is_null($datos['direc'])||empty($datos['direc'])) $contErrores++;
        else{
            $direccion=htmlspecialchars(trim(strip_tags($datos['direc'])));
            if(strlen($direccion)>255){
            
                $contErrores++;
            }
            else {
            
                $usuario->setDireccion($direccion);
            }
        }
        //imagen 
        //la imagen hay que tocarla, esta img pertenece img, es una imagen de la app
        $usuario->setImagen('img/usuario.png');
        //valoracion
        $usuario->setEsAdmin('0');
        $usuario->setValoracion(DEFAULT_VALORATION);
        $usuario->setCredito('0');

        if($contErrores == 0){
        
            //DAOUsuario::insertUsuario($usuario);
            if(UsuarioV::crear($usuario)) {
                $_SESSION['login']=true;
                $usuarioRegistrado = UsuarioV::selectUsuarioByNick($usuario->getNombre());
                $_SESSION['id']=$usuarioRegistrado->getId();
                $_SESSION['nombre'] = $usuario->getNombre();
                $result = "index.php";
            }
        }
        return $result;        
    }    
}
?>