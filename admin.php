<?php session_start();

require('conexion.php');

if(!isset($_SESSION['admin'])){
    header("Location:index.php");
    die();
}else{
    $correo=$_SESSION['admin'];
    $contra=$_SESSION['contra'];

    $abrir_modal="false";
    $abrir_modal_noticia="false";
    $abrir_modal_material="false";

    $statement = $conexion->prepare('SELECT * FROM Usuario_info WHERE usuario_correo = :correo LIMIT 1');
            $statement->execute(array(':correo' => $correo));

            $info_personal=$statement->fetch();

            $statement = $conexion->prepare('SELECT N_De_Usuario FROM Usuario_info WHERE usuario_correo = :correo LIMIT 1');
            $statement->execute(array(':correo' => $correo));

            $sql=$statement->fetch();
            $n_de_usuario=$sql['N_De_Usuario'];

            $statement = $conexion->prepare('SELECT * FROM Materia');
            $statement->execute();

            $materias=$statement->fetchAll();

            $_SESSION['n_de_usuario']=$n_de_usuario;

            $fecha=date("Y-m-d");

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
                header('Location: admin.php');
            }

            if(isset($_POST['respaldar_db'])){
                $db_name = 'pulidclass';
                $db_user = 'backup';
                $fecha = date("Ymd-His");

                $salida_sql = $db_name.'_'.$fecha.'.sql';
                $dump = 'mysqldump -u '.$db_user.' '.$db_name.' > ./backups/'.$salida_sql.'';
                system($dump, $output);
            }
            
            if(isset($_POST['alta_asesor'])){

                $abrir_modal="true";

                if(empty($_POST['correo_asesor']) || empty($_POST['usuario']) || empty($_POST['password'])){
                    $errores='<li>Por Favor Proporcione Los Datos Correctamente</li>';
                }else{

                    $abrir_modal="true";

                    $correo_asesor =trim($_POST["correo_asesor"]);
                    $correo_asesor = filter_var($_POST['correo_asesor'], FILTER_SANITIZE_EMAIL);

                    $password =trim($_POST["password"]);
                    $password = filter_var($password, FILTER_SANITIZE_STRING);
    
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
                            $password = hash('sha512', $password);
            
                            $statement = $conexion->prepare('call pulidclass.spAltaUsuarioAsesor(:correo_admin,:correo_asesor,:password,:tipo,:nombre,:paterno,:materno,:edad,:telefono,:foto)');
                            $statement->execute(array(
                                    ':correo_admin' => $correo,
                                    ':correo_asesor' => $correo_asesor,
                                    ':password' => $password,
                                    ':tipo' => '3',
                                    ':nombre' => $nombre_asesor,
                                    ':paterno' => $paterno_asesor,
                                    ':materno' => $materno_asesor,
                                    ':edad' => $edad_asesor,
                                    ':telefono' => $telefono_asesor,
                                    ':foto' => $foto_asesor,
                                ));

                            $errores='<li>Datos Guardados Correctamente</li>';
                        break;

                    }
                }

            }

            if(isset($_POST['alta_noticia'])){

                $abrir_modal_noticia="true";
    
                    $titulo =trim($_POST["titulo"]);
                    $titulo = filter_var($titulo, FILTER_SANITIZE_STRING);
                    
                    $subtitulo =trim($_POST["subtitulo"]);
                    $subtitulo = filter_var($subtitulo, FILTER_SANITIZE_STRING);

                    $target_path="fotosnoticias/";
                    $target_path=$target_path . basename($_FILES['fotonoticia']['name']);
                    if(move_uploaded_file($_FILES['fotonoticia']['tmp_name'],$target_path)){
                        echo "el archivo". basename($_FILES['fotonoticia']['name'])."ha sido subido";
                    }
                    else{
                        echo"Ha ocurrido un error, trate de nuevo!";
                    }
                    $imagen_noticia=$target_path;
    
                    $informacion =trim($_POST["informacion"]);
                    $informacion = filter_var($informacion, FILTER_SANITIZE_STRING);
    
                    $referencias =trim($_POST["referencias"]);
                    $referencias = filter_var($referencias, FILTER_SANITIZE_STRING);

                    $statement = $conexion->prepare('INSERT INTO noticia values(NULL, :correo, :titulo, :subtitulo, :fecha, :fuentes, :informacion, :imagen)');
                    $statement->execute(array(
                            ':correo' => $correo,
                            ':titulo' => $titulo,
                            ':subtitulo' => $subtitulo,
                            ':fecha' => $fecha,
                            ':fuentes' => $referencias,
                            ':informacion' => $informacion,
                            ':imagen' => $imagen_noticia
                        ));
    
                    $resultado = $statement->fetchColumn();

                    echo "<div class='alert alert-danger mt-4' role='alert'>Datos Guardados Correctemente</div>";
                    header("Refresh:5; url=admin.php");

            }

            if(isset($_POST['baja_noticia'])){
    
                   $id_bajanoticia=$_POST['baja_noticia'];

                   $statement = $conexion->prepare('DELETE FROM noticia WHERE Id_Noticia=:id_noticia');
                   $statement->execute(array(':id_noticia' => $id_bajanoticia));

                    echo "<div class='alert alert-danger mt-4' role='alert'>El registro se borro correctamente</div>";
                    header("Refresh:5; url=admin.php");

            }

            if(isset($_POST['alta_material'])){

                $abrir_modal_material="true";
    
                    $titulo =trim($_POST["titulo"]);
                    $titulo = filter_var($titulo, FILTER_SANITIZE_STRING);
                    
                    $materia =trim($_POST["materia"]);
                    $materia = filter_var($materia, FILTER_SANITIZE_STRING);

                    $target_path="materialdidactico/";
                    $target_path=$target_path . basename($_FILES['archivo']['name']);
                    if(move_uploaded_file($_FILES['archivo']['tmp_name'],$target_path)){
                        echo "el archivo". basename($_FILES['archivo']['name'])."ha sido subido";
                    }
                    else{
                        echo"Ha ocurrido un error, trate de nuevo!";
                    }
                    $archivo=$target_path;

                    $statement = $conexion->prepare('INSERT INTO material values(NULL, :correo, :titulo, :fecha, :materia, :archivo)');
                    $statement->execute(array(
                            ':correo' => $correo,
                            ':titulo' => $titulo,
                            ':fecha' => $fecha,
                            ':materia' => $materia,
                            ':archivo' => $archivo
                        ));
    
                    $resultado = $statement->fetchColumn();

                    echo "<div class='alert alert-danger mt-4' role='alert'>Datos Guardados Correctemente</div>";
                    header("Refresh:5; url=admin.php");

            }

            if(isset($_POST['baja_material'])){
    
                $id_bajamaterial=$_POST['baja_material'];

                $statement = $conexion->prepare('DELETE FROM material WHERE Id_Material=:id_material');
                $statement->execute(array(':id_material' => $id_bajamaterial));

                 echo "<div class='alert alert-danger mt-4' role='alert'>El registro se borro correctamente</div>";
                 header("Refresh:5; url=admin.php");

            }

            if(isset($_POST['n-pass'])){
                $n_correo = $_POST['n-correo'];
                $n_pass = hash('sha512', $_POST['n-pass']);
                $n_statement = $conexion->prepare('UPDATE usuario SET Contrasena = :pass WHERE correo = :correo');
                $n_statement->execute(array(':correo'=>$n_correo, ':pass'=>$n_pass));
            }

            if(isset($_POST['m-correo'])){
                $m_correo = $_POST['m-correo'];
                $m_tipo = 2;
                $m_statement = $conexion->prepare('UPDATE usuario SET Tipo = :tipo WHERE correo = :correo');
                $m_statement->execute(array(':tipo'=>$m_tipo, ':correo'=>$m_correo));
            }

    require 'views/modal_altasesor.view.php'; 
    require 'views/modal_altanoticia.view.php'; 
    require 'views/modal_altamaterial.view.php'; 
    require 'views/admin.view.php';   
}
?>