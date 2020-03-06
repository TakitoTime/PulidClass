<?php session_start();

    if (isset($_SESSION['cliente']) || isset($_SESSION['asesor']) || isset($_SESSION['admin'])) {
        header('Location: index.html');
        die();
    }

    $codigo_activacion = rand(1000, 9999);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
        $contra = $_POST['contra'];
        $contra2 = $_POST['contra2'];
 
    
        $errores = '';

        if (empty($correo) or empty($contra) or empty($contra2)) {
            $errores = '<li>Por favor rellena todos los datos correctamente</li>';
        } else {
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $errores.= "<li>Por favor ingresa un correo valido</li>";
            }else{
                try {
                    $conexion = new PDO('mysql:host=localhost;dbname=pulidclass', 'root', '');
                } catch (PDOException $e) {
                    echo "Error:" . $e->getMessage();
                }
        
                $statement = $conexion->prepare('SELECT * FROM cuenta WHERE correo = :correo LIMIT 1');
                $statement->execute(array(':correo' => $correo));
        
                $resultado = $statement->fetch();
        
                if ($resultado != false) {
                    $errores .= '<li>La cuenta con este correo electronico ya existe</li>';
                }
        
                $contra = hash('sha512', $contra);
                $contra2 = hash('sha512', $contra2);
        
                if ($contra != $contra2) {
                    $errores.= '<li>Las contraseñas no son iguales</li>';
                }
            }
        }
    
        if ($errores == '') {
            $statement = $conexion->prepare('call pulidclass.spAltaCuenta(:correo,:contra,:tipo,:activacion,:codigo_activacion)');
            $statement->execute(array(
                    ':correo' => $correo,
                    ':contra' => $contra,
                    ':tipo' => 2,
                    ':activacion' => $_POST['activacion'],
                    ':codigo_activacion' => $_POST['codigo_activacion']
                ));
                
            $codigo_activacion=$_POST['codigo_activacion'];

            include("sendemail.php");//Mando a llamar la funcion que se encarga de enviar el correo electronico
				
				/*Configuracion de variables para enviar el correo*/
				$mail_username="pulidclass@gmail.com";//Correo electronico saliente ejemplo: tucorreo@gmail.com
				$mail_userpassword="cityofevil";//Tu contraseña de gmail
				$mail_addAddress=$correo;//correo electronico que recibira el mensaje
				$template="email_template.html";//Ruta de la plantilla HTML para enviar nuestro mensaje
				
				/*Inicio captura de datos enviados por $_POST para enviar el correo */
				$mail_setFromEmail=$correo;
				$txt_message='Hola '."\r\n"." Sigue este vinculo para activar tu cuenta"."\r\n\r\n"." http://localhost/xampp/pulidclass%203.0.1/confirm.php?correo=".$correo."&codigo_activacion=".$codigo_activacion."\r\n";;
				$mail_subject="Correo De Validacion PulidClass";
				
				sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_addAddress,$txt_message,$mail_subject,$template);//Enviar el mensaje
            
            echo "<div class='alert alert-danger mt-4' role='alert'>Se mando un correo de confirmacion al correo:".$correo."</div>";
            header("Refresh:20; url=index.php");
        }
    
    
    }
    
    require 'views/register.view.php';
    ?>