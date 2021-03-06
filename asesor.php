<?php session_start();
    require('conexion.php');

    if(isset($_GET['id_asesor'])){

        $abrir_modal="false";

        $id_asesor = $_GET['id_asesor'];

        $statement = $conexion->prepare('SELECT * FROM Asesor where Id_Asesor=:id_asesor');
        $statement->execute(array(':id_asesor'=> $id_asesor));

        $asesor=$statement->fetch();

        $nombre_asesor=$asesor['Nombres']." ".$asesor['A_Paterno']." ".$asesor['A_Materno'];

        $statement = $conexion->prepare('SELECT Nombre FROM materia INNER JOIN materiacategoria ON materiacategoria.id_materia = materia.Id_materia WHERE materiacategoria.id_asesor = :id_asesor');
        $statement->execute(array(':id_asesor'=> $id_asesor));
        $materias=$statement->fetchAll();

        if($asesor['Id_Asesor']==NULL){
            header('Location:asesores.php');
        }

        if(isset($_SESSION['cliente'])){

            $n_de_usuario=$_SESSION['n_de_usuario'];

                $statement = $conexion->prepare('SELECT * FROM usuario_info WHERE N_De_Usuario = :n_de_usuario LIMIT 1');
                $statement->execute(array(
                        ':n_de_usuario' => $n_de_usuario
                    ));
                
                $usuario=$statement->fetch(); 
                $nombre_usuario=$usuario['Nombres']." ".$usuario['A_Paterno']." ".$usuario['A_Materno'];
                
                $statement=$conexion->prepare('SELECT * FROM precio');
                $statement->execute();

                $precios=$statement->fetchAll();

                $statement=$conexion->prepare('SELECT * from direccion where usuario_info_N_De_Usuario=:n_de_usuario LIMIT 3');
                $statement->execute(array(
                    'n_de_usuario'=>$n_de_usuario
                ));

                $direcciones=$statement->fetchAll();

                $statement=$conexion->prepare('SELECT * from tarjeta where N_De_Usuario=:n_de_usuario LIMIT 2');
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

                if($fecha==NULL){

                    $errores="<li>Proporcione una fecha valida</li>";
                    $cita_confirmada="confirmar_cita";
                    $confirmar="Confirmar";

                }else{
                        if($hora_inicial==$hora_final){
            
                            $errores="<li>Las horas no pueden ser iguales, por favor indique otra hora.</li>";
                            $cita_confirmada="confirmar_cita";
                            $confirmar="Confirmar";
            
                        }else{
    
                            $inicial=substr($hora_inicial,0,-3);
                            $final=substr($hora_final,0,-3);
                            date_default_timezone_set('America/Mexico_City');
                            $hoy=date("H");

                            if($fecha==date("Y-m-d") && $inicial<=$hoy){
                                $errores="<li>La hora inicial ya no esta disponible, por favor ingrese una hora direfente.</li>";
                                $cita_confirmada="confirmar_cita";
                                $confirmar="Confirmar";
                            }else{
    
                                if($inicial>$final){
        
                                    $errores="<li>Las horas inicial no puede ser mayor que la final, por favor modifique dichos campos.</li>";
                                    $cita_confirmada="confirmar_cita";
                                    $confirmar="Confirmar";
        
                                }else{
        
                                    if($final-$inicial>4){
        
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
        
                                                    if(($inicial>=$cita_existenteInicial && $inicial<$cita_existenteFinal) || ($final>$cita_existenteInicial && $final<=$cita_existenteFinal) ){
        
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
                print_r($fecha);
        
                $hora_inicial=$_POST['hora_inicial'];
                $inicial=substr($hora_inicial,0,-3);
        
                $hora_final=$_POST['hora_final'];
                $final=substr($hora_final,0,-3);

                $tarjeta=$_POST['tarjeta'];

                $dir=$_POST['direccion'];

                $statement=$conexion->prepare('SELECT * FROM Direccion where Id_Direccion=:id_direccion');
                $statement->execute(array('id_direccion'=> $dir));

                $nhoras=$final-$inicial;

                $statement=$conexion->prepare('SELECT * FROM precio WHERE Id_Precio=:nhoras');
                $statement->execute(array(
                    ':nhoras'=>$nhoras
                ));

                $costo=$statement->fetch();
                $costo=$costo['Costo'];
                
                $statement=$conexion->prepare('call pulidclass.spAltaCita(:n_de_usuario, :id_asesor,:id_tarjeta, :id_direccion, :fecha, :hora_inicial, :hora_final, :n_horas, :costo)');
                $statement->execute(array(
                    ':n_de_usuario'=> $n_de_usuario,
                    ':id_asesor'=> $id_asesor,
                    ':id_tarjeta'=> $tarjeta,
                    ':id_direccion'=> $dir,
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