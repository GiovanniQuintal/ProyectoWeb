<?php
  session_start();
  include('mysql/conexion.php');
  if (!isset($_SESSION['carrito'])) {
    header('Location: ../index.php');
  }
  if (!isset($_SESSION['usuario'])) {
  
  $nombre = $_POST['c_fname'];
  $email = $_POST['c_email_address'];
  $pass = $_POST['c_account_password'];
  $nivel = 1;

  $producto = $_SESSION['carrito'];
  $total = 0;
  
  foreach ($_SESSION['carrito'] as $key => $producto) {
    $total = $total+($producto['PRECIO']*$producto['CANTIDAD']);
  }
  $fecha = date('Y-m-d h:m:s');
  $conexion ->query("INSERT INTO usuario(nombre,email,passworda,nivel ) values ('$nombre','$email','$pass','$nivel')") or die($conexion->error);
  $conexion ->query("INSERT INTO ventas(id_usuario,total,fecha) values (1,'$total','$fecha')") or die($conexion->error);
  $id_venta = $conexion->insert_id;
  foreach ($_SESSION['carrito'] as $key => $producto) {
    $conexion->query("INSERT INTO productos_venta (id_producto,cantidad,precio,subtotal)
    values (
    ".$producto['ID'].",
    ".$producto['CANTIDAD'].",
    ".$producto['PRECIO'].",
    ".$producto['CANTIDAD']*$producto['PRECIO'].")")or die ($conexion->error);
  }
  unset($_SESSION['carrito']);
}else{
  $nivel = 1;
  $idUsuario = $_SESSION['id'];
  $producto = $_SESSION['carrito'];
  $total = 0;
  
  foreach ($_SESSION['carrito'] as $key => $producto) {
    $total = $total+($producto['PRECIO']*$producto['CANTIDAD']);
  }
  $fecha = date('Y-m-d h:m:s');
  $conexion ->query("INSERT INTO ventas(id_usuario,total,fecha) values ('$idUsuario','$total','$fecha')") or die($conexion->error);
  $id_venta = $conexion->insert_id;
  foreach ($_SESSION['carrito'] as $key => $producto) {
    $conexion->query("INSERT INTO productos_venta (id_producto,cantidad,precio,subtotal)
    values (
    ".$producto['ID'].",
    ".$producto['CANTIDAD'].",
    ".$producto['PRECIO'].",
    ".$producto['CANTIDAD']*$producto['PRECIO'].")")or die ($conexion->error);
  }
  unset($_SESSION['carrito']);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   <title>Tienda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="../libs/fonts/icomoon/style.css">

    <link rel="stylesheet" href="../libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../libs/css/magnific-popup.css">
    <link rel="stylesheet" href="../libs/css/jquery-ui.css">
    <link rel="stylesheet" href="../libs/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../libs/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../libs/css/aos.css">
    <link rel="stylesheet" href="../libs/css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">
   <?php include("partials/header.php"); ?> 

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">Relizado con exito!</h2>
            <p class="lead mb-5">Orden Completada.</p>
            <p><a href="catalogo.php" class="btn btn-sm btn-primary btn-outline-warning">Regresar a la tienda</a></p>
          </div>
        </div>
      </div>
    </div>


  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>