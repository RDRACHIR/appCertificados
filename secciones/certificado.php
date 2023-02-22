<?php 
require('../librerias/fpdf/fpdf.php');
include_once("../config/db.php");
$conexionDB = DB::crearInstancia();

function agregarTexto($pdf, $texto, $x, $y, $align='L', $fuente, $size=50){
  $pdf->SetFont($fuente,"", $size);
  $pdf->SetXY($x, $y);
  $pdf->SetTextColor(200,200,200);
  $pdf->Cell(0, 10, $texto, 0, 0, $align);
}

function agregarImagen($pdf, $imagen, $x, $y){
  $pdf->Image($imagen, $x, $y, 0);
}

$idcurso = isset($_GET['idcurso'])? $_GET['idcurso'] : '';
$idalumno = isset($_GET['idalumno'])? $_GET['idalumno'] : '';

$consulta = $conexionDB->prepare("SELECT alumnos.nombre, alumnos.apellidos, cursos.nombre as nombre_curso
FROM alumnos, cursos WHERE alumnos.id = :idalumno AND cursos.id = :idcurso");
$consulta->bindParam(':idalumno', $idalumno);
$consulta->bindParam(':idcurso', $idcurso);
$consulta->execute();
$alumno = $consulta->fetch(PDO::FETCH_ASSOC);




$pdf = new FPDF("L", "mm", array(254, 194));
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
agregarImagen($pdf, "../src/certificado_.jpg",0,0);
agregarTexto($pdf, ucwords(utf8_decode($alumno['nombre']." ".$alumno['apellidos'])), 60, 80, 'C', "Helvetica");
agregarTexto($pdf, $alumno['nombre_curso'], -210, 135, 'C', "Helvetica");
agregarTexto($pdf, date('d/m/y'), -428, 163.9, 'C', "Helvetica", 15);
$pdf->Output();


?>