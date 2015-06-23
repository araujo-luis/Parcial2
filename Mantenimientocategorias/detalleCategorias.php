<?php
  require_once("libreria.php");
  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Detalle Categorias</title>
  </head>
  <body>

    <h1>Detalle categorias</h1>

    <form action="detalleCategorias.php" method="post">
      <input type="hidden" name="txtCtgCod">
      <label for="txtCtgDsc">Descripcion</label>

      <label for="cmbEstado"><label>
        <select name="cmbEstado">

          <option value="ACT"
          <?php// echo ($filtroEstado=="ACT")?"selected=selected":"";?>
          >Activa</option>

          <option value="INA"
          <?php //echo ($filtroEstado=="INA")?"selected=selected":"";?>
          >Desactiva</option>
        </select>
        <br>
        <input type="submit" name="btnFiltrar" id="btnFiltrar">
    </form>
    </form>

  </body>
</html>
