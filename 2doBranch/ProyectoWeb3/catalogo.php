<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tienda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="../libs/fonts/icomoon/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
  <?php require "partials/header.php" ?> 

    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-15">

            
            <div class="row mb-5">
            <?php
              
              include('mysql/conexion.php');
              $Query ="SELECT*FROM productos";
              $resultado = mysqli_query($conexion,$Query) or die ($conexion->error);
              while($fila=mysqli_fetch_array($resultado)){
            ?>
            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="block-4 text-center border">
                  <figure class="block-4-image" height="800px">
                    <a href="shop-single.php?id=<?php echo $fila['Id']; ?>">
                    <img src="<?php echo $fila['Imagen']; ?>"  alt= "<?php echo $fila['Nombre']; ?>"  class="img-fluid" height="800px"></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3> <p class="text-black" href="shop-single.php?id=<?php echo $fila['Id']; ?>"><?php echo $fila['Nombre']; ?><p></h3>
                    
                    <p class="text-black">$<?php echo $fila['Precio']; ?></p>
                  </div>
                </div>
              </div>
            <?php } ?>
              
            


            </div>
           
          </div>

          
        </div>

        
        
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