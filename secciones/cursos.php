<?php 
error_reporting(E_ERROR | E_PARSE);
include("../config/db.php");
$conexionDB = DB::crearInstancia();


// Leer los datos de la DB
$consulta = $conexionDB->prepare("SELECT * FROM `cursos` ");
$consulta->execute();
$listaCursos=$consulta->fetchAll(); //Nos retorna todos los datos
// print_r($listaCursos);

// Insertar datos a la DB
if ($_POST) {
  $nombreCurso = (isset($_POST['nombrecurso']))? $_POST['nombrecurso'] : '';
  $accion = (isset($_POST['accion']))? $_POST['accion'] : '';
  $id = (isset($_POST['id']))? $_POST['id'] : '';


  switch ($accion) {
    case 'agregar':
      $consulta = $conexionDB->prepare("INSERT INTO cursos (id, nombre) VALUES (NULL, :nombrecurso);");
      $consulta->bindParam(":nombrecurso", $nombreCurso);
      $consulta->execute();
      header("Location: vista_cursos.php");
      break;
    case 'editar':
      $consulta = $conexionDB->prepare("UPDATE cursos SET nombre=:nombre WHERE id=:id;");
      $consulta->bindParam(':nombre', $nombreCurso);
      $consulta->bindParam(':id', $id);
      $consulta->execute();
      header("Location: vista_cursos.php");
      break;
    case 'seleccionar':
      $consulta = $conexionDB->prepare("SELECT * FROM cursos WHERE id=:id");
      $consulta->bindParam(':id', $id);
      $consulta->execute();
      $curso = $consulta->fetch(PDO::FETCH_LAZY);

      $nombreCurso =  $curso['nombre'];
      break;
    case 'borrar':
      $consulta = $conexionDB->prepare("DELETE FROM cursos WHERE id=:id;");
      $consulta->bindParam(':id', $id);
      $consulta->execute();
      header("Location: vista_cursos.php");
      break;
    case 'cancelar':
      header("Location: vista_cursos.php");
      break;
  }
  
}
?>