<?php session_start();

require('conexion.php');

if(!isset($_SESSION['asesor'])){
    header("Location:index.php");
    die();
}else{
    $correo=$_SESSION['asesor'];
    $contra=$_SESSION['contra'];

    $abrir_modal_noticia="false";
    $abrir_modal_material="false";

    $statement = $conexion->prepare('SELECT * FROM usuario_info WHERE usuario_Correo = :correo LIMIT 1');
            $statement->execute(array(':correo' => $correo));

            $info_personal=$statement->fetch();
            
            $statement = $conexion->prepare('SELECT N_De_Usuario FROM Usuario WHERE correo = :correo LIMIT 1');
            $statement->execute(array(':correo' => $correo));

            $sql=$statement->fetch();
            $n_de_usuario=$sql['N_De_Usuario'];

            $statement = $conexion->prepare('SELECT Id_Asesor FROM Asesor WHERE Correo = :correo');
            $statement->execute(array(':correo' => $correo));

            $id_asesor=$statement->fetch();
            $id_asesor=$id_asesor['Id_Asesor'];

            $statement = $conexion->prepare('SELECT * FROM Cita WHERE Id_Asesor = :id_asesor');
            $statement->execute(array(':id_asesor' => $id_asesor));

            $citas=$statement->fetchAll();

            $statement = $conexion->prepare('SELECT * FROM Asesor WHERE Id_Asesor = :id_asesor');
            $statement->execute(array(':id_asesor' => $id_asesor));

            $statement = $conexion->prepare('SELECT Nombre FROM materia INNER JOIN materiacategoria ON materiacategoria.id_materia = materia.Id_materia WHERE materiacategoria.id_asesor = :id_asesor');
            $statement->execute(array(':id_asesor'=> $id_asesor));
            $materias=$statement->fetchAll();

            $ficha_tecnica=$statement->fetch();

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

                $statement = $conexion->prepare('UPDATE asesor set Nombres=:nombre, A_Paterno=:paterno, A_Materno=:materno, Edad=:edad, Telefono=:telefono, Foto=:foto Where Correo=:correo');
                $statement->execute(array(
                        ':nombre' => $nombre,
                        ':paterno' => $paterno,
                        ':materno' => $materno,
                        ':edad' => $edad,
                        ':telefono' => $telefono,
                        ':foto' => $foto,
                        ':correo' => $correo
                    ));

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

                echo "<div class='alert alert-danger mt-4' role='alert'>Datos Guardados Correctamente</div>";
                header("Refresh:5; url=perfil_asesor.php");
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
                    header("Refresh:5; url=perfil_asesor.php");

            }

            if(isset($_POST['baja_noticia'])){
    
                $id_bajanoticia=$_POST['baja_noticia'];

                $statement = $conexion->prepare('DELETE FROM noticia WHERE Id_Noticia=:id_noticia');
                $statement->execute(array(':id_noticia' => $id_bajanoticia));

                 echo "<div class='alert alert-danger mt-4' role='alert'>El registro se borro correctamente</div>";
                 header("Refresh:5; url=perfil_asesor.php");

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
                    header("Refresh:5; url=perfil_asesor.php");

            }

            if(isset($_POST['baja_material'])){
    
                $id_bajamaterial=$_POST['baja_material'];

                $statement = $conexion->prepare('DELETE FROM material WHERE Id_Material=:id_material');
                $statement->execute(array(':id_material' => $id_bajamaterial));

                 echo "<div class='alert alert-danger mt-4' role='alert'>El registro se borro correctamente</div>";
                 header("Refresh:5; url=perfil_asesor.php");

            }

    require 'views/modal_altanoticia.view.php'; 
    require 'views/modal_altamaterial.view.php'; 
    require 'views/perfil_asesor.view.php';   
}
?>