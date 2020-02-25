<?php session_start();

require('conexion.php');

if(!isset($_SESSION['usuario'])){
    header("Location:index.html");
    die();
}

$correo=$_SESSION['usuario'];
$contra=$_SESSION['contra'];

$statement = $conexion->prepare('SELECT * FROM Usuario WHERE correo = :correo LIMIT 1');
        $statement->execute(array(':correo' => $correo));
    
        $info_personal=$statement->fetch();
    
        $statement = $conexion->prepare('SELECT N_De_Usuario FROM Usuario WHERE correo = :correo LIMIT 1');
        $statement->execute(array(':correo' => $correo));
    
        $sql=$statement->fetch();
        $n_de_usuario=$sql['N_De_Usuario'];
        
        $_SESSION['n_de_usuario']=$n_de_usuario;
    
        $statement = $conexion->prepare('SELECT Id_Direccion FROM habita WHERE N_De_Usuario = :n_de_usuario LIMIT 3');
        $statement->execute(array(':n_de_usuario' => $n_de_usuario));
        
        $direcciones=$statement->fetchAll();
    
    
        $statement = $conexion->prepare('SELECT * FROM Cita WHERE N_De_Usuario = :n_de_usuario');
        $statement->execute(array(':n_de_usuario' => $n_de_usuario));
        
        $citas=$statement->fetchAll();

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

            $correo = $_SESSION['usuario'];

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

require 'views/admin.view.php';
?>