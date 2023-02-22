<?php include("../templates/header.php"); ?>
<?php include("./cursos.php"); ?>

  <div class="col-md-5">
  <form action="" method="post">
  <br>
    <div class="card">
      <div class="card-header">
        Cursos
      </div>
      <div class="card-body">

        <div class="mb-3" hidden>
          <label for="" class="form-label">ID:</label>
          <input type="text"
              class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="Ingrese el nombre del curso" value="<?php echo $curso['id']; ?>">
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Nombre:</label>
          <input type="text"
            required class="form-control" name="nombrecurso" id="nombrecurso" aria-describedby="helpId" placeholder="Ingrese el nombre del curso" value="<?php echo $nombreCurso;?>">
        </div>

        <div class="btn-group" role="group" aria-label="Basic example">
        <button type="submit"  name="accion" value="agregar" class="btn btn-success">Agregar</button>
        <button type="submit"  name="accion" value="editar" class="btn btn-warning">Editar</button>
        <button type="submit"  name="accion" value="borrar" class="btn btn-danger">Borrar</button>
        <button type="submit"  name="accion" value="cancelar" class="btn btn-info">Cancelar</button>
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
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php  foreach ($listaCursos as $curso) {?>
        <tr class="">
          <td scope="row"><?php echo $curso['id']; ?></td>
          <td><?php echo $curso['nombre']; ?></td>
          <td>
            <form action="" method="post">
              <input type="hidden" name="id" id="id" value="<?php echo $curso['id']; ?>">
              <input type="submit" value="seleccionar" name="accion" class="btn btn-info">
            </form>
          </td>
        </tr>
        <?php  }?>
      </tbody>
    </table>
  </div>
</div>

<?php include("../templates/footer.php");?>