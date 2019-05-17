<?php
    require_once('comun/config.php');
    require_once(RAIZ ."negocio/DAOs/DAOUsuario.php");
    require_once(RAIZ ."negocio/Transfers/usuario.php");
    require_once(RAIZ ."controller/Form.php");
    require_once(RAIZ ."controller/UsuarioV.php");

class FormularioEditar extends Form
{
    public function __construct() {
        parent::__construct('formEditar');
    }
    
    protected function generaCamposFormulario($datos)
    {
        
        $html='<p>Nombre de usuario: (introduce el nuevo) <input type="text" name="nombre"  ></p>
        <p>Email:(introduce el nuevo) <input type="text" name="email" ></p>
        <p>Direccion:(introduce el nuevo) <input type="text" name="direc" ></p>
        <p>Nueva contraseña: (introduce el nuevo)<input type="text" name="contraseña" ></p>
        <p>Repite contraseña: (introduce el nuevo)<input type="text" name="new_contraseña" ></p>
        <input type="submit" value="Enviar">';
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {        
        $result = array();
        $usuario = UsuarioV::selectUsuarioByID($_SESSION['id']);
        $contErrores = 0;
        $correo = htmlspecialchars(trim(strip_tags($_POST['email'])));
        if(isset($_POST['email']) && !is_null($_POST['email']) && !empty($_POST['email'])){
       
            $correo = htmlspecialchars(trim(strip_tags($_POST['email'])));
            if(strlen($correo)>30){
                $result[] = "El email no puede tener más de 30 caracteres.";
                $contErrores++;
            }
            else $usuario->setEmail($correo);
       
        }
        if(isset($_POST['nombre'])&& !is_null($_POST['nombre'])&&!empty($_POST['nombre'])){
      
            $user=htmlspecialchars(trim(strip_tags($_POST['nombre'])));
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
                   
                   $_SESSION['nombre'] = $user;
                }
            }
         }  

        //CONTRASEÑA
        if(isset($_POST['contraseña'])&& !is_null($_POST['contraseña'])&&!empty($_POST['contraseña'])&& isset($_POST['new_contraseña'])&& !is_null($_POST['new_contraseña'])&& !empty($_POST['new_contraseña'])) {
        
            $pass=htmlspecialchars(trim(strip_tags($_POST['contraseña'])));
            $pass2=htmlspecialchars(trim(strip_tags($_POST['new_contraseña'])));
            if(strlen($pass)>20 || strcmp($pass, $pass2) !== 0){
                $result[] = "La contraseña no puede tener más de 20 caracteres. Pruebe con una más corta.";
                $contErrores++;
            }
            else {
            
                $pass_hash= password_hash($pass, PASSWORD_DEFAULT);
                $usuario->setPass($pass_hash);
            }
        }

        //DIRECCION
        if(isset($_POST['direc'])&& !is_null($_POST['direc'])&&!empty($_POST['direc'])){
      
            $direccion=htmlspecialchars(trim(strip_tags($_POST['direc'])));
            if(strlen($direccion)>255){
            
                $contErrores++;
            }
            else {
            
                $usuario->setDireccion($direccion);
            }
        }
        //imagen 
        //la imagen hay que tocarla, esta img pertenece img, es una imagen de la app
       
        if($contErrores == 0){
        
            //DAOUsuario::insertUsuario($usuario);
            if(!UsuarioV::editar_perfil($usuario,$_SESSION['id'])) {
                $result[] = "Ha ocurrido un error con el proceso. Intentelo de nuevo";    
            } else $result="perfil.php";
        }

        return $result;
    }    
}
?>