<?php
$txtNombre = "";
if(isset($_POST["btnProcesar"] )){
  $txtNombre = $_POST["txtNombre"];
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Formulario</title>
  </head>
  <body>
    <h1>Formulario HTML</h1>
    <form action="ej1.php" method="post">

    <label for="txtNombre">Nombre</label>
    <input type="text" name="txtNombre" id="txtNombre" value="<?php echo $txtNombre ?>">
    <br>
    <input type="submit" name="btnProcesar" id="btnProcesar" value="Procesar">
    
    </form>

  </body>
</html>
