<?php include("../templates/header.php"); ?>
<?php include("./alumnos.php"); ?>

<div class="col-md-5">
  <br>
  <form action="" method="post">
    <div class="card">
      <div class="card-header">
        Alumnos
      </div>
      <div class="card-body">

      <div class="mb-3" hidden>
        <label for="id" class="form-label">ID</label>
        <input type="text"
          class="form-control" name="id" value="<?php echo $id?>" id="id" aria-describedby="helpId" placeholder="ID">
      </div>

      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text"
          class="form-control" name="nombre" id="nombre" value="<?php echo $nombre ?>" aria-describedby="helpId" placeholder="Escriba el nombre">
      </div>

      <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos:</label>
        <input type="text"
          class="form-control" name="apellidos" id="apellidos" value="<?php echo $apellidos ?>"  aria-describedby="helpId" placeholder="Escriba los apellidos">
      </div>

      <div class="mb-3">
        <label for="cursos[]" class="form-label">Curso del alumno:</label>
        <select multiple class="form-select form-select-lg" name="cursos[]" id="ListaCursos">
          <?php foreach ($listaCursos as $curso): ?>
          <option 
          <?php 
          // Seleccionar los cursos que se encuentran en el array arregloCursos
            if (!empty($arregloCursos)):
              if (in_array($curso['id'], $arregloCursos)):
                echo 'selected';
              endif;
            endif;
          ?>
          value="<?php echo $curso['id']; ?>"><?php echo $curso['id']; ?> - <?php echo $curso['nombre']; ?> </option>
          <?php endforeach;?>
        </select>
      </div>

      <div class="btn-group" role="group">
      <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
      <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
      <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
      <button type="submit" name="accion" value="cancelar" class="btn btn-info">Cancelar</button>
      </div>
      
      


      </div>
    </div>
  </form>
</div>
<div class="col-md-7">
  <br>
  <div class="table-responsive">
    <table class="table table-primary">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Cursos</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($listaAlumnos as $alumno):?>
        <tr class="">
          <td scope="row"><?php echo $alumno['id'];?></td>
          <td>
            <?php echo $alumno['nombre'];?> <?php echo $alumno['apellidos'];?>
          </td>
          <td>
            <?php foreach ($alumno["cursos"] as $curso):?>
              - <a href="certificado.php?idcurso=<?php echo $curso['id']; ?>&idalumno=<?php echo $alumno['id']; ?>">
              <?php echo $curso['nombre']; ?>
            </a><br>
            <?php endforeach;?>
          </td>
          <td>
            <form action="" method="post">
              <input type="hidden" name="id" id="id" value="<?php echo $alumno['id']; ?>">
              <input type="submit" value="seleccionar" name="accion" class="btn btn-info">
            </form>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
  

</div>


<!-- Modificando el selector con Tom-select -->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
  new TomSelect('#ListaCursos');
</script>

<?php include("../templates/footer.php");?>