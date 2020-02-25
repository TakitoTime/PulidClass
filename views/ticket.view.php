<?php
    include "pdf/fpdf/fpdf.php";
    
    $pdf = new FPDF($orientation='P',$unit='mm', array(45,150));
    $pdf->AddPage();

    $pdf->Image("img/logo.png",8,5,30, 10);

    $pdf->SetFont('Arial','B',8);    //Letra Arial, negrita (Bold), tam. 20
    $textypos = 5;
    $pdf->setY(17);
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,"PulidClass S.A. De C.V.");
    $pdf->SetFont('Arial','',5);    //Letra Arial, negrita (Bold), tam. 20
    $textypos+=10;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,'-------------------------------------------------------------------');
    $textypos+=5;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,"Cliente: $nombre_usuario");
    $textypos+=8;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,"Asesor: $nombre_asesor");
    $textypos+=5;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,'-------------------------------------------------------------------');
    $textypos+=5;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,"Direccion:");
    $textypos+=5;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,"$direccion");
    $textypos+=5;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,"$direccion");
    $textypos+=5;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,'-------------------------------------------------------------------');
    $textypos+=10;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,"Fecha: $fecha                                   Horas: $nhoras");
    $textypos+=10;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,"Hora: $hora_inicial-$hora_final");
    $textypos+=10;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,'-------------------------------------------------------------------');
    $pdf->SetFont('Arial','B',5);
    $textypos+=10;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,"                                                    Costo: $ $costo");
    $pdf->SetFont('Arial','',5);
    $textypos+=10;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,' Este ticket comprueba la realizacion de su cita.');
    $pdf->SetFont('Arial','B',5);
    $textypos+=8;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,'*******GRACIAS POR SU PREFERENCIA!*******');
    
    $pdf->output();
?>