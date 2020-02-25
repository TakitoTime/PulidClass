<?php session_start();
    require('conexion.php');

    if (!isset($_SESSION['usuario'])) {
        header('Location: index.html');
        die();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
        $contra = $_POST['contra'];
        $contra = hash('sha512', $contra);
    
        $errores = '';

        if (empty($correo) or empty($contra)) {

            $errores.= '<li>Por favor rellena todos los datos correctamente</li>';

        } else{

            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {

                $errores.= "<li>Por favor ingresa un correo valido</li>";

            } else{
                if(($_SESSION['usuario']!= $correo) || ($_SESSION['contra'] != $contra)){

                    $errores.= "<li>La cuenta con este correo electronico o con esta contraseña no existe</li>";
                    
                }else{

                    $statement = $conexion->prepare('call pulidclass.spBajaCuenta(:correo,:contra)');
                    $statement->execute(array(
                            ':correo' => $correo,
                            ':contra' => $contra
                        ));
        
                    $resultado = $statement->fetchColumn();
                    
                    switch($resultado){
                        case 0: 
                            session_unset();
                            session_destroy();
                            header('Location: index.html');
                        break;

                        case 1: 
                            $errores='<li>La cuenta con este correo electronico o con esta contraseña no existe</li>';
                        break;

                    }
                }
            }   
        }
    }

    require('views/elimina.view.php');
?>