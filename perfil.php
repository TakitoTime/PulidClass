<?php session_start();
    require('conexion.php');

    if(!isset($_SESSION['cliente'])){
        header("Location:index.php");
        die();
    }else{
        
        $correo=$_SESSION['cliente'];
        $contra=$_SESSION['contra'];
    
        $statement = $conexion->prepare('SELECT * FROM Usuario_Info WHERE usuario_correo = :correo LIMIT 1');
        $statement->execute(array(':correo' => $correo));
    
        $info_personal=$statement->fetch();
    
        $statement = $conexion->prepare('SELECT N_De_Usuario FROM Usuario_Info WHERE usuario_correo = :correo LIMIT 1');
        $statement->execute(array(':correo' => $correo));
    
        $sql=$statement->fetch();
        $n_de_usuario=$sql['N_De_Usuario'];
        
        $_SESSION['n_de_usuario']=$n_de_usuario;
    
        $statement = $conexion->prepare('SELECT * FROM Direccion WHERE usuario_info_N_De_Usuario = :n_de_usuario LIMIT 3');
        $statement->execute(array(':n_de_usuario' => $n_de_usuario));
        
        $direcciones=$statement->fetchAll();
        
        $statement = $conexion->prepare('SELECT * FROM Cita WHERE N_De_Usuario = :n_de_usuario');
        $statement->execute(array(':n_de_usuario' => $n_de_usuario));

        $citas=$statement->fetchAll();

        $statement = $conexion->prepare('SELECT * FROM Tarjeta WHERE N_De_Usuario = :n_de_usuario LIMIT 2');
        $statement->execute(array(':n_de_usuario' => $n_de_usuario));
        
        $tarjetas=$statement->fetchAll();

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

            $correo = $_SESSION['cliente'];

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
            header('Location: ./perfil.php');
        }

        if(isset($_POST['guardar_d'])){
            $pais = trim($_POST["pais"]);
            $pais = filter_var($pais, FILTER_SANITIZE_STRING);

            $estado = trim($_POST["estado"]);
            $estado = filter_var($estado, FILTER_SANITIZE_STRING);
            
            $ciudad = trim($_POST["ciudad"]);
            $ciudad = filter_var($ciudad, FILTER_SANITIZE_STRING);

            $colonia = trim($_POST["colonia"]);
            $colonia = filter_var($colonia, FILTER_SANITIZE_STRING);

            $calle = trim($_POST["calle"]);
            $calle = filter_var($calle, FILTER_SANITIZE_STRING);

            $numero = trim($_POST["numero"]);
            $numero = filter_var($numero, FILTER_SANITIZE_STRING);

            $codigo_postal = trim($_POST["codigo_postal"]);
            $codigo_postal = filter_var($codigo_postal, FILTER_SANITIZE_STRING);

            $descripcion = trim($_POST["descripcion"]);
            $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);

            $correo = $_SESSION['cliente'];

            $statement = $conexion->prepare('call pulidclass.spAltaDireccion(:correo,:pais,:estado,:ciudad,:colonia,:calle,:numero,:codigo_postal,:descripcion)');
            $statement->execute(array(
                    ':correo' => $correo,
                    ':pais' => $pais,
                    ':estado' => $estado,
                    ':ciudad' => $ciudad,
                    ':colonia' => $colonia,
                    ':calle' => $calle,
                    ':numero' => $numero,
                    ':codigo_postal' => $codigo_postal,
                    ':descripcion' => $descripcion,
                ));

            $resultado = $statement->fetchColumn();

            echo "<div class='alert alert-danger mt-4' role='alert'>La cuenta No Existe En La Base De Datos</div>";
            header('Location: ./perfil.php');
        }

        if(isset($_POST["guardar"])){

            $id_direccion = trim($_POST["id_direccion"]);
            $id_direccion = filter_var($id_direccion, FILTER_SANITIZE_STRING);
    
            $pais = trim($_POST["pais"]);
            $pais = filter_var($pais, FILTER_SANITIZE_STRING);
        
            $estado = trim($_POST["estado"]);
            $estado = filter_var($estado, FILTER_SANITIZE_STRING);
            
            $ciudad = trim($_POST["ciudad"]);
            $ciudad = filter_var($ciudad, FILTER_SANITIZE_STRING);
        
            $colonia = trim($_POST["colonia"]);
            $colonia = filter_var($colonia, FILTER_SANITIZE_STRING);
        
            $calle = trim($_POST["calle"]);
            $calle = filter_var($calle, FILTER_SANITIZE_STRING);
        
            $numero = trim($_POST["numero"]);
            $numero = filter_var($numero, FILTER_SANITIZE_STRING);
        
            $codigo_postal = trim($_POST["codigo_postal"]);
            $codigo_postal = filter_var($codigo_postal, FILTER_SANITIZE_STRING);
        
            $descripcion = trim($_POST["descripcion"]);
            $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);
        
    
            $statement = $conexion->prepare('call pulidclass.spModificarDireccion(:id_direccion,:pais,:estado,:ciudad,:colonia,:calle,:numero,:codigo_postal,:descripcion)');
            $statement->execute(array(
                    ':id_direccion' => $id_direccion,
                    ':pais' => $pais,
                    ':estado' => $estado,
                    ':ciudad' => $ciudad,
                    ':colonia' => $colonia,
                    ':calle' => $calle,
                    ':numero' => $numero,
                    ':codigo_postal' => $codigo_postal,
                    ':descripcion' => $descripcion,
                ));
    
                $resultado = $statement->fetchColumn();

                echo "<div class='alert alert-danger mt-4' role='alert'>La cuenta No Existe En La Base De Datos</div>";
                header('Location: ./perfil.php');


        }
    
        if(isset($_POST["eliminar"])){
    
            $id_direccion = trim($_POST["id_direccion"]);
            $id_direccion = filter_var($id_direccion, FILTER_SANITIZE_STRING);
    
                $statement = $conexion->prepare('call pulidclass.spBajaDireccion(:id_direccion)');
                $statement->execute(array(
                        ':id_direccion' => $id_direccion,
                    ));
    
                $resultado = $statement->fetchColumn();
            
                echo "<div class='alert alert-danger mt-4' role='alert'>La cuenta No Existe En La Base De Datos</div>";
                header('Location: ./perfil.php');
        }
    
        if(isset($_POST['guardar_t'])){
            $titular = trim($_POST["titular"]);
            $titular = filter_var($titular, FILTER_SANITIZE_STRING);

            $expiracion_mes = trim($_POST["expiracion_mes"]);
            $expiracion_mes = filter_var($expiracion_mes, FILTER_SANITIZE_STRING);
            
            $expiracion_year = trim($_POST["expiracion_year"]);
            $expiracion_year = filter_var($expiracion_year, FILTER_SANITIZE_STRING);

            $tarjeta = trim($_POST["tarjeta"]);
            $tarjeta = filter_var($tarjeta, FILTER_SANITIZE_STRING);

            $codigo = trim($_POST["codigo"]);
            $codigo = filter_var($codigo, FILTER_SANITIZE_STRING);

            $n_de_usuario = $_SESSION['n_de_usuario'];

            $statement = $conexion->prepare('INSERT INTO Tarjeta values(NULL,:n_de_usuario,:titular,:tarjeta,:mes,:year,:codigo)');
            $statement->execute(array(
                    ':n_de_usuario' => $n_de_usuario,
                    ':titular' => $titular,
                    ':tarjeta' => $tarjeta,
                    ':mes' => $expiracion_mes,
                    ':year' => $expiracion_year,
                    ':codigo' => $codigo,
                ));

            echo "<div class='alert alert-danger mt-4' role='alert'>La cuenta No Existe En La Base De Datos</div>";
            header('Location: ./perfil.php');
        }

        if(isset($_POST["eliminar_t"])){
    
            $id_tarjeta = $_POST["id_tarjeta"];
    
                $statement = $conexion->prepare('DELETE from Tarjeta where Id_Tarjeta=:id_tarjeta');
                $statement->execute(array(
                        ':id_tarjeta' => $id_tarjeta,
                    ));
            
                echo "<div class='alert alert-danger mt-4' role='alert'>La cuenta No Existe En La Base De Datos</div>";
                header('Location: ./perfil.php');
        }
        

    require('views/perfil.view.php');
        
    }
    
?>
   