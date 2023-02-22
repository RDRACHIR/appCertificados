<?php 
include("../config/db.php");
$conexionDB = DB::crearInstancia();

// Leer los datos de la base de datos
$consulta = $conexionDB->prepare("SELECT * FROM alumnos"); $consulta->execute();
$listaAlumnos = $consulta->fetchAll();

// Traer los datos de los cursos relacionados con los alumnos (tabla alumno_cursos)
  foreach ($listaAlumnos as $clave => $alumo) {
    $consulta = $conexionDB->prepare("SELECT * FROM cursos WHERE id IN (SELECT idcurso FROM alumnos_cursos WHERE idAlumno = :id_alumno)");

    $consulta->bindParam(':id_alumno', $alumo['id']);
    $consulta->execute();
    $cursosAlumno = $consulta->fetchAll();
    $listaAlumnos[$clave]['cursos'] = $cursosAlumno;
  }

  // Leer los datos de la tabla cursos
  $sql = $conexionDB->prepare("SELECT * FROM cursos"); 
  $sql->execute();
  $listaCursos = $sql->fetchAll();

$id = (isset($_POST['id']))? $_POST['id'] : '';
$nombre = (isset($_POST['nombre']))? $_POST['nombre'] : '';
$apellidos = (isset($_POST['apellidos']))? $_POST['apellidos'] : '';
$cursos = (isset($_POST['cursos']))? $_POST['cursos'] : '';
$accion = (isset($_POST['accion']))? $_POST['accion'] : '';


if ($_POST) {
  if($accion != ""){
    switch ($accion) {
      case 'agregar':
        $consulta = $conexionDB->prepare("INSERT INTO alumnos(id,nombre,apellidos) VALUES(NULL, :nombre, :apellidos)");
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':apellidos', $apellidos);
        $consulta->execute();

        // Recuperarcion el idalumno al insertarse
        $idAlumno = $conexionDB->lastInsertId(); 

        // Inserta los cursos en la DB
        foreach ($cursos as $curso) {
          $consulta = $conexionDB->prepare("INSERT INTO alumnos_cursos (id, idalumno, idcurso) VALUES(NULL, :idalumno, :idcurso)");
          $consulta->bindParam(':idalumno', $idAlumno);
          $consulta->bindParam(':idcurso', $curso);
          $consulta->execute();
        }
        header('Location: ./vista_alumno.php');
        break;
      case 'seleccionar':
        // Recuperando daros del alumno
        $consulta = $conexionDB->prepare("SELECT * FROM alumnos WHERE id = :id");
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $alumno = $consulta->fetch(PDO::FETCH_ASSOC);

        $nombre = $alumno['nombre'];
        $apellidos = $alumno['apellidos'];

        // Recuperracion de los cursos
        $sql = "SELECT cursos.id FROM alumnos_cursos
        INNER JOIN cursos ON cursos.id = alumnos_cursos.idcurso
        WHERE alumnos_cursos.idalumno = :idalumno";
        $consulta = $conexionDB->prepare($sql);
        $consulta->bindParam(':idalumno', $id);
        $consulta->execute();
        $cursosAlumno = $consulta->fetchAll(PDO::FETCH_ASSOC);

        // print_r($cursosAlumno);

        foreach ($cursosAlumno as $curso) {
          $arregloCursos[] = $curso['id'];
        }
        break;
      case 'editar':
        $consulta = $conexionDB->prepare("UPDATE alumnos SET nombre = :nombre, apellidos = :apellidos WHERE id = :id");
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':apellidos', $apellidos);
        $consulta->bindParam(':id', $id);
        $consulta->execute();

        // Borrar los cursos que hay
        if (isset($cursos)) {
          $sql = "DELETE FROM alumnos_cursos WHERE idalumno = :idalumno";
          $consulta = $conexionDB->prepare($sql);
          $consulta->bindParam(':idalumno',$id);
          $consulta->execute();

          // Inserta los nuevos cursos en la DB
          foreach ($cursos as $curso) {
            $consulta = $conexionDB->prepare("INSERT INTO alumnos_cursos (id, idalumno, idcurso) VALUES(NULL, :idalumno, :idcurso)");
            $consulta->bindParam(':idalumno', $id);
            $consulta->bindParam(':idcurso', $curso);
            $consulta->execute();
          }
          $arregloCursos = $cursos; //Relacionar los cursos con el alumno
        }
        header('Location: ./vista_alumno.php');
        break;
      case 'borrar':
        echo "Presionaste borrar";
        $consulta = $conexionDB->prepare("DELETE FROM alumnos WHERE id = :id");
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        header('Location:./vista_alumno.php');
        break;
      case 'cerrar':
        header('Location:./vista_alumno.php');
        break;
    }
  }


}


?>