<?php session_start();
    require('conexion.php');

    if(isset($_GET['id_asesor'])){

        $abrir_modal="false";

        $id_asesor = $_GET['id_asesor'];

        $statement = $conexion->prepare('SELECT * FROM Asesor where Id_Asesor=:id_asesor');
        $statement->execute(array(':id_asesor'=> $id_asesor));

        $asesor=$statement->fetch();
        $nombre_asesor=$asesor['Nombres']." ".$asesor['A_Paterno']." ".$asesor['A_Materno'];

        if(isset($_SESSION['cliente'])){

            $n_de_usuario=$_SESSION['n_de_usuario'];

                $statement = $conexion->prepare('SELECT * FROM usuario WHERE N_De_Usuario = :n_de_usuario LIMIT 1');
                $statement->execute(array(
                        ':n_de_usuario' => $n_de_usuario
                    ));
                
                $usuario=$statement->fetch(); 
                $nombre_usuario=$usuario['Nombres']." ".$usuario['A_Paterno']." ".$usuario['A_Materno'];
                
                $statement=$conexion->prepare('SELECT * FROM precio');
                $statement->execute();

                $precios=$statement->fetchAll();

                $statement=$conexion->prepare('SELECT Id_direccion from habita where N_De_Usuario=:n_de_usuario LIMIT 3');
                $statement->execute(array(
                    'n_de_usuario'=>$n_de_usuario
                ));

                $direcciones=$statement->fetchAll();

                $statement=$conexion->prepare('SELECT Id_Tarjeta from Tarjeta where N_De_Usuario=:n_de_usuario LIMIT 2');
                $statement->execute(array(
                    'n_de_usuario'=>$n_de_usuario
                ));

                $tarjetas=$statement->fetchAll();

            $cita_confirmada="confirmar_cita";
            $confirmar="Confirmar";

            if(isset($_POST['confirmar_cita'])){

                $abrir_modal="true";
                
                $fecha=$_POST['fecha'];
                //$fecha=date("Y-m-d");
        
                $hora_inicial=$_POST['hora_inicial'];
                //$hora_inicial=substr($hora_inicial,0,-7);
        
                $hora_final=$_POST['hora_final'];
                //$hora_final=substr($hora_final,0,-7);

                
        
                $errores="";
        
                $statement=$conexion->prepare('SELECT Fecha, Hora_Inicial, Hora_Final FROM cita where Fecha=:fecha and Id_Asesor=:id_asesor');
                $statement->execute(array(
                    ':fecha'=> $fecha,
                    ':id_asesor' => $id_asesor
                ));
                
                $citas_existentes=$statement->fetchAll();

                    if($hora_inicial==$hora_final){
            
                        $errores="<li>Las horas no pueden ser iguales, por favor indique otra fecha.</li>";
                        $cita_confirmada="confirmar_cita";
                        $confirmar="Confirmar";
        
                    }else{

                        $incial=substr($hora_inicial,0,-3);
                        $final=substr($hora_final,0,-3);

                        

                        if($incial>$final){

                            $errores="<li>Las horas inicial no puede ser mayor que la final, por favor modifique dichos campos.</li>";
                            $cita_confirmada="confirmar_cita";
                            $confirmar="Confirmar";

                        }else{

                            if($final-$incial>4){

                                $errores="<li>No puede generar una cita mayor a 4 horas continuas, por favor modifique dichos campos.</li>";
                                $cita_confirmada="confirmar_cita";
                                $confirmar="Confirmar";
                            }else{

                                if($citas_existentes==null){

                                    $errores="<li>Por favor, confirme los datos para continuar.</li>";
                                    $cita_confirmada="generar_cita";
                                    $confirmar="Confirmar Cita";
                
                                }else{
    
                                    $flag=false;

                                    foreach($citas_existentes as $cita_existente){
                                        

                                        if($hora_inicial==$cita_existente['Hora_Inicial']){
                    
                                            $flag=true;
                                            
                                        }else{
                                            
                                            $cita_existenteInicial=substr($cita_existente['Hora_Inicial'],0,-3);
                                            $cita_existenteFinal=substr($cita_existente['Hora_Final'],0,-3);

                                            if(($incial>=$cita_existenteInicial && $incial<$cita_existenteFinal) || ($final>$cita_existenteInicial && $final<=$cita_existenteFinal) ){

                                                $flag=true;                                               

                                            }else{

                                                $errores="<li>Por favor, confirme los datos para continuar.</li>";
                                                $cita_confirmada="generar_cita";
                                                $confirmar="Confirmar Cita";

                                            }
                                            
                                        }
        
                                    }

                                    if($flag==true){

                                        $errores="<li>El asesor no esta disponible en dicha hora, por favor proporcione otro dia u hora.</li>";
                                        $cita_confirmada="confirmar_cita";
                                        $confirmar="Confirmar";

                                    }

                                }

                            }

                        }
            
                    }
    
                $nhoras=substr($hora_final,0,-3)-substr($hora_inicial,0,-3);

                $statement=$conexion->prepare('SELECT * FROM precio WHERE Id_Precio=:nhoras');
                $statement->execute(array(
                    ':nhoras'=>$nhoras
                ));

                $costo=$statement->fetch();
                $costo=$costo['Costo'];
                
            }
        
            if(isset($_POST['generar_cita'])){

                $abrir_modal="true";
                
                $fecha=$_POST['fecha'];
        
                $hora_inicial=$_POST['hora_inicial'];
                $inicial=substr($hora_inicial,0,-3);
        
                $hora_final=$_POST['hora_final'];
                $final=substr($hora_final,0,-3);

                $tarjeta=$_POST['tarjeta'];

                $dir=$_POST['direccion'];

                $statement=$conexion->prepare('SELECT * FROM Direccion where Id_Direccion=:id_direccion');
                $statement->execute(array('id_direccion'=> $dir));

                $dir=$statement->fetch();
                $direccion1=$dir['Calle']." #".$dir['Numero'].", Col.".$dir['Colonia'].". ".$dir['Codigo_Postal'];
                $direccion2=" ".$dir['Ciudad']." ".$dir['Estado'].", ".$dir['Pais'].".";

                $descripcion=$dir['Descripcion'];

                $nhoras=$final-$inicial;

                $statement=$conexion->prepare('SELECT * FROM precio WHERE Id_Precio=:nhoras');
                $statement->execute(array(
                    ':nhoras'=>$nhoras
                ));

                $costo=$statement->fetch();
                $costo=$costo['Costo'];
                
                $statement=$conexion->prepare('call pulidclass.spAltaCita(:n_de_usuario, :id_asesor,:id_tarjeta, :direccionp1,:direccionp2, :descripcion, :fecha, :hora_inicial, :hora_final, :n_horas, :costo)');
                $statement->execute(array(
                    ':n_de_usuario'=> $n_de_usuario,
                    ':id_asesor'=> $id_asesor,
                    ':id_tarjeta'=> $tarjeta,
                    ':direccionp1'=> $direccion1,
                    ':direccionp2'=> $direccion2,
                    ':descripcion' => $descripcion,
                    ':fecha'=> $fecha,
                    ':hora_inicial'=> $hora_inicial,
                    ':hora_final'=> $hora_final,
                    ':n_horas'=> $nhoras,
                    ':costo'=> $costo,
                ));

                $statement=$conexion->prepare('SELECT * FROM usuario WHERE N_De_Usuario=:n_de_usuario');
                $statement->execute(array(
                    ':n_de_usuario'=> $n_de_usuario,
                ));

                $usuario=$statement->fetch();

                $nombre_usuario=$usuario['Nombres']." ".$usuario['A_Paterno']." ".$usuario['A_Materno'];

                $statement = $conexion->prepare('SELECT * FROM Asesor WHERE Id_Asesor = :id_asesor');
                $statement->execute(array(':id_asesor' => $id_asesor));

                $asesor=$statement->fetch();
                            
                $nombre_asesor=$asesor['Nombres']." ".$asesor['A_Paterno']." ".$asesor['A_Materno'];

                $errores="<li>La cita a sido creada correctamente.</li>";
                $cita_confirmada="ticket";
                

                $statement=$conexion->prepare('SELECT * FROM Cita WHERE N_De_Usuario = :n_de_usuario order by Folio desc LIMIT 1');
                $statement->execute(array(
                    ':n_de_usuario'=> $n_de_usuario,
                ));

                $cita=$statement->fetch();
                $folio=$cita['Folio'];
            }
        }

        require('views/modal_cita.view.php');
        require('views/asesor.view.php');
        

    }else{
        header('Location:index.php');
    }
?>