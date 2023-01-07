<?php include_once "includes/header.php";
  include "../conexion.php";
  if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['producto']) || empty($_POST['referencia']) 
        || empty($_POST['categoria']) || empty($_POST['precio']) || $_POST['precio'] <  0 
        || empty($_POST['peso']) || $_POST['peso'] <  0  || empty($_POST['cantidad'] 
        || $_POST['cantidad'] <  0)) {
      $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {
      $producto = $_POST['producto'];
      $referencia = $_POST['referencia'];
      $categoria = $_POST['categoria'];
      $precio = $_POST['precio'];
      $peso = $_POST['peso'];
      $cantidad = $_POST['cantidad'];
      $usuario_id = $_SESSION['idUser'];

      $query_insert = mysqli_query($conexion, "INSERT INTO producto(categoria,descripcion,referencia,precio,peso,existencia,usuario_id) 
        values ('$categoria', '$producto','$referencia', '$precio', '$peso', '$cantidad','$usuario_id')");
      if ($query_insert) {
        $alert = '<div class="alert alert-primary" role="alert">
                Producto Registrado
              </div>';
      } else {
        $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar el producto
              </div>';
      }
    }
  }
?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
     <a href="lista_productos.php" class="btn btn-primary">Regresar</a>
   </div>

   <!-- Content Row -->
   <div class="row">
     <div class="col-lg-6 m-auto">
       <form action="" method="post" autocomplete="off">
         <?php echo isset($alert) ? $alert : ''; ?>
         <div class="form-group">
           <label>Categoria</label>
           <?php
            $query_categoria = mysqli_query($conexion, "SELECT codcategoria, categoria FROM categoria ORDER BY categoria ASC");
            $resultado_categoria = mysqli_num_rows($query_categoria);
            mysqli_close($conexion);
            ?>
           <select id="categoria" name="categoria" class="form-control">
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
           <input type="text" placeholder="Ingrese nombre del producto" name="producto" id="producto" class="form-control">
         </div>
         <div class="form-group">
           <label for="referencia">Referencia</label>
           <input type="text" placeholder="Ingrese referencia" name="referencia" id="referencia" class="form-control">
         </div>
         <div class="form-group">
           <label for="precio">Precio</label>
           <input type="text" placeholder="Ingrese precio" class="form-control" name="precio" id="precio">
         </div>
         <div class="form-group">
           <label for="peso">Peso</label>
           <input type="text" placeholder="Ingrese peso" class="form-control" name="peso" id="peso">
         </div>
         <div class="form-group">
           <label for="cantidad">Cantidad</label>
           <input type="number" placeholder="Ingrese cantidad" class="form-control" name="cantidad" id="cantidad">
         </div>
         <input type="submit" value="Guardar Producto" class="btn btn-primary">
       </form>
     </div>
   </div>


 </div>
 <!-- /.container-fluid -->
</div>
 <!-- End of Main Content -->
 <?php include_once "includes/footer.php"; ?>