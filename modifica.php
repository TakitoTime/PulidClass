<?php session_start();
    require('conexion.php');

    if (!isset($_SESSION['usuario'])) {
        header('Location: index.html');
        die();
    }

    $correo = $_SESSION['usuario'];
    $contra = $_SESSION['contra'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $correonew = filter_var($_POST['correonew'], FILTER_SANITIZE_EMAIL);
        $contranew = $_POST["contranew"];
        $contranew2 = $_POST["contranew2"];
        $contranew = hash('sha512', $contranew);
        $contranew2 = hash('sha512', $contranew2);
    
        $errores = '';

        if (empty($correonew) or empty($contranew) or empty($contranew2)) {

            $errores.= '<li>Por favor rellena todos los datos correctamente</li>';

        } else{

            if (!filter_var($correonew, FILTER_VALIDATE_EMAIL)) {

                $errores.= "<li>Por favor ingresa un correo valido</li>";

            }    

            if ($contranew != $contranew2) {

                $errores.= '<li>Las contraseñas no son iguales</li>';

            }else{
            
                $statement = $conexion->prepare('call pulidclass.spModificarCuenta(:correo,:contra,:correonew,:contranew)');
                $statement->execute(array(
                        ':correo' => $correo,
                        ':contra' => $contra,
                        ':correonew'=>$correonew,
                        ':contranew'=>$contranew
                    ));
    
                $resultado = $statement->fetchColumn();
                
                switch($resultado){
                    case 1: 
                        session_unset();
                        session_destroy();
                        header('Location: index.html');
                    break;

                    case 2: 
                        $errores='<li>La cuenta no existe</li>';
                    break;

                    case 0: 
                        $errores='<li>La cuenta con el nuevo correo ya existe</li>';
                    break;
                }
            }   
        }
    }

    require('views/modifica.view.php');
?>
