<?php


    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


  require 'database.php';

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
?>


<nav class="navbar navbar-expand-md navbar-dark bg-black">
            <div class="container-fluid">
                <a class="navbar-brand" href="/ProyectoWeb3">
                    <img src="imgs/logo.png" alt="" width="350">
                </a>
                
                <button class="navbar-toggler" 
                        type="button"
                        data-bs-toggle="collapse" 
                        data-bs-target="#navbarSupportedContent" 
                        aria-controls="navbarSupportedContent" 
                        aria-expanded="false" 
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="productos/tienda.php">Catálogo</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Noticias</a></li>
                        <li class="nav-item"><a class="nav-link" href="Login.php">Inicia sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="Registro.php">Regístrate</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
                        <li class="nav-item"><a class="nav-link" href="productos/productos.php">Agregar Producto</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php">Carrito</a></li>
                        
                        <?php if(!empty($user)): ?> 
                          <li class="input"><a class="nav-link"> Hola <?= $user['email']; ?> </a></li>
                          <li class="nav-item"><a class="nav-link" href="logout.php">(Cerrar sesión)</a></li>
                        <?php else: ?>
                          <li class="input"><a class="nav-link"> ¡Registrate para comprar! </a></li>
                        <?php endif; ?></a></li>
                    </ul>
                </div>
            </div>
        </nav>