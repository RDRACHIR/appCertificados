<?php 
session_start();
if ($_POST) {
  $mensaje = "Usuario o contraseña incorrectos"; 
  
  if ($_POST['usuario']=='Dev' && $_POST['contrasena']=='sistema') {
    $_SESSION['usuario']=$_POST['usario'];
    header("Location: ./secciones/index.php");
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>AppCertificados</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>

  <header>
    <div class="p-4 sm-4 bg-light rounded-3 text-center">
      <div class="container-fluid py-4">
        <h1 class="display-5 fw-bold">Bienvenido al sistema de gestino de empleados</h1>
      </div>
      </div>
  </header>
    <br><br>
<main class="container">
  <div class="row">
  <div class="col-md-4">
  </div>
  <div class="col-md-4">
    <form action="" method="post">
<div class="card">
  <div class="card-header">
    Inicio de sersión
  </div>
  <div class="card-body">
<?php  if(isset($mensaje)): ?>
<div class="alert alert-danger" role="alert">
  <strong><?php echo $mensaje; ?></strong>
</div>

<?php endif;?>

  <div class="mb-3">
    <label for="usuario" class="form-label">Usuario:</label>
    <input type="text"
      class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Ingrese su usuario">
  </div>

  <div class="mb-3">
    <label for="contrasena" class="form-label">Contraseña:</label>
    <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña">
  </div>
  
  <button type="submit" class="btn btn-primary ">Iniciar sesión</button>
</form>

  </div>
</div>
  </div>
</main>


  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>