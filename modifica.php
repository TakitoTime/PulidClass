<?php session_start();
    require('conexion.php');

    if (!isset($_SESSION['cliente'])) {
        header('Location: index.php');
        die();
    }

    $correo = $_SESSION['cliente'];
    $contra = $_SESSION['contra'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $contranew = $_POST["contranew"];
        $contranew2 = $_POST["contranew2"];
        $contranew = hash('sha512', $contranew);
        $contranew2 = hash('sha512', $contranew2);
    
        $errores = '';

        if (empty($contranew) or empty($contranew2)) {

            $errores.= '<li>Por favor rellena todos los datos correctamente</li>';

        } else{  

            if ($contranew != $contranew2) {

                $errores.= '<li>Las contraseñas no son iguales</li>';

            }else{
            
                $statement = $conexion->prepare('call pulidclass.spModificarCuenta(:correo,:contranew)');
                $statement->execute(array(
                        ':correo' => $correo,
                        ':contranew'=>$contranew
                    ));
    
                $resultado = $statement->fetchColumn();
                
                header('Location: perfil.php');

            }   
        }
    }

    require('views/modifica.view.php');
?>
