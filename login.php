<?php session_start();

require('conexion.php');

if (isset($_SESSION['usuario'])) {
	header('Location: index.html');
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

        $statement = $conexion->prepare('SELECT * FROM cuenta WHERE Correo = :correo AND Contrasena = :contra LIMIT 1');
        $statement->execute(array(
                ':correo' => $correo,
                ':contra' => $contra
            ));

        $resultado = $statement->fetch();  

        if($resultado['Activacion']==0 && $resultado['Tipo']==2){
            $errores = '<li>Su correo no ah sido activado, por favor ingrese a su correo electronico para validar su registro.</li>';
        }else{

            if ($resultado != false) {
                $_SESSION['usuario'] = $correo;
                $_SESSION['contra'] = $contra;
                
                if($resultado['Tipo']==1){
                    header('Location: admin.php');
                }else{
                    header('Location: perfil.php');
                }
    
            } else {
                $errores = '<li>Datos incorrectos</li>';
            }

        }
    }
}

require 'views/login.view.php';
?>