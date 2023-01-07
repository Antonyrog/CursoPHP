<?php
include "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['categoria'])) {
    $alert = '<p class"msg_error">Todo los campos son requeridos</p>';
  } else {
    $idcategoria = $_GET['id'];
    $categoria = $_POST['categoria'];

    $sql_update = mysqli_query($conexion, "UPDATE categoria SET categoria = '$categoria' 
    WHERE codcategoria = $idcategoria");

    if ($sql_update) {
      $alert = '<p class"msg_save">categoria Actualizado correctamente</p>';
    } else {
      $alert = '<p class"msg_error">Error al Actualizar el categoria</p>';
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_categoria.php");
  mysqli_close($conexion);
}
$idcategoria = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM categoria WHERE codcategoria = $idcategoria");
mysqli_close($conexion);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_categoria.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idcategoria = $data['codcategoria'];
    $categoria = $data['categoria'];
  }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="row">
    <div class="col-lg-6 m-auto">
      <?php echo isset($alert) ? $alert : ''; ?>
      <form class="" action="" method="post">
        <input type="hidden" name="id" value="<?php echo $idcategoria; ?>">
        <div class="form-group">
          <label for="categoria">Pategoria</label>
          <input type="text" placeholder="Ingrese categoria" name="categoria" class="form-control" id="categoria" value="<?php echo $categoria; ?>">
        </div>
        

        <input type="submit" value="Editar categoria" class="btn btn-primary">
      </form>
    </div>
  </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>