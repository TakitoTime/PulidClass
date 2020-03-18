<?php session_start();

require('conexion.php');

if(!isset($_SESSION['admin'])){
    header("Location:index.php");
    die();
}else{
    $correo=$_SESSION['admin'];
    $contra=$_SESSION['contra'];

    $abrir_modal="false";

    $statement = $conexion->prepare('SELECT * FROM Usuario WHERE correo = :correo LIMIT 1');
            $statement->execute(array(':correo' => $correo));

            $info_personal=$statement->fetch();

            $statement = $conexion->prepare('SELECT N_De_Usuario FROM Usuario WHERE correo = :correo LIMIT 1');
            $statement->execute(array(':correo' => $correo));

            $sql=$statement->fetch();
            $n_de_usuario=$sql['N_De_Usuario'];

            $_SESSION['n_de_usuario']=$n_de_usuario;

            if(isset($_POST['guardar_usuario'])){

                $nombre =trim($_POST["nombre"]);
                $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);

                $edad =trim($_POST["edad"]);
                $edad = filter_var($edad, FILTER_SANITIZE_STRING);

                $paterno =trim($_POST["paterno"]);
                $paterno = filter_var($paterno, FILTER_SANITIZE_STRING);

                $materno =trim($_POST["materno"]);
                $materno = filter_var($materno, FILTER_SANITIZE_STRING);

                $telefono =trim($_POST["telefono"]);
                $telefono = filter_var($telefono, FILTER_SANITIZE_STRING);

                $target_path="fotosusuarios/";
                $target_path=$target_path . basename( $_FILES['foto']['name']);
                if(move_uploaded_file($_FILES['foto']['tmp_name'],$target_path)){
                    echo "el archivo". basename($_FILES['foto']['name'])."ha sido subido";
                }
                else{
                    echo"Ha ocurrido un error, trate de nuevo!";
                }
                $foto=$target_path;

                $statement = $conexion->prepare('call pulidclass.spModificarUsuario(:correo,:nombre,:paterno,:materno,:edad,:telefono,:foto)');
                $statement->execute(array(
                        ':correo' => $correo,
                        ':nombre' => $nombre,
                        ':paterno' => $paterno,
                        ':materno' => $materno,
                        ':edad' => $edad,
                        ':telefono' => $telefono,
                        ':foto' => $foto
                    ));

                $resultado = $statement->fetchColumn();

                echo "<div class='alert alert-danger mt-4' role='alert'>La cuenta No Existe En La Base De Datos</div>";
                header('Location: /admin.php');
            }
            
            if(isset($_POST['alta_asesor'])){

                $abrir_modal="true";

                if(empty($_POST['correo_asesor']) || empty($_POST['usuario'])){
                    $errores='<li>Por Favor Proporcione Los Datos Correctamente</li>';
                }else{

                    $abrir_modal="true";

                    $correo_asesor =trim($_POST["correo_asesor"]);
                    $correo_asesor = filter_var($_POST['correo_asesor'], FILTER_SANITIZE_EMAIL);
    
                    $username =trim($_POST["usuario"]);
                    $username = filter_var($username, FILTER_SANITIZE_STRING);
    
                    $nombre_asesor =trim($_POST["nombre_asesor"]);
                    $nombre_asesor = filter_var($nombre_asesor, FILTER_SANITIZE_STRING);
    
                    $paterno_asesor =trim($_POST["paterno_asesor"]);
                    $paterno_asesor = filter_var($paterno_asesor, FILTER_SANITIZE_STRING);
    
                    $materno_asesor =trim($_POST["materno_asesor"]);
                    $materno_asesor = filter_var($materno_asesor, FILTER_SANITIZE_STRING);
    
                    $target_path="fotoasesores/";
                    $target_path=$target_path . basename( $_FILES['fotoasesor']['name']);
                    if(move_uploaded_file($_FILES['fotoasesor']['tmp_name'],$target_path)){
                        echo "el archivo". basename($_FILES['fotoasesor']['name'])."ha sido subido";
                    }
                    else{
                        echo"Ha ocurrido un error, trate de nuevo!";
                    }
                    $foto_asesor=$target_path;
    
                    $telefono_asesor =trim($_POST["telefono_asesor"]);
                    $telefono_asesor = filter_var($telefono_asesor, FILTER_SANITIZE_STRING);
    
                    $edad_asesor =trim($_POST["edad_asesor"]);
                    $edad_asesor = filter_var($edad_asesor, FILTER_SANITIZE_STRING);
    
                    $grado =trim($_POST["grado"]);
                    $grado = filter_var($grado, FILTER_SANITIZE_STRING);
    
                    $ocupacion =trim($_POST["ocupacion"]);
                    $ocupacion = filter_var($ocupacion, FILTER_SANITIZE_STRING);
    
                    $materia1 =trim($_POST["materia1"]);
                    $materia1 = filter_var($materia1, FILTER_SANITIZE_STRING);
    
                    $materia2 =trim($_POST["materia2"]);
                    $materia2 = filter_var($materia2, FILTER_SANITIZE_STRING);
    
                    $materia3 =trim($_POST["materia3"]);
                    $materia3 = filter_var($materia3, FILTER_SANITIZE_STRING);
    
                    $descripcion =trim($_POST["descripcion"]);
                    $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);
    
                    $statement = $conexion->prepare('call pulidclass.spAltaAsesor(:correo_admin,:correo_asesor,:username,:edad,:grado,:nombre,:paterno,:materno,:ocupacion,:materia1,:materia2,:materia3,:descripcion,:telefono,:foto)');
                    $statement->execute(array(
                            ':correo_admin' => $correo,
                            ':correo_asesor' => $correo_asesor,
                            ':username' => $username,
                            ':edad' => $edad_asesor,
                            ':grado' => $grado,
                            ':nombre' => $nombre_asesor,
                            ':paterno' => $paterno_asesor,
                            ':materno' => $materno_asesor,
                            ':ocupacion' => $ocupacion,
                            ':materia1' => $materia1,
                            ':materia2' => $materia2,
                            ':materia3' => $materia3,
                            ':descripcion' => $descripcion,
                            ':telefono' => $telefono_asesor,
                            ':foto' => $foto_asesor,
                        ));
    
                    $resultado = $statement->fetchColumn();
    
                    switch($resultado){
                        case 0: 
                            $errores='<li>La cuenta con este correo electronico o nombre de usuario ya existe, por favor proporcione otro</li>';
                        break;
    
                        case 1: 
                            $errores='<li>Datos Guardados Correctamente</li>';
                        break;
    
                    }
                }

            }

    require 'views/modal_altasesor.view.php'; 
    require 'views/admin.view.php';   
}
?>