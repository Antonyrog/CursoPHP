<?php
include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['producto']) || empty($_POST['referencia']) || empty($_POST['precio']) || empty($_POST['peso'])) {
    $alert = '<div class="alert alert-primary" role="alert">
              Todo los campos son requeridos
            </div>';
  } else {
    $codproducto = $_GET['id'];
    $categoria = $_POST['categoria'];
    $producto = $_POST['producto'];
    $referencia = $_POST['referencia'];
    $precio = $_POST['precio'];
    $peso = $_POST['peso'];
    $query_update = mysqli_query($conexion, "UPDATE producto SET descripcion = '$producto', referencia = '$referencia', categoria = '$categoria', precio = '$precio', peso = '$peso' 
    WHERE codproducto = $codproducto");
    if ($query_update) {
      $alert = '<div class="alert alert-primary" role="alert">
              Modificado
            </div>';
    } else {
      $alert = '<div class="alert alert-primary" role="alert">
                Error al Modificar
              </div>';
    }
  }
}

// Validar producto

if (empty($_REQUEST['id'])) {
  header("Location: lista_productos.php");
} else {
  $id_producto = $_REQUEST['id'];
  if (!is_numeric($id_producto)) {
    header("Location: lista_productos.php");
  }
  $query_producto = mysqli_query($conexion, "SELECT p.codproducto, p.descripcion,p.referencia, p.precio, p.peso, pr.codcategoria, pr.categoria 
  FROM producto p INNER JOIN categoria pr ON p.categoria = pr.codcategoria WHERE p.codproducto = $id_producto");
  $result_producto = mysqli_num_rows($query_producto);

  if ($result_producto > 0) {
    $data_producto = mysqli_fetch_assoc($query_producto);
  } else {
    header("Location: lista_productos.php");
  }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="row">
    <div class="col-lg-6 m-auto">

      <div class="card">
        <div class="card-header bg-primary text-white">
          Modificar producto
        </div>
        <div class="card-body">
          <form action="" method="post">
            <?php echo isset($alert) ? $alert : ''; ?>
            <div class="form-group">
              <label for="nombre">Categoria</label>
              <?php $query_categoria = mysqli_query($conexion, "SELECT * FROM categoria ORDER BY categoria ASC");
              $resultado_categoria = mysqli_num_rows($query_categoria);
              mysqli_close($conexion);
              ?>
              <select id="categoria" name="categoria" class="form-control">
                <option value="<?php echo $data_producto['codcategoria']; ?>" selected><?php echo $data_producto['categoria']; ?></option>
                <?php
                if ($resultado_categoria > 0) {
                  while ($categoria = mysqli_fetch_array($query_categoria)) {
                    // code...
                ?>
                    <option value="<?php echo $categoria['codcategoria']; ?>"><?php echo $categoria['categoria']; ?></option>
                <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="producto">Producto</label>
              <input type="text" class="form-control" placeholder="Ingrese nombre del producto" name="producto" id="producto" value="<?php echo $data_producto['descripcion']; ?>">

            </div>
            <div class="form-group">
              <label for="referencia">Referencia</label>
              <input type="text" class="form-control" placeholder="Ingrese referencia" name="referencia" id="referencia" value="<?php echo $data_producto['referencia']; ?>">

            </div>
            <div class="form-group">
              <label for="precio">Precio</label>
              <input type="text" placeholder="Ingrese precio" class="form-control" name="precio" id="precio" value="<?php echo $data_producto['precio']; ?>">

            </div>
            <div class="form-group">
              <label for="precio">Peso</label>
              <input type="text" placeholder="Ingrese peso" class="form-control" name="peso" id="peso" value="<?php echo $data_producto['peso']; ?>">

            </div>
            <input type="submit" value="Actualizar Producto" class="btn btn-primary">
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>