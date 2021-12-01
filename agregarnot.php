<form name="form1" method="post" action="">
  <label>Titulo
  <input name="titulo" type="text" id="titulo" size="60">
  </label>
  <p>
    <label>Noticia <br>
    <textarea name="nota" cols="60" rows="5" id="nota"></textarea>
    </label>
  </p>
  <p>
    <label>
    <input name="guardar" type="submit" id="guardar" value="Agregar">
    </label>
  </p>
</form>

<?php
    require 'config.php';
   
    if(isset($_POST['guardar'])){
        
      $sql =  "INSERT INTO noticias (titulo, nota) VALUES (:titulo, :nota)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':titulo', $_POST['titulo']);
      $stmt->bindParam(':nota', $_POST['nota']);

  if ($stmt->execute()) {
    $message = 'Noticia agregada';
  } else {
    $message = 'Error al agregar la noticia';
  }
    }
?>