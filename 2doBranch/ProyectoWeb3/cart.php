<?php


  session_start();
  include("mysql/conexion.php");
  
  if (isset($_POST['btnAccion'])){
    
      switch ($_POST['btnAccion']) {
        case 'Agregar':
          

          if(is_numeric( openssl_decrypt($_POST['id'],COD,KEY))){
            $ID=openssl_decrypt($_POST['id'],COD,KEY);
          }
          else{
            echo "<script>alert('error')</script>";
          }
          if (is_string(openssl_decrypt($_POST['imagen'],COD,KEY))) {
            $IMAGEN=openssl_decrypt($_POST['imagen'],COD,KEY);    
          }else{echo "<script>alert('error');</script>";}
          if (is_string(openssl_decrypt($_POST['cantidad'],COD,KEY))) {
            $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY);     
          }else{echo "<script>alert('error');</script>";}
          if (is_string(openssl_decrypt($_POST['precio'],COD,KEY))) {
            $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);   
          }else{echo "<script>alert('error');</script>";}
          if (is_string(openssl_decrypt($_POST['nombre'],COD,KEY))) {
            $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);  
          }else{echo "<script>alert('error');</script>";}

          
          if(isset($_SESSION['carrito'])){
            $idProductos=array_column($_SESSION['carrito'],"ID");
            if (in_array($ID,$idProductos)) {
              echo "<script>alert('El producto ha sido seleccionado');</script>";
            }else{

            $numeroProductos=count($_SESSION['carrito']);
            $producto=array(
              'ID'=>$ID,
              'NOMBRE'=>$NOMBRE,
              'IMAGEN'=>$IMAGEN,
              'PRECIO'=>$PRECIO,
              'CANTIDAD'=>$CANTIDAD
            );
            $_SESSION['carrito'][$numeroProductos]=$producto;
          }
          }else{
            $producto=array(
              'ID'=>$ID,
              'NOMBRE'=>$NOMBRE,
              'IMAGEN'=>$IMAGEN,
              'PRECIO'=>$PRECIO,
              'CANTIDAD'=>$CANTIDAD
            );
            $_SESSION['carrito'][0]=$producto;
            
          }


          break;

          case "Eliminar":
            if (is_numeric(openssl_decrypt($_POST['id'],COD,KEY))) {
              $ID=openssl_decrypt($_POST['id'],COD,KEY);
              foreach($_SESSION['carrito'] as $indice => $producto){
                if ($producto['ID']==$ID) {
                  unset($_SESSION['carrito'][$indice]);
                  echo "<script>alert('Eliminado con exito');</script>";
                }
              }
            }
          break;
        
        default:
          # code...
          break;
      }
      
    }

  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Llavero </title>
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
        <div class="row mb-5">
        
          
            
            <?php if(!empty($_SESSION['carrito'])){ ?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="20%" class="product-thumbnail">Producto</th>
                    <th width="20%" class="product-name">Nombre</th>
                    <th width="20%" class="product-price">Precio</th>
                    <th width="10%" class="product-total">Total</th>
                    <th width="10%" class="product-remove">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
              
                <?php $total=0;?>
                <?php
                  foreach ($_SESSION['carrito'] as $indice => $producto) {
                  
                ?>
                  <tr>
                    <td class="product-thumbnail">
                    <center>
                      <img src="<?php echo $producto['IMAGEN']; ?>" alt="Image" class="img-fluid" width="40%">
                      </center>
                    </td>
                    <td class="product-name"> 
                      <h2 class="h5 text-black"><?php echo $producto['NOMBRE']; ?></h2>
                    </td>
                    <td>$<?php echo $producto['PRECIO']; ?></td>
                    
                    <td class="cant<?php echo $producto['ID'];?>">$<?php echo number_format($producto['PRECIO'] * $producto['CANTIDAD'],2); ?></td>
                    
                    <td>
                    <form class="col-md-12" method="POST">
                    <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">
                    <button type="submit" class="btn-dark btn-primary btn-warning btn-sm"
                    name="btnAccion"
                    value="Eliminar"
                    >Borrar</button>
                    </form>
                    </td>
                   
                  </tr>
                  <?php $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
                      
                  ?>
                  <?php } ?>
                </tbody>
              </table>
            
         
        </div>

        <div class="row">
          
          <div class="col-md-10 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Total</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                  
                    <strong class="text-black">$<?php echo number_format($total,2);?></strong>
                  </div>
                </div>
                <div class="row mb-5">

                  <div class="col-md-6 text-right">
                  <?php if (isset($_SESSION['usuario'])) {?>
                    
                    <strong class="text-black">$<?php echo number_format($total,2);?></strong>
                  <?php }?>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                  <?php if (isset($_SESSION['usuario'])) {?>
                    <button class="btn-dark btn-primary btn-warning btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Comprar</button>
                <?php }else{?> 
                      <button class="btn-dark btn-primary btn-warning btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Comprar</button>
                <?php }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  
  </div>

  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.magnific-popup.min.js"></script>
  <script src="../js/aos.js"></script>

  <script src="../js/main.js"></script>
  <script>
    $(document).ready(function(){
      $(".txtcantidad").keyup(function(){
         var cantidad = $(this).val();
         var precio = $(this).val('precio');
         var id = $(this).val('id');
         incrementar(cantidad,precio,id);
         
      });
      $(".btnIncrementar").click(function(){
        var precio = $(this).parent('div').parent('div').find('input').data('precio');
        var id = $(this).parent('div').parent('div').find('input').data('id');
        var cantidad = $(this).parent('div').parent('div').find('input').val();
        incrementar(cantidad,precio,id);
        
      });
      function incrementar(cantidad,precio,id) {
        var mult = parseFloat(cantidad)*parseFloat(precio);
         $(".cant"+id).text("$"+mult);
         
      }
    });
  </script>
    
  </body>
</html>