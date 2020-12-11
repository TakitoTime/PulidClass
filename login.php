<?php session_start();

require('conexion.php');

if (isset($_SESSION['cliente']) || isset($_SESSION['asesor']) || isset($_SESSION['admin'])) {
	header('Location: index.php');
	die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
	$contra= $_POST['contra'];
    $contra = hash('sha512', $contra);

    $errores='';
    
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores.= "<li>Por favor ingresa un correo valido</li>";

    }else{

        $statement = $conexion->prepare('select * from usuario inner join usuario_info on usuario.correo=usuario_info.usuario_correo where usuario.correo=:correo and contrasena=:contra');
        $statement->execute(array(
                ':correo' => $correo,
                ':contra' => $contra
            ));

        $resultado = $statement->fetch();  

        if($resultado['Activacion']==0 && $resultado['Tipo']==2){
            $errores = '<li>Su correo no ah sido activado, por favor ingrese a su correo electronico para validar su registro.</li>';
        }else{

            if ($resultado != false) {
                
                if($resultado['Tipo']==1){
                    
                    $_SESSION['admin'] = $correo;
                    $_SESSION['contra'] = $contra;
                    $_SESSION['id'] = $resultado['N_De_Usuario'];
                    header('Location: admin.php');
                    
                }else{
                    if($resultado['Tipo']==3){
                    
                        $_SESSION['asesor'] = $correo;
                        $_SESSION['contra'] = $contra;
                        $_SESSION['id'] = $resultado['N_De_Usuario'];
                        header('Location: perfil_asesor.php');
                        
                    }else{
                        $_SESSION['cliente'] = $correo;
                        $_SESSION['contra'] = $contra;
                        $_SESSION['id'] = $resultado['N_De_Usuario'];
                        header('Location: perfil.php');
                    }
                }
                
    
            } else {
                $errores = '<li>Datos incorrectos</li>';
            }

        }
    }
}

require 'views/login.view.php';
?>