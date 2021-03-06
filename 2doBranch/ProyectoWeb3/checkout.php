<?php
#
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


  require 'database.php';


#
if (isset($_SESSION['user_id'])) {
  $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
    $user = $results;
  }
}



if (!isset($_SESSION['carrito'])) {
  header("Location:index.php");
}
$productos = $_SESSION['carrito'];
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Llavero</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="../libs/fonts/icomoon/style.css">

    <link rel="stylesheet" href="../libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../libs/css/magnific-popup.css">
    <link rel="stylesheet" href="../libs/css/jquery-ui.css">
    <link rel="stylesheet" href="../libs/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../libs/css/owl.theme.default.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" href="../libs/css/aos.css">

    <link rel="stylesheet" href="../libs/css/style.css">
    
  </head>


  <body>
  <div class="site-wrap">

    <?php include("partials/header.php"); ?> 
    <div class="site-section">
      <div class="container">


      <div class="row">



            <!-- prueba-->
        <?php if(empty($user)): ?> 
            <!-- prueba-->

          <div class="col-md-6 mb-5 mb-md-0">
              <h2 class="h3 mb-3 text-black">Correo</h2>
              <div class="p-3 p-lg-5 border">
                  <form action="thankyou.php" method="POST" >

                    <br>
                    <div class="form-group row">
                      <div class="col-md-12">
                        <label for="c_email_address" class="text-black">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="c_email_address" name="c_email_address" required>
                      </div>
                   </div>

             </div>
            </div>
        <?php endif; ?>


          

            
            <br>
            <div class="row mb-5">
              <div class="col-md-12">
                
                <h2 class="h3 mb-3 text-black">Orden</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                      <thead>
                        <th>Producto</th>
                        <th>Total</th>
                      </thead>
                      <?php 
                          $total = 0;
                          foreach ($_SESSION['carrito'] as $key => $producto) {
                          $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
                          $subtotal = $total;
                          $totala = $total;
                        ?>
                    <tbody>
                      <tr>
                        <td><?php echo $producto['NOMBRE'];?></td>
                        <td><?php echo $producto['PRECIO'];?></td>
                      </tr>
                    <?php }?>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Total</strong></td>
                        <td class="text-black font-weight-bold"><strong>$<?php echo number_format($totala,2)?></strong></td>
                      </tr>
                    </tbody>
                  </table>
                  </div>
              </div>
            </div>


                    
            
            <div class="row mb-5">
                <div class="col-md-12">
                  <br>
                  <h2 class="h3 mb-3 text-black">M??todos de pago</h2>
                  <div class="p-3 p-lg-5 border">
                    <table class="table site-block-order-table mb-5">
                      
                      <div class="border p-3 mb-3">
                        <h3 class="h6 mb-0"><a class="colorTexto" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Transferencia</a></h3>

                        <div class="collapse" id="collapsebank">
                          <div class="py-2">
                            <p class="mb-0">No disponible</p>
                          </div>
                        </div>
                      </div>

                      <div class="border p-3 mb-5">
                        <h3 class="h6 mb-0"><a class="colorTexto" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                        <div class="collapse" id="collapsepaypal">
                          <div class="py-2">
                            <p class="mb-0">No disponible</p>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <?php if(isset($_SESSION['usuario'])){?>
                          <button type="submit" class="btn-dark btn-warning btn-lg py-3 btn-block" onclick="window.location='thankyou.php'">Proceder Pago</button>
                        <?php }?>

                        <?php if(!isset($_SESSION['usuario'])){?>
                          <button type="submit" class="btn-dark btn-warning btn-lg py-3 btn-block" onclick="window.location='thankyou.php'">Proceder Pago</button>
                        <?php }?>
                      </div>
                </form>

                </div>
              </div>
            </div>

          </div>
        <!--<div>-->
        <!-- </form> -->

      </div>
    </div>
  </div>


  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.magnific-popup.min.js"></script>
  <script src="../js/aos.js"></script>

  <script src="../js/main.js"></script>
    
  </body>
</html>